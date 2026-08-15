<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Notifications\NewTechTransferRequest;
use App\Notifications\TechTransferUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TechTransferController extends Controller
{
    public function index()
    {
        return view('tech-transfer.index');
    }

    public function apply()
    {
        return view('tech-transfer.apply');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'consultation_date' => ['required', 'date', 'after_or_equal:today'],
            'consultation_time' => ['required', 'date_format:H:i'],
            'proponent_name' => ['required', 'string', 'max:255'],
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['string', 'in:trl_assessment,technology_packaging,mode_of_transfer,other_services'],
            'title' => ['nullable', 'string', 'max:255'],
        ]);

        $services = $data['services'];

        $trackFields = [
            'trl_assessment' => [
                'trl_narrative' => ['nullable', 'string'],
            ],
            'technology_packaging' => [
                'packaging_service' => ['nullable', 'string', 'max:255'],
            ],
            'mode_of_transfer' => [
                'mode_of_transfer' => ['nullable', 'string', 'in:licensing,direct_sale,extension,spin_off'],
            ],
            'other_services' => [
                'other_service_details' => ['nullable', 'string', 'max:255'],
            ],
        ];

        $validated = [];
        foreach ($services as $service) {
            $validated = array_merge($validated, $request->validate($trackFields[$service]));
        }

        $documents = [];
        if ($request->hasFile('documents')) {
            $documents = $request->validate([
                'documents' => ['required', 'array', 'max:10'],
                'documents.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png,zip', 'max:2048'],
            ])['documents'];
        }

        $title = $data['title'] ?: 'Tech Transfer Request - ' . $data['proponent_name'];

        $application = Application::create([
            'branch' => Application::BRANCH_TECH_TRANSFER,
            'application_type' => 'tech_transfer',
            'title' => $title,
            'proponent_name' => $data['proponent_name'],
            'submitted_by' => $request->user()->id,
            'tracking_no' => Application::generateTrackingNo('tech_transfer'),
            'status' => Application::STATUS_FOR_EVALUATION,
            'date_filed' => now()->toDateString(),
            'payload' => array_merge(
                [
                    'consultation_date' => $data['consultation_date'],
                    'consultation_time' => $data['consultation_time'],
                    'services' => $services,
                ],
                $validated,
            ),
        ]);

        if (! empty($documents)) {
            $docPaths = [];
            foreach ($documents as $doc) {
                $docPaths[] = $doc->store('tech_transfer/' . $application->tracking_no . '/documents', 'public');
            }
            $application->payload = array_merge($application->payload, ['documents' => $docPaths]);
            $application->save();
        }

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewTechTransferRequest($application));

        return redirect()->route('applications.show', $application)
            ->with('success', 'Tech transfer request submitted successfully. An admin will review your request.');
    }

    public function data(Request $request)
    {
        $query = Application::query()
            ->with('submittedBy')
            ->where('branch', Application::BRANCH_TECH_TRANSFER)
            ->latest('date_filed')
            ->latest('id');

        if (! $request->user()->isAdmin()) {
            $query->where('submitted_by', $request->user()->id);
        }

        return view('tech-transfer.data', [
            'applications' => $query->get(),
        ]);
    }

    public function rateTrl(Request $request, Application $application)
    {
        $this->authorizeAdmin($request, $application);

        $data = $request->validate([
            'trl_level' => ['required', 'integer', 'between:1,9'],
            'trl_narrative' => ['nullable', 'string'],
        ]);

        $payload = $application->payload ?? [];
        $payload['trl_level'] = $data['trl_level'];
        $payload['trl_narrative'] = $data['trl_narrative'] ?? $payload['trl_narrative'] ?? null;
        $application->payload = $payload;
        $application->save();

        Notification::send($application->submittedBy, new TechTransferUpdate($application, 'Your TRL assessment has been completed. TRL ' . $data['trl_level'] . ' has been reflected on your application.', 'TRL Assessment Completed'));

        return back()->with('success', 'TRL assessment saved and reflected to the client.');
    }

    public function approveSchedule(Request $request, Application $application)
    {
        $this->authorizeAdmin($request, $application);

        $application->status = Application::STATUS_MEETING_APPROVED;
        $application->save();

        Notification::send($application->submittedBy, new TechTransferUpdate($application, 'Your consultation schedule has been approved. Please proceed to the USMart TBI Office for your face-to-face meeting.', 'Meeting Schedule Approved'));

        return back()->with('success', 'Schedule approved. The client has been notified.');
    }

    public function proceedToTbi(Request $request, Application $application)
    {
        $this->authorizeOwner($request, $application);

        $payload = $application->payload ?? [];
        $payload['tbi_proceeded'] = true;
        $application->payload = $payload;
        $application->save();

        Notification::send($application->submittedBy, new TechTransferUpdate($application, 'You confirmed you will proceed to the USMart TBI Office for your face-to-face meeting.', 'TBI Office Visit Confirmed'));

        return redirect()->route('applications.show', $application)->with('proceed_tbi', true);
    }

    public function meetingDecision(Request $request, Application $application)
    {
        $this->authorizeAdmin($request, $application);

        $decision = $request->validate(['decision' => ['required', 'in:approve,revise']])['decision'];

        if ($decision === 'approve') {
            $application->status = Application::STATUS_REQUIREMENTS;
            Notification::send($application->submittedBy, new TechTransferUpdate($application, 'Your meeting was approved. Please submit the required documents to continue.', 'Meeting Approved'));
            $message = 'Meeting approved. The client can now submit the required documents.';
        } else {
            $application->status = Application::STATUS_FOR_REVISION;
            Notification::send($application->submittedBy, new TechTransferUpdate($application, 'Your meeting requires revision. Please update the details and resubmit.', 'Meeting Requires Revision'));
            $message = 'Meeting marked for revision. The client has been notified.';
        }

        $application->save();

        return back()->with('success', $message);
    }

    public function submitRequirements(Request $request, Application $application)
    {
        $this->authorizeOwner($request, $application);

        $documents = $request->validate([
            'documents' => ['required', 'array', 'min:1', 'max:10'],
            'documents.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png,zip', 'max:2048'],
        ])['documents'];

        $payload = $application->payload ?? [];
        $reqPaths = [];
        foreach ($documents as $doc) {
            $reqPaths[] = $doc->store('tech_transfer/' . $application->tracking_no . '/requirements', 'public');
        }
        $payload['requirements'] = array_merge($payload['requirements'] ?? [], $reqPaths);
        $application->payload = $payload;
        $application->status = Application::STATUS_REVIEWED;
        $application->save();

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new TechTransferUpdate($application, 'Required documents have been submitted by the client.', 'Requirements Submitted'));

        return back()->with('success', 'Required documents submitted successfully. An admin will review them.');
    }

    private function authorizeAdmin(Request $request, Application $application): void
    {
        abort_unless($request->user()->isAdmin(), 403);
    }

    private function authorizeOwner(Request $request, Application $application): void
    {
        abort_unless($application->submitted_by === $request->user()->id, 403);
    }
}
