@extends('layouts.app')

@section('content')
<div class="animate-slide-up">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('dashboard') }}" class="transition hover:text-gray-700">Dashboard</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">Tech Transfer</span>
    </nav>

    <div class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1">
        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
        <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-widest">Tech Transfer / Commercialization</span>
    </div>
    <h2 class="mt-2 text-xl font-semibold text-gray-900">Technology Transfer Workflow</h2>
    <p class="mt-1 text-gray-500">The process starts with a consultation, then follows one of four service pathways toward commercialization.</p>

    {{-- Entry point --}}
    <div class="mt-6 rounded-xl border border-emerald-100 bg-emerald-50/40 p-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">1. Entry Point &amp; Initial Consultation</h3>
                    <p class="mt-1 text-sm text-gray-600">Initiate a consultation request, pick your preferred schedule from the calendar, and select the services you need.</p>
                </div>
            </div>
            <a href="{{ route('tech-transfer.apply') }}" class="inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 active:scale-95">
                Start Consultation
                <svg class="ml-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    {{-- Parallel service pathways --}}
    <h3 class="mt-8 text-base font-semibold text-gray-900">2. Parallel Service Pathways</h3>
    <div class="mt-4 grid gap-4 lg:grid-cols-4">
        {{-- Track A --}}
        <div class="rounded-xl border border-blue-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                <span class="text-sm font-bold">A</span>
            </div>
            <h4 class="mt-3 font-semibold text-gray-900">TRL Assessment</h4>
            <p class="mt-1 text-xs text-gray-500">Selects Technology Readiness Level assessment.</p>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• TRL 1–9 definition dropdown</p>
                <p>• Meeting decision: Reschedule / Approve</p>
                <p>• F2F meeting at USMart TBI Office</p>
                <p>• Attach narrative / report of tech</p>
                <p>• Reflects to admin side</p>
            </div>
        </div>

        {{-- Track B --}}
        <div class="rounded-xl border border-indigo-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                <span class="text-sm font-bold">B</span>
            </div>
            <h4 class="mt-3 font-semibold text-gray-900">Technology Packaging</h4>
            <p class="mt-1 text-xs text-gray-500">Selects tech packaging services.</p>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Admin alerted of request</p>
                <p>• Meeting decision: Reschedule / Approve</p>
                <p>• F2F meeting at USMart TBI Office</p>
            </div>
        </div>

        {{-- Track C --}}
        <div class="rounded-xl border border-emerald-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                <span class="text-sm font-bold">C</span>
            </div>
            <h4 class="mt-3 font-semibold text-gray-900">Mode of Transfer</h4>
            <p class="mt-1 text-xs text-gray-500">Primary commercialization / transfer pathway.</p>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Notify admin, status set to Pending</p>
                <p>• Admin sets mode of transfer status</p>
                <p>• Sub-modes: Licensing, Direct Sale, Extension, Spin-off</p>
                <p>• Submit requirements</p>
            </div>
        </div>

        {{-- Track D --}}
        <div class="rounded-xl border border-teal-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-teal-50 text-teal-600">
                <span class="text-sm font-bold">D</span>
            </div>
            <h4 class="mt-3 font-semibold text-gray-900">Other Services</h4>
            <p class="mt-1 text-xs text-gray-500">Custom or miscellaneous requests.</p>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Specify your request</p>
                <p>• Notify admin</p>
                <p>• Meeting decision: Reschedule / Approve</p>
                <p>• F2F meeting at USMart TBI Office</p>
            </div>
        </div>
    </div>

    {{-- Data consolidation --}}
    <div class="mt-8 rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">3. Data Consolidation &amp; Completion</h3>
                <p class="mt-1 text-sm text-gray-500">All pathways feed into a consolidated tracking table with IP no., mode of deployment, adopters, sectors, income, royalty, and remarks.</p>
            </div>
            <a href="{{ route('tech-transfer.data') }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-600 transition-all hover:bg-gray-50 hover:text-gray-900 hover:shadow-sm active:scale-95">
                View Data Table
                <svg class="ml-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
