@extends('layouts.app')

@section('content')
<div class="animate-slide-up">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('dashboard') }}" class="transition hover:text-gray-700">Dashboard</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">Business Dev &amp; Incubation</span>
    </nav>

    <div class="inline-flex items-center gap-1.5 rounded-lg bg-purple-50 px-2.5 py-1">
        <span class="h-1.5 w-1.5 rounded-full bg-purple-500"></span>
        <span class="text-[11px] font-semibold text-purple-700 uppercase tracking-widest">Business Development &amp; Incubation</span>
    </div>
    <h2 class="mt-2 text-xl font-semibold text-gray-900">Incubation Application Flow</h2>
    <p class="mt-1 text-gray-500">Start with a consultation, choose your service track, and complete the incubation application.</p>

    {{-- Step 1: Initial contact --}}
    <div class="mt-6 rounded-xl border border-purple-100 bg-purple-50/40 p-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">1. Initial Contact &amp; Service Selection</h3>
                    <p class="mt-1 text-sm text-gray-600">Show calendar to choose schedule, then select one of four service tracks.</p>
                </div>
            </div>
            <a href="{{ route('bizdev.apply') }}" class="inline-flex items-center rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-purple-600 hover:to-purple-500 hover:shadow-lg hover:shadow-purple-200/50 focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 active:scale-95">
                Start Consultation
                <svg class="ml-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    {{-- Four tracks --}}
    <h3 class="mt-8 text-base font-semibold text-gray-900">2. Service Tracks</h3>
    <div class="mt-4 grid gap-4 lg:grid-cols-4">
        <div class="rounded-xl border border-blue-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                <span class="text-sm font-bold">A</span>
            </div>
            <h4 class="mt-3 font-semibold text-gray-900">Tech Pitching Presentation</h4>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Meeting scheduling</p>
                <p>• Face-to-face meeting</p>
                <p>• Notify admin</p>
                <p>• Confirmation / approval step</p>
                <p>• If approved → Apply Incubation</p>
                <p>• If rejected → standard message</p>
            </div>
        </div>

        <div class="rounded-xl border border-indigo-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                <span class="text-sm font-bold">B</span>
            </div>
            <h4 class="mt-3 font-semibold text-gray-900">Mentoring / Coaching</h4>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Meeting scheduling</p>
                <p>• Face-to-face meeting</p>
            </div>
        </div>

        <div class="rounded-xl border border-emerald-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                <span class="text-sm font-bold">C</span>
            </div>
            <h4 class="mt-3 font-semibold text-gray-900">Design Thinking</h4>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Meeting scheduling</p>
                <p>• Face-to-face meeting</p>
                <p>• Tech pitching</p>
            </div>
        </div>

        <div class="rounded-xl border border-purple-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                <span class="text-sm font-bold">D</span>
            </div>
            <h4 class="mt-3 font-semibold text-gray-900">Apply Incubation <span class="text-xs font-normal text-purple-500">(Main Track)</span></h4>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Directly enters the incubation application pipeline</p>
            </div>
        </div>
    </div>

    {{-- Pipeline overview --}}
    <h3 class="mt-8 text-base font-semibold text-gray-900">3. Incubation Pipeline</h3>
    <div class="mt-4 grid gap-4 lg:grid-cols-3">
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="inline-flex items-center gap-1.5 rounded-lg bg-gray-50 px-2.5 py-1">
                <span class="h-1.5 w-1.5 rounded-full bg-gray-500"></span>
                <span class="text-[11px] font-semibold text-gray-700 uppercase tracking-widest">TBI Selection &amp; Team</span>
            </div>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Choose USMart TBI or AGRIAQUA TBI</p>
                <p>• Terms and conditions display</p>
                <p>• Basic info: email, startup name, team leader, members, mobiles</p>
                <p>• Team skill needs check (YES / NO)</p>
            </div>
        </div>
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="inline-flex items-center gap-1.5 rounded-lg bg-gray-50 px-2.5 py-1">
                <span class="h-1.5 w-1.5 rounded-full bg-gray-500"></span>
                <span class="text-[11px] font-semibold text-gray-700 uppercase tracking-widest">Product, Market &amp; Readiness</span>
            </div>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Technology (invention) and startup overview</p>
                <p>• Problem / need, proposed solution</p>
                <p>• Target market, competitors, advantage</p>
                <p>• TRL / BRL / IRL assessments (0–9)</p>
                <p>• Commitment &amp; hindrances</p>
            </div>
        </div>
        <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="inline-flex items-center gap-1.5 rounded-lg bg-gray-50 px-2.5 py-1">
                <span class="h-1.5 w-1.5 rounded-full bg-gray-500"></span>
                <span class="text-[11px] font-semibold text-gray-700 uppercase tracking-widest">Documents &amp; Review</span>
            </div>
            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                <p>• Letter of Intent (PDF)</p>
                <p>• Team Leader's ID (image)</p>
                <p>• Final commitment acknowledgment</p>
                <p>• Admin evaluation (approve / revise)</p>
                <p>• Incubation program stages until graduation</p>
            </div>
        </div>
    </div>

    {{-- Data consolidation --}}
    <div class="mt-8 rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">4. Data Consolidation &amp; Completion</h3>
                <p class="mt-1 text-sm text-gray-500">Consolidated tracking of all business development and incubation applications.</p>
            </div>
            <a href="{{ route('bizdev.data') }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-600 transition-all hover:bg-gray-50 hover:text-gray-900 hover:shadow-sm active:scale-95">
                View Data Table
                <svg class="ml-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
