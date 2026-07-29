<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewConsultationRequest;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::query()->with('submittedBy')->latest('date_filed')->latest('id');

        if (! $request->user()->isAdmin()) {
            $query->where('submitted_by', $request->user()->id);
        }

        if ($request->filled('branch')) {
            $query->where('branch', $request->string('branch'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($search = $request->string('search')->toString()) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('tracking_no', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('proponent_name', 'like', "%{$search}%")
                    ->orWhere('startup_name', 'like', "%{$search}%");
            });
        }

        return view('applications.index', [
            'applications' => $query->paginate(10)->withQueryString(),
            'branches' => Application::branches(),
            'statuses' => Application::statusOptions(),
        ]);
    }

    public function ipServices()
    {
        return view('applications.ip-services');
    }

    public function ipConsultation()
    {
        return view('applications.ip-consultation');
    }

    public function storeIpConsultation(Request $request)
    {
        $data = $request->validate([
            'consultation_date' => ['required', 'date', 'after_or_equal:today'],
            'consultation_time' => ['required', 'date_format:H:i'],
            'proponent_name' => ['required', 'string', 'max:255'],
        ]);

        $application = Application::create([
            'branch' => 'ip',
            'application_type' => 'consultation',
            'title' => 'IP Consultation - ' . $data['proponent_name'],
            'proponent_name' => $data['proponent_name'],
            'submitted_by' => $request->user()->id,
            'tracking_no' => Application::generateTrackingNo('ip'),
            'status' => Application::STATUS_FOR_EVALUATION,
            'date_filed' => now()->toDateString(),
            'payload' => [
                'consultation_date' => $data['consultation_date'],
                'consultation_time' => $data['consultation_time'],
            ],
        ]);

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewConsultationRequest($application));

        return redirect()->route('applications.show', $application)
            ->with('success', 'Consultation appointment submitted successfully. An admin will review your request.');
    }

    public function create()
    {
        return view('applications.create', [
            'branches' => Application::branches(),
            'formTypes' => Application::formTypes(),
            'statuses' => Application::statusOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $application = Application::create([
            ...$data,
            'submitted_by' => $request->user()->id,
            'tracking_no' => Application::generateTrackingNo($data['branch']),
            'status' => $data['status'] ?? Application::STATUS_FOR_EVALUATION,
            'date_filed' => $data['date_filed'] ?? now()->toDateString(),
        ]);

        // Notify all admins if consultation is requested
        if ($application->branch === 'consultation') {
            $admins = User::where('role', 'admin')->get();
            Notification::send($admins, new \App\Notifications\NewConsultationRequest($application));
        }

        return redirect()->route('applications.show', $application)->with('success', 'Application submitted successfully.');
    }

    public function show(Request $request, Application $application)
    {
        $this->authorizeAccess($request, $application);

        return view('applications.show', [
            'application' => $application->load('submittedBy'),
            'branches' => Application::branches(),
            'statuses' => Application::statusOptions(),
            'formTypes' => Application::formTypes(),
        ]);
    }

    public function edit(Request $request, Application $application)
    {
        $this->authorizeAdmin($request);

        return view('applications.edit', [
            'application' => $application,
            'branches' => Application::branches(),
            'statuses' => Application::statusOptions(),
            'formTypes' => Application::formTypes(),
        ]);
    }

    public function update(Request $request, Application $application)
    {
        $this->authorizeAdmin($request);
        $data = $this->validatedData($request);

        $application->update($data);

        return redirect()->route('applications.show', $application)->with('success', 'Application updated successfully.');
    }

    public function destroy(Request $request, Application $application)
    {
        $this->authorizeAdmin($request);

        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Application removed.');
    }

    public function download(Request $request, Application $application)
    {
        $this->authorizeAccess($request, $application);

        $content = view('applications.download', [
            'application' => $application->load('submittedBy'),
        ])->render();

        return Response::streamDownload(function () use ($content) {
            echo $content;
        }, $application->tracking_no . '.html', ['Content-Type' => 'text/html']);
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'branch' => ['required', 'string'],
            'application_type' => ['nullable', 'string'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'proponent_name' => ['nullable', 'string', 'max:255'],
            'inventor_name' => ['nullable', 'string', 'max:255'],
            'startup_name' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string'],
            'date_filed' => ['nullable', 'date'],
            'remarks' => ['nullable', 'string'],
            'viewed_details' => ['nullable', 'string'],
            'payload' => ['nullable', 'array'],
        ]);

        return $data;
    }

    private function authorizeAdmin(Request $request): void
    {
        abort_unless($request->user()->isAdmin(), 403);
    }

    private function authorizeAccess(Request $request, Application $application): void
    {
        abort_unless($request->user()->isAdmin() || $application->submitted_by === $request->user()->id, 403);
    }
}
