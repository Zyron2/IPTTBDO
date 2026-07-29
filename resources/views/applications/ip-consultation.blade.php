@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto animate-slide-up">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('dashboard') }}" class="transition hover:text-gray-700">Dashboard</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <a href="{{ route('applications.ip-services') }}" class="transition hover:text-gray-700">IP Services</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">Consultation</span>
    </nav>

    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-teal-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-teal-500"></span>
            <span class="text-[11px] font-semibold text-teal-700 uppercase tracking-widest">Schedule</span>
        </div>
        <h2 class="mt-2 text-lg font-semibold text-gray-900">Book an IP Consultation</h2>
        <p class="mt-1 text-sm text-gray-500">Choose your preferred date and time, and an admin will confirm your appointment.</p>

        <form method="POST" action="{{ route('applications.ip-consultation.store') }}" class="mt-6 space-y-6">
            @csrf

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Preferred Date</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <input type="date" name="consultation_date" value="{{ old('consultation_date', now()->addDay()->toDateString()) }}" min="{{ now()->toDateString() }}"
                            class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100 focus:bg-teal-50/30">
                    </div>
                    @error('consultation_date')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Preferred Time</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <input type="time" name="consultation_time" value="{{ old('consultation_time', '09:00') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100 focus:bg-teal-50/30">
                    </div>
                    @error('consultation_time')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Your Name</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <input type="text" name="proponent_name" value="{{ old('proponent_name') }}" placeholder="Enter your full name"
                        class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100 focus:bg-teal-50/30">
                </div>
                @error('proponent_name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="rounded-lg border border-teal-100 bg-teal-50/50 p-4 text-sm text-teal-700">
                <div class="flex items-start gap-3">
                    <svg class="h-5 w-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>An admin will review your requested schedule and confirm the appointment. You will be notified once it's approved.</span>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-teal-500 to-teal-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-teal-600 hover:to-teal-500 hover:shadow-lg hover:shadow-teal-200/50 focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 active:scale-95">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Book Appointment
                </button>
                <a href="{{ route('applications.ip-services') }}" class="text-sm font-medium text-gray-500 transition-all hover:text-gray-700 hover:underline underline-offset-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection