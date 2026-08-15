<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Notifications\BizDevUpdate;
use App\Notifications\NewBizDevRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class BizDevController extends Controller
{
    public const TRACKS = [
        'tech_pitching' => 'Tech Pitching Presentation',
        'mentoring' => 'Mentoring / Coaching',
        'design_thinking' => 'Design Thinking',
        'apply_incubation' => 'Apply Incubation',
    ];

    public function index()
    {
        return view('bizdev.index');
    }

    public function apply()
    {
        return view('bizdev.apply');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'consultation_date' => ['required', 'date', 'after_or_equal:today'],
            'consultation_time' => ['required', 'date_format:H:i'],
            'proponent_name' => ['required', 'string', 'max:255'],
            'track' => ['required', 'string', 'in:' . implode(',', array_keys(self::TRACKS))],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $track = $data['track'];

        // Apply Incubation main track enters the incubation pipeline directly.
        $status = $track === 'apply_incubation'
            ? Application::STATUS_INCUBATION_APPLY
            : Application::STATUS_FOR_EVALUATION;

        $application = Application::create([
            'branch' => Application::BRANCH_BUSINESS_DEVELOPMENT,
            'application_type' => 'bizdev',
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'proponent_name' => $data['proponent_name'],
            'submitted_by' => $request->user()->id,
            'tracking_no' => Application::generateTrackingNo('bizdev'),
            'status' => $status,
            'date_filed' => now()->toDateString(),
            'payload' => [
                'consultation_date' => $data['consultation_date'],
                'consultation_time' => $data['consultation_time'],
                'track' => $track,
            ],
        ]);

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewBizDevRequest($application));

        return redirect()->route('applications.show', $application)
            ->with('success', $track === 'apply_incubation'
                ? 'Welcome to the incubation program. Please complete your incubation application.'
                : 'Your consultation request was submitted. An admin will review your schedule.');
    }

    public function approveSchedule(Request $request, Application $application)
    {
        $this->authorizeAdmin($request, $application);

        $application->status = Application::STATUS_MEETING_APPROVED;
        $application->save();

        Notification::send($application->submittedBy, new BizDevUpdate(
            $application,
            'Your meeting schedule has been approved. Please proceed to the selected TBI office for your face-to-face meeting.',
            'Meeting Schedule Approved'
        ));

        return back()->with('success', 'Schedule approved. The client has been notified.');
    }

    public function meetingDecision(Request $request, Application $application)
    {
        $this->authorizeAdmin($request, $application);

        $decision = $request->validate(['decision' => ['required', 'in:approve,reject']])['decision'];
        $track = $application->payload['track'] ?? null;

        if ($decision === 'reject') {
            $application->status = Application::STATUS_REJECTED;
            $application->remarks = 'Thank you for presenting your idea. Unfortunately, we are unable to proceed with this application at this time. We encourage you to refine your concept and re-apply in the future.';
            $application->save();

            Notification::send($application->submittedBy, new BizDevUpdate(
                $application,
                'Thank you for presenting your idea. We are unable to proceed with your application at this time.',
                'Application Not Approved'
            ));

            return back()->with('success', 'Application rejected with the standard message.');
        }

        // Approved — tech pitching and design thinking proceed to incubation.
        if (in_array($track, ['tech_pitching', 'design_thinking'])) {
            $application->status = Application::STATUS_INCUBATION_APPLY;
            $application->save();

            Notification::send($application->submittedBy, new BizDevUpdate(
                $application,
                'Congratulations! Your pitch was approved. Please proceed to Apply Incubation to complete your application.',
                'Pitch Approved'
            ));

            return back()->with('success', 'Pitch approved. The client can now proceed to Apply Incubation.');
        }

        // Mentoring / coaching completes with the face-to-face meeting.
        $application->status = Application::STATUS_COMPLETED;
        $application->save();

        Notification::send($application->submittedBy, new BizDevUpdate(
            $application,
            'Your mentoring session was approved and completed. Thank you for participating.',
            'Mentoring Completed'
        ));

        return back()->with('success', 'Mentoring session completed.');
    }

    public function incubation(Request $request, Application $application)
    {
        abort_unless($application->submitted_by === $request->user()->id, 403);

        return view('bizdev.incubation', ['application' => $application]);
    }

    public function storeIncubation(Request $request, Application $application)
    {
        abort_unless($application->submitted_by === $request->user()->id, 403);

        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'startup_name' => ['required', 'string', 'max:255'],
            'team_leader' => ['required', 'string', 'max:255'],
            'team_members' => ['nullable', 'string', 'max:1000'],
            'mobile_numbers' => ['nullable', 'string', 'max:1000'],
            'tbi' => ['required', 'in:usmart,agraqua'],
            'team_needs_skills' => ['required', 'in:yes,no'],
            'required_skills' => ['nullable', 'string', 'max:1000'],
            'technology' => ['required', 'string', 'max:2000'],
            'overview' => ['required', 'string', 'max:3000'],
            'problem' => ['required', 'string', 'max:2000'],
            'solution' => ['required', 'string', 'max:2000'],
            'target_market' => ['required', 'string', 'max:2000'],
            'competitors' => ['required', 'string', 'max:2000'],
            'competitive_advantage' => ['required', 'string', 'max:2000'],
            'trl' => ['required', 'integer', 'between:0,9'],
            'brl' => ['required', 'integer', 'between:0,9'],
            'irl' => ['required', 'integer', 'between:0,9'],
            'accomplishments' => ['nullable', 'string', 'max:2000'],
            'commitment_statement' => ['required', 'string', 'max:600'],
            'founders_committed' => ['required', 'in:yes,no'],
            'hindrances' => ['nullable', 'string', 'max:2000'],
            'support_needed' => ['nullable', 'string', 'max:2000'],
            'future_plans' => ['nullable', 'string', 'max:2000'],
            'commitment_ack' => ['required', 'in:yes,no'],
        ]);

        $letterOfIntent = [];
        if ($request->hasFile('letter_of_intent')) {
            $letterOfIntent = $request->validate([
                'letter_of_intent' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            ])['letter_of_intent'];
        }

        $teamLeaderId = [];
        if ($request->hasFile('team_leader_id')) {
            $teamLeaderId = $request->validate([
                'team_leader_id' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            ])['team_leader_id'];
        }

        $payload = array_merge($application->payload ?? [], $data);
        $payload['skills'] = $data['team_needs_skills'] === 'yes'
            ? $data['required_skills']
            : null;
        unset($payload['required_skills']);

        if (! empty($letterOfIntent)) {
            $payload['letter_of_intent'] = $letterOfIntent->store('bizdev/' . $application->tracking_no . '/documents', 'public');
        }
        if (! empty($teamLeaderId)) {
            $payload['team_leader_id'] = $teamLeaderId->store('bizdev/' . $application->tracking_no . '/documents', 'public');
        }

        $application->payload = $payload;
        $application->startup_name = $data['startup_name'];
        $application->status = Application::STATUS_FOR_EVALUATION;
        $application->save();

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new BizDevUpdate(
            $application,
            'An incubation application has been submitted and is pending your evaluation.',
            'Incubation Application Submitted'
        ));

        return redirect()->route('applications.show', $application)
            ->with('success', 'Incubation application submitted successfully. An admin will evaluate it.');
    }

    public function evaluate(Request $request, Application $application)
    {
        $this->authorizeAdmin($request, $application);

        $decision = $request->validate(['decision' => ['required', 'in:approve,revise']])['decision'];

        if ($decision === 'revise') {
            $application->status = Application::STATUS_FOR_REVISION;
            $application->save();

            Notification::send($application->submittedBy, new BizDevUpdate(
                $application,
                'Your incubation application requires revision. Please update your profile and information and resubmit.',
                'Incubation Application Requires Revision'
            ));

            return back()->with('success', 'Application marked for revision. The client has been notified.');
        }

        $application->status = Application::STATUS_INCUBATION;
        $application->save();

        Notification::send($application->submittedBy, new BizDevUpdate(
            $application,
            'Congratulations! Your application was approved. You are now officially in the USM incubation program. Your journey from pre-incubation to commercialization begins now.',
            'Incubation Application Approved'
        ));

        return back()->with('success', 'Application approved. The startup has entered the incubation program.');
    }

    public function advanceStage(Request $request, Application $application)
    {
        $this->authorizeAdmin($request, $application);

        $stages = [
            Application::STATUS_INCUBATION => Application::STATUS_MASTER_CLASS,
            Application::STATUS_MASTER_CLASS => Application::STATUS_STARTUP_ACTIVITIES,
            Application::STATUS_STARTUP_ACTIVITIES => Application::STATUS_MONITORING,
            Application::STATUS_MONITORING => Application::STATUS_GRADUATED,
            Application::STATUS_GRADUATED => Application::STATUS_COMPLETED,
        ];

        $next = $stages[$application->status] ?? null;
        if (! $next) {
            return back()->with('error', 'This application is not in an advanceable stage.');
        }

        $application->status = $next;
        $application->save();

        $labels = [
            Application::STATUS_MASTER_CLASS => 'Incubation Master Class',
            Application::STATUS_STARTUP_ACTIVITIES => 'Startup Activities',
            Application::STATUS_MONITORING => 'Progress Monitoring & Evaluation',
            Application::STATUS_GRADUATED => 'Graduation',
            Application::STATUS_COMPLETED => 'Completion',
        ];

        Notification::send($application->submittedBy, new BizDevUpdate(
            $application,
            'Your incubation program stage has been updated to "' . ($labels[$next] ?? $application->statusLabel()) . '".',
            'Incubation Program Stage Updated'
        ));

        return back()->with('success', 'Program stage advanced to "' . ($labels[$next] ?? $application->statusLabel()) . '".');
    }

    public function data(Request $request)
    {
        $query = Application::query()
            ->with('submittedBy')
            ->where('branch', Application::BRANCH_BUSINESS_DEVELOPMENT)
            ->latest('date_filed')
            ->latest('id');

        if (! $request->user()->isAdmin()) {
            $query->where('submitted_by', $request->user()->id);
        }

        return view('bizdev.data', [
            'applications' => $query->get(),
        ]);
    }

    private function authorizeAdmin(Request $request, Application $application): void
    {
        abort_unless($request->user()->isAdmin(), 403);
    }
}
