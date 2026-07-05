<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $applicationsQuery = Application::query()
            ->with('submittedBy')
            ->latest('date_filed')
            ->latest('id');

        if (! $user->isAdmin()) {
            $applicationsQuery->where('submitted_by', $user->id);
        }

        $applications = $applicationsQuery->limit(6)->get();

        $statsQuery = Application::query();

        if (! $user->isAdmin()) {
            $statsQuery->where('submitted_by', $user->id);
        }

        $stats = [
            'total' => (clone $statsQuery)->count(),
            'for_evaluation' => (clone $statsQuery)->where('status', Application::STATUS_FOR_EVALUATION)->count(),
            'reviewed' => (clone $statsQuery)->where('status', Application::STATUS_REVIEWED)->count(),
            'registered' => (clone $statsQuery)->where('status', Application::STATUS_REGISTERED)->count(),
        ];

        return view('dashboard', [
            'user' => $user,
            'applications' => $applications,
            'stats' => $stats,
        ]);
    }
}