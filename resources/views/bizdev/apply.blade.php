@extends('layouts.app')

@section('content')
<div class="animate-slide-up">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('dashboard') }}" class="transition hover:text-gray-700">Dashboard</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <a href="{{ route('bizdev.index') }}" class="transition hover:text-gray-700">Business Dev &amp; Incubation</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">Apply</span>
    </nav>

    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-purple-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-purple-500"></span>
            <span class="text-[11px] font-semibold text-purple-700 uppercase tracking-widest">Business Development &amp; Incubation</span>
        </div>
        <h2 class="mt-2 text-lg font-semibold text-gray-900">Consultation &amp; Service Selection</h2>
        <p class="mt-1 text-sm text-gray-500">Pick your preferred schedule and select one service track to begin.</p>

        <form method="POST" action="{{ route('bizdev.store') }}" class="mt-6 space-y-5">
            @csrf

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Select Schedule <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <input type="date" name="consultation_date" value="{{ old('consultation_date', now()->addDay()->toDateString()) }}" min="{{ now()->toDateString() }}"
                            class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">
                    </div>
                    @error('consultation_date')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Preferred Time <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <input type="time" name="consultation_time" value="{{ old('consultation_time', '09:00') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">
                    </div>
                    @error('consultation_time')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Your Name <span class="text-red-500">*</span></label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <input type="text" name="proponent_name" value="{{ old('proponent_name') }}" required placeholder="Enter your full name"
                        class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">
                </div>
                @error('proponent_name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Select Service Track <span class="text-red-500">*</span></label>
                <p class="mb-2 text-xs italic text-gray-500">Choose one track. Apply Incubation is the main track.</p>
                <div class="grid gap-3 sm:grid-cols-2">
                    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-blue-100 bg-blue-50/40 p-4 transition-all hover:border-blue-300 hover:shadow-sm">
                        <input type="radio" name="track" value="tech_pitching" @checked(old('track') === 'tech_pitching') class="mt-1 h-4 w-4 accent-blue-600">
                        <span>
                            <span class="block text-sm font-semibold text-gray-900">Track A — Tech Pitching Presentation</span>
                            <span class="mt-0.5 block text-xs text-gray-500">Present your idea. Leads to Apply Incubation if approved.</span>
                        </span>
                    </label>
                    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-indigo-100 bg-indigo-50/40 p-4 transition-all hover:border-indigo-300 hover:shadow-sm">
                        <input type="radio" name="track" value="mentoring" @checked(old('track') === 'mentoring') class="mt-1 h-4 w-4 accent-indigo-600">
                        <span>
                            <span class="block text-sm font-semibold text-gray-900">Track B — Mentoring / Coaching</span>
                            <span class="mt-0.5 block text-xs text-gray-500">Schedule a face-to-face mentoring session.</span>
                        </span>
                    </label>
                    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-emerald-100 bg-emerald-50/40 p-4 transition-all hover:border-emerald-300 hover:shadow-sm">
                        <input type="radio" name="track" value="design_thinking" @checked(old('track') === 'design_thinking') class="mt-1 h-4 w-4 accent-emerald-600">
                        <span>
                            <span class="block text-sm font-semibold text-gray-900">Track C — Design Thinking</span>
                            <span class="mt-0.5 block text-xs text-gray-500">Design thinking workshop leading to tech pitching.</span>
                        </span>
                    </label>
                    <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-purple-100 bg-purple-50/40 p-4 transition-all hover:border-purple-300 hover:shadow-sm">
                        <input type="radio" name="track" value="apply_incubation" @checked(old('track') === 'apply_incubation') class="mt-1 h-4 w-4 accent-purple-600">
                        <span>
                            <span class="block text-sm font-semibold text-gray-900">Track D — Apply Incubation <span class="text-xs font-normal text-purple-500">(Main)</span></span>
                            <span class="mt-0.5 block text-xs text-gray-500">Directly enter the incubation application pipeline.</span>
                        </span>
                    </label>
                </div>
                @error('track')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Startup / Project Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Enter your startup or project title"
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">
                @error('title')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Brief Description</label>
                <textarea name="description" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" placeholder="Optional — brief note about your request">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center justify-end pt-2">
                <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-purple-600 hover:to-purple-500 hover:shadow-lg hover:shadow-purple-200/50 focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 active:scale-95">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Submit Consultation
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
