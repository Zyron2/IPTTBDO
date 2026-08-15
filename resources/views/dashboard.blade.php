@extends('layouts.app')

@section('content')
@if(!$user->isAdmin())
<div class="mb-10 animate-slide-up">
    <div class="flex items-center gap-3 mb-2">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
            <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Departments</span>
        </div>
    </div>
    <h2 class="text-xl font-semibold text-gray-900">Submit to a department</h2>
    <p class="mt-1 text-gray-500">Choose the appropriate section for your submission</p>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
        <a href="{{ route('applications.ip-services') }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-blue-200">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition-all group-hover:bg-blue-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">IP Section</h3>
                <p class="mt-1 text-sm text-gray-500">Prior art search, claims drafting, IP protection, incentives & consultation</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    View services
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <a href="{{ route('tech-transfer.index') }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-emerald-200">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition-all group-hover:bg-emerald-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Tech Transfer</h3>
                <p class="mt-1 text-sm text-gray-500">Commercialization of technologies, licensing</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    Start submission
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <a href="{{ route('applications.create', ['branch' => 'business_development']) }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-purple-200">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 transition-all group-hover:bg-purple-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Business Dev</h3>
                <p class="mt-1 text-sm text-gray-500">Business development, partnerships, growth</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    Start submission
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <a href="{{ route('applications.create', ['branch' => 'incubation']) }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-orange-200">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-600 transition-all group-hover:bg-orange-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Incubation</h3>
                <p class="mt-1 text-sm text-gray-500">Startup incubation, support programs</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    Start submission
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <a href="{{ route('applications.create', ['branch' => 'consultation']) }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-teal-200">
            <div class="absolute inset-0 bg-gradient-to-br from-teal-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-50 text-teal-600 transition-all group-hover:bg-teal-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Consultation</h3>
                <p class="mt-1 text-sm text-gray-500">Schedule an IP consultation appointment</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    Book appointment
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>
    </div>
</div>
@endif

<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 animate-slide-up" style="animation-delay: 0.1s">
    <div class="group relative overflow-hidden rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5">
        <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-amber-400 to-amber-300 opacity-0 transition-opacity group-hover:opacity-100"></div>
        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Total submissions</p>
        <p class="mt-2 text-3xl font-semibold text-gray-900 transition-all group-hover:text-amber-600">{{ $stats['total'] }}</p>
    </div>
    <div class="group relative overflow-hidden rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5">
        <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-blue-400 to-blue-300 opacity-0 transition-opacity group-hover:opacity-100"></div>
        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">For evaluation</p>
        <p class="mt-2 text-3xl font-semibold text-gray-900 transition-all group-hover:text-blue-600">{{ $stats['for_evaluation'] }}</p>
    </div>
    <div class="group relative overflow-hidden rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5">
        <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-purple-400 to-purple-300 opacity-0 transition-opacity group-hover:opacity-100"></div>
        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Reviewed</p>
        <p class="mt-2 text-3xl font-semibold text-gray-900 transition-all group-hover:text-purple-600">{{ $stats['reviewed'] }}</p>
    </div>
    <div class="group relative overflow-hidden rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5">
        <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-emerald-400 to-emerald-300 opacity-0 transition-opacity group-hover:opacity-100"></div>
        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Registered</p>
        <p class="mt-2 text-3xl font-semibold text-gray-900 transition-all group-hover:text-emerald-600">{{ $stats['registered'] }}</p>
    </div>
</div>

<div class="mt-8 grid gap-6 lg:grid-cols-[1.2fr_0.8fr] animate-slide-up" style="animation-delay: 0.2s">
    <section class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                    <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Workspace</span>
                </div>
                <h2 class="mt-2 text-lg font-semibold text-gray-900">{{ $user->isAdmin() ? 'Admin Dashboard' : 'Client Dashboard' }}</h2>
            </div>
            <a href="{{ route('applications.create') }}" class="group inline-flex items-center rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-amber-600 hover:shadow-md focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 active:scale-95">
                <svg class="mr-1.5 h-4 w-4 transition-all group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Submission
            </a>
        </div>

        <div class="mt-6 overflow-hidden rounded-lg border border-gray-100">
            <table class="min-w-full divide-y divide-gray-100 text-left text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">Tracking</th>
                        <th class="px-4 py-3 font-medium">Branch</th>
                        <th class="px-4 py-3 font-medium">Title</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 bg-white text-gray-600">
                    @forelse ($applications as $application)
                    <tr class="transition-all hover:bg-amber-50/50 hover:shadow-sm">
                        <td class="px-4 py-3 font-mono text-xs">{{ $application->tracking_no }}</td>
                        <td class="px-4 py-3">{{ $application->branchLabel() }}</td>
                        <td class="max-w-xs truncate px-4 py-3 font-medium text-gray-900">{{ $application->title }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 ring-1 ring-amber-200/50">{{ $application->statusLabel() }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('applications.show', $application) }}" class="font-medium text-amber-600 transition-all hover:text-amber-700 hover:gap-1.5 inline-flex items-center">
                                View
                                <svg class="ml-0.5 h-3.5 w-3.5 transition-all group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-400">
                            <svg class="mx-auto h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="mt-2">No submissions yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <aside class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
            <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Workflow</span>
        </div>
        <div class="mt-4 space-y-3 text-sm leading-relaxed text-gray-500">
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition-all hover:bg-gray-50 hover:shadow-sm hover:border-gray-200">
                <div class="flex items-start gap-3">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-amber-100 text-xs font-semibold text-amber-700">1</span>
                    <span>Role-aware dashboards route users based on their permissions after login.</span>
                </div>
            </div>
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition-all hover:bg-gray-50 hover:shadow-sm hover:border-gray-200">
                <div class="flex items-start gap-3">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-amber-100 text-xs font-semibold text-amber-700">2</span>
                    <span>Five branches available: IP, Tech Transfer, Business Development, Incubation, and Consultation.</span>
                </div>
            </div>
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition-all hover:bg-gray-50 hover:shadow-sm hover:border-gray-200">
                <div class="flex items-start gap-3">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-amber-100 text-xs font-semibold text-amber-700">3</span>
                    <span>Full submission lifecycle: review, filter, update, and download review details.</span>
                </div>
            </div>
        </div>
    </aside>
</div>
@endsection