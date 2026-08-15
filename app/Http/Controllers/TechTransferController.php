<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Notifications\NewTechTransferRequest;
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
                'trl_level' => ['required', 'integer', 'between:1,9'],
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
}
