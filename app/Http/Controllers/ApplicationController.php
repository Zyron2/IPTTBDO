<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewConsultationRequest;
use App\Notifications\NewPriorArtSearchRequest;
use App\Notifications\NewClaimsDraftingRequest;

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

    public function ipPriorArtSearch()
    {
        return view('applications.ip-prior-art-search');
    }

    public function storeIpPriorArtSearch(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'search_terms' => ['required', 'string', 'max:1000'],
            'overview_1' => ['required', 'string'],
            'overview_2' => ['required', 'string'],
            'overview_3' => ['required', 'string'],
            'overview_4' => ['required', 'string'],
            'technical_description' => ['required', 'string'],
            'prior_findings_1' => ['required', 'string'],
            'prior_findings_2' => ['required', 'string'],
            'development_stage' => ['required', 'string'],
            'potential_licensees' => ['required', 'string'],
            'publication_title' => ['nullable', 'string', 'max:500'],
            'publication_type' => ['nullable', 'string', 'max:255'],
            'publication_date' => ['nullable', 'string', 'max:100'],
            'conception_date' => ['nullable', 'string', 'max:255'],
            'reduction_date' => ['nullable', 'string', 'max:255'],
            'sponsorship' => ['nullable', 'string'],
            'agreements' => ['nullable', 'string'],
            'material_used' => ['nullable', 'string'],
            'material_used_details' => ['nullable', 'string'],
            'material_transferred' => ['nullable', 'string'],
            'material_transferred_details' => ['nullable', 'string'],
            'other_group_using' => ['nullable', 'string'],
            'other_group_details' => ['nullable', 'string'],
            'inventors' => ['nullable', 'array'],
            'inventors.*.name' => ['nullable', 'string', 'max:255'],
            'inventors.*.role' => ['nullable', 'string', 'max:255'],
            'corresponding_inventor' => ['nullable', 'string', 'max:255'],
            'corresponding_inventor_date' => ['nullable', 'string', 'max:100'],
            'dept_head_name' => ['nullable', 'string', 'max:255'],
            'dept_head_date' => ['nullable', 'string', 'max:100'],
            'inventor_name' => ['nullable', 'string', 'max:255'],
            'inventor_date' => ['nullable', 'string', 'max:100'],
            'disclosure_agreed' => ['required', 'string'],
            'policy_agreed' => ['required', 'string'],
        ]);

        $titleText = $data['title'];
        $application = Application::create([
            'branch' => 'ip',
            'application_type' => 'prior_art',
            'title' => $titleText,
            'submitted_by' => $request->user()->id,
            'tracking_no' => Application::generateTrackingNo('ip'),
            'status' => Application::STATUS_FOR_EVALUATION,
            'date_filed' => now()->toDateString(),
            'payload' => [
                'search_terms' => $data['search_terms'],
                'overview_1' => $data['overview_1'],
                'overview_2' => $data['overview_2'],
                'overview_3' => $data['overview_3'],
                'overview_4' => $data['overview_4'],
                'technical_description' => $data['technical_description'],
                'prior_findings_1' => $data['prior_findings_1'],
                'prior_findings_2' => $data['prior_findings_2'],
                'development_stage' => $data['development_stage'],
                'potential_licensees' => $data['potential_licensees'],
                'publication_title' => $data['publication_title'] ?? null,
                'publication_type' => $data['publication_type'] ?? null,
                'publication_date' => $data['publication_date'] ?? null,
                'conception_date' => $data['conception_date'] ?? null,
                'reduction_date' => $data['reduction_date'] ?? null,
                'sponsorship' => $data['sponsorship'] ?? null,
                'agreements' => $data['agreements'] ?? null,
                'material_used' => $data['material_used'] ?? null,
                'material_used_details' => $data['material_used_details'] ?? null,
                'material_transferred' => $data['material_transferred'] ?? null,
                'material_transferred_details' => $data['material_transferred_details'] ?? null,
                'other_group_using' => $data['other_group_using'] ?? null,
                'other_group_details' => $data['other_group_details'] ?? null,
                'inventors' => $data['inventors'] ?? null,
                'corresponding_inventor' => $data['corresponding_inventor'] ?? null,
                'corresponding_inventor_date' => $data['corresponding_inventor_date'] ?? null,
                'dept_head_name' => $data['dept_head_name'] ?? null,
                'dept_head_date' => $data['dept_head_date'] ?? null,
                'inventor_name' => $data['inventor_name'] ?? null,
                'inventor_date' => $data['inventor_date'] ?? null,
                'disclosure_agreed' => $data['disclosure_agreed'],
                'policy_agreed' => $data['policy_agreed'],
            ],
        ]);

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewPriorArtSearchRequest($application));

        return redirect()->route('applications.show', $application)
            ->with('success', 'Prior art search request submitted successfully.');
    }

    public function ipClaimsDrafting()
    {
        return view('applications.ip-claims-drafting');
    }

    public function storeIpClaimsDrafting(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'search_terms' => ['required', 'string', 'max:1000'],
            'overview_1' => ['required', 'string'],
            'overview_2' => ['required', 'string'],
            'overview_3' => ['required', 'string'],
            'overview_4' => ['required', 'string'],
            'technical_description' => ['required', 'string'],
            'prior_findings_1' => ['required', 'string'],
            'prior_findings_2' => ['required', 'string'],
            'development_stage' => ['required', 'string'],
            'potential_licensees' => ['required', 'string'],
            'publication_title' => ['nullable', 'string', 'max:500'],
            'publication_type' => ['nullable', 'string', 'max:255'],
            'publication_date' => ['nullable', 'string', 'max:100'],
            'conception_date' => ['nullable', 'string', 'max:255'],
            'reduction_date' => ['nullable', 'string', 'max:255'],
            'sponsorship' => ['nullable', 'string'],
            'agreements' => ['nullable', 'string'],
            'material_used' => ['nullable', 'string'],
            'material_used_details' => ['nullable', 'string'],
            'material_transferred' => ['nullable', 'string'],
            'material_transferred_details' => ['nullable', 'string'],
            'other_group_using' => ['nullable', 'string'],
            'other_group_details' => ['nullable', 'string'],
            'inventors' => ['nullable', 'array'],
            'inventors.*.name' => ['nullable', 'string', 'max:255'],
            'inventors.*.role' => ['nullable', 'string', 'max:255'],
            'corresponding_inventor' => ['nullable', 'string', 'max:255'],
            'corresponding_inventor_date' => ['nullable', 'string', 'max:100'],
            'dept_head_name' => ['nullable', 'string', 'max:255'],
            'dept_head_date' => ['nullable', 'string', 'max:100'],
            'inventor_name' => ['nullable', 'string', 'max:255'],
            'inventor_date' => ['nullable', 'string', 'max:100'],
            'disclosure_agreed' => ['required', 'string'],
            'policy_agreed' => ['required', 'string'],
        ]);

        $titleText = $data['title'];
        $application = Application::create([
            'branch' => 'ip',
            'application_type' => 'claims_drafting',
            'title' => $titleText,
            'submitted_by' => $request->user()->id,
            'tracking_no' => Application::generateTrackingNo('ip'),
            'status' => Application::STATUS_FOR_EVALUATION,
            'date_filed' => now()->toDateString(),
            'payload' => [
                'search_terms' => $data['search_terms'],
                'overview_1' => $data['overview_1'],
                'overview_2' => $data['overview_2'],
                'overview_3' => $data['overview_3'],
                'overview_4' => $data['overview_4'],
                'technical_description' => $data['technical_description'],
                'prior_findings_1' => $data['prior_findings_1'],
                'prior_findings_2' => $data['prior_findings_2'],
                'development_stage' => $data['development_stage'],
                'potential_licensees' => $data['potential_licensees'],
                'publication_title' => $data['publication_title'] ?? null,
                'publication_type' => $data['publication_type'] ?? null,
                'publication_date' => $data['publication_date'] ?? null,
                'conception_date' => $data['conception_date'] ?? null,
                'reduction_date' => $data['reduction_date'] ?? null,
                'sponsorship' => $data['sponsorship'] ?? null,
                'agreements' => $data['agreements'] ?? null,
                'material_used' => $data['material_used'] ?? null,
                'material_used_details' => $data['material_used_details'] ?? null,
                'material_transferred' => $data['material_transferred'] ?? null,
                'material_transferred_details' => $data['material_transferred_details'] ?? null,
                'other_group_using' => $data['other_group_using'] ?? null,
                'other_group_details' => $data['other_group_details'] ?? null,
                'inventors' => $data['inventors'] ?? null,
                'corresponding_inventor' => $data['corresponding_inventor'] ?? null,
                'corresponding_inventor_date' => $data['corresponding_inventor_date'] ?? null,
                'dept_head_name' => $data['dept_head_name'] ?? null,
                'dept_head_date' => $data['dept_head_date'] ?? null,
                'inventor_name' => $data['inventor_name'] ?? null,
                'inventor_date' => $data['inventor_date'] ?? null,
                'disclosure_agreed' => $data['disclosure_agreed'],
                'policy_agreed' => $data['policy_agreed'],
            ],
        ]);

        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewClaimsDraftingRequest($application));

        return redirect()->route('applications.show', $application)
            ->with('success', 'IP claims drafting request submitted successfully.');
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
