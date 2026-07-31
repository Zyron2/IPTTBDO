@extends('layouts.app')

@section('content')
<div class="animate-slide-up">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('dashboard') }}" class="transition hover:text-gray-700">Dashboard</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">IP Section</span>
    </nav>

    <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
        <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">IP Section</span>
    </div>
    <h2 class="mt-2 text-xl font-semibold text-gray-900">Intellectual Property Services</h2>
    <p class="mt-1 text-gray-500">Select an IP service to get started</p>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <a href="{{ route('applications.ip-prior-art-search') }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-blue-200">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition-all group-hover:bg-blue-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Prior Art Search</h3>
                <p class="mt-1 text-sm text-gray-500">Search existing patents and publications to assess novelty</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    Proceed
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <a href="{{ route('applications.ip-claims-drafting') }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-indigo-200">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition-all group-hover:bg-indigo-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">IP Claims Drafting</h3>
                <p class="mt-1 text-sm text-gray-500">Professional drafting of patent or IP claims</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    Proceed
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <a href="{{ route('applications.create', ['branch' => 'ip', 'type' => 'apply_protection']) }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-emerald-200">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition-all group-hover:bg-emerald-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Apply for IP Protection</h3>
                <p class="mt-1 text-sm text-gray-500">File for patent, trademark, or copyright protection</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    Proceed
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <a href="{{ route('applications.create', ['branch' => 'ip', 'type' => 'incentives']) }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-amber-200">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 transition-all group-hover:bg-amber-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Intent to Receive Incentives</h3>
                <p class="mt-1 text-sm text-gray-500">Register your intent to receive IP incentives and support</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    Proceed
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>

        <a href="{{ route('applications.ip-consultation') }}" class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-lg hover:-translate-y-0.5 hover:border-teal-200">
            <div class="absolute inset-0 bg-gradient-to-br from-teal-50/50 via-transparent to-transparent opacity-0 transition-opacity group-hover:opacity-100"></div>
            <div class="relative">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-teal-50 text-teal-600 transition-all group-hover:bg-teal-100 group-hover:scale-110 group-hover:shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900">Consultation</h3>
                <p class="mt-1 text-sm text-gray-500">Schedule an IP consultation with our experts</p>
                <span class="mt-3 inline-flex items-center text-sm font-medium text-amber-600 transition-all group-hover:text-amber-700 group-hover:gap-1.5">
                    Proceed
                    <svg class="ml-1 h-4 w-4 transition-all group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            </div>
        </a>
    </div>
</div>
@endsection