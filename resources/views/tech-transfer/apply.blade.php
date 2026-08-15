@extends('layouts.app')

@section('content')
<div class="animate-slide-up">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('dashboard') }}" class="transition hover:text-gray-700">Dashboard</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <a href="{{ route('tech-transfer.index') }}" class="transition hover:text-gray-700">Tech Transfer</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">Apply</span>
    </nav>

    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
            <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-widest">Tech Transfer / Commercialization</span>
        </div>
        <h2 class="mt-2 text-lg font-semibold text-gray-900">Tech Transfer Request</h2>
        <p class="mt-1 text-sm text-gray-500">Complete your consultation and select the services you need.</p>

        <form method="POST" action="{{ route('tech-transfer.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            {{-- Step 1: Consultation --}}
            <div id="wizard-step-1" class="space-y-5">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-100 text-sm font-semibold text-emerald-700">1</span>
                    <span class="text-sm font-semibold text-gray-900">Entry Point &amp; Initial Consultation</span>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Select Schedule <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <input type="date" name="consultation_date" value="{{ old('consultation_date', now()->addDay()->toDateString()) }}" min="{{ now()->toDateString() }}"
                                class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-emerald-50/30">
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
                                class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-emerald-50/30">
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
                            class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-emerald-50/30">
                    </div>
                    @error('proponent_name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Select Services <span class="text-red-500">*</span></label>
                    <p class="mb-2 text-xs italic text-gray-500">Choose one or more service pathways.</p>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-blue-100 bg-blue-50/40 p-4 transition-all hover:border-blue-300 hover:shadow-sm">
                            <input type="checkbox" name="services[]" value="trl_assessment" @checked(in_array('trl_assessment', old('services', []))) class="mt-1 h-4 w-4 accent-blue-600">
                            <span>
                                <span class="block text-sm font-semibold text-gray-900">Track A — TRL Assessment</span>
                                <span class="mt-0.5 block text-xs text-gray-500">Technology Readiness Level assessment (TRL 1–9)</span>
                            </span>
                        </label>
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-indigo-100 bg-indigo-50/40 p-4 transition-all hover:border-indigo-300 hover:shadow-sm">
                            <input type="checkbox" name="services[]" value="technology_packaging" @checked(in_array('technology_packaging', old('services', []))) class="mt-1 h-4 w-4 accent-indigo-600">
                            <span>
                                <span class="block text-sm font-semibold text-gray-900">Track B — Technology Packaging</span>
                                <span class="mt-0.5 block text-xs text-gray-500">Tech packaging services</span>
                            </span>
                        </label>
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-emerald-100 bg-emerald-50/40 p-4 transition-all hover:border-emerald-300 hover:shadow-sm">
                            <input type="checkbox" name="services[]" value="mode_of_transfer" @checked(in_array('mode_of_transfer', old('services', []))) class="mt-1 h-4 w-4 accent-emerald-600">
                            <span>
                                <span class="block text-sm font-semibold text-gray-900">Track C — Mode of Transfer</span>
                                <span class="mt-0.5 block text-xs text-gray-500">Licensing, direct sale, extension, or spin-off</span>
                            </span>
                        </label>
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-teal-100 bg-teal-50/40 p-4 transition-all hover:border-teal-300 hover:shadow-sm">
                            <input type="checkbox" name="services[]" value="other_services" @checked(in_array('other_services', old('services', []))) class="mt-1 h-4 w-4 accent-teal-600">
                            <span>
                                <span class="block text-sm font-semibold text-gray-900">Track D — Other Services</span>
                                <span class="mt-0.5 block text-xs text-gray-500">Custom or miscellaneous requests</span>
                            </span>
                        </label>
                    </div>
                    @error('services')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Title / Technology <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-emerald-50/30"
                        placeholder="Enter the technology / invention title">
                    @error('title')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end pt-2">
                    <button type="button" onclick="goToStep(2)" class="inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 active:scale-95">
                        Next
                        <svg class="ml-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Step 2: Parallel service pathways --}}
            <div id="wizard-step-2" class="hidden space-y-6">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-100 text-sm font-semibold text-emerald-700">2</span>
                    <span class="text-sm font-semibold text-gray-900">Service Pathway Details</span>
                </div>

                {{-- Track A: TRL Assessment --}}
                <div id="track-trl_assessment" class="tt-track space-y-4 rounded-xl border border-blue-100 bg-blue-50/30 p-5" style="display:none">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-2.5 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                        <span class="text-[11px] font-semibold text-blue-700 uppercase tracking-widest">Track A — TRL Assessment</span>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Narrative / Report of Tech</label>
                        <textarea name="trl_narrative" rows="4" class="w-full rounded-lg border border-blue-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400" placeholder="Describe your technology so the admin can assess its readiness level">{{ old('trl_narrative') }}</textarea>
                        <p class="mt-1.5 text-xs italic text-gray-500">The admin will assess and set your TRL level (1–9) after review. The result will be reflected on your application.</p>
                    </div>
                </div>

                {{-- Track B: Technology Packaging --}}
                <div id="track-technology_packaging" class="tt-track space-y-4 rounded-xl border border-indigo-100 bg-indigo-50/30 p-5" style="display:none">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-2.5 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                        <span class="text-[11px] font-semibold text-indigo-700 uppercase tracking-widest">Track B — Technology Packaging</span>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Packaging Service</label>
                        <input type="text" name="packaging_service" value="{{ old('packaging_service') }}"
                            class="w-full rounded-lg border border-indigo-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 placeholder-gray-400"
                            placeholder="Describe the packaging service needed">
                    </div>
                </div>

                {{-- Track C: Mode of Transfer --}}
                <div id="track-mode_of_transfer" class="tt-track space-y-4 rounded-xl border border-emerald-100 bg-emerald-50/30 p-5" style="display:none">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-widest">Track C — Mode of Transfer</span>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Mode of Transfer <span class="text-red-500">*</span></label>
                        <select name="mode_of_transfer" class="w-full rounded-lg border border-emerald-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">
                            <option value="" disabled selected>Select mode of transfer</option>
                            <option value="licensing" @selected(old('mode_of_transfer') === 'licensing')>Licensing</option>
                            <option value="direct_sale" @selected(old('mode_of_transfer') === 'direct_sale')>Direct Sale</option>
                            <option value="extension" @selected(old('mode_of_transfer') === 'extension')>Extension</option>
                            <option value="spin_off" @selected(old('mode_of_transfer') === 'spin_off')>Spin-off</option>
                        </select>
                        @error('mode_of_transfer')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="rounded-lg border border-emerald-200 bg-white p-4">
                        <p class="mb-2 text-sm font-medium text-gray-700">Meeting Decision</p>
                        <p class="text-xs text-gray-500">Admin will set the meeting status. "Approve" proceeds to the USMart TBI Office for a face-to-face meeting; "Reschedule" loops back to select a new date/time.</p>
                    </div>
                </div>

                {{-- Track D: Other Services --}}
                <div id="track-other_services" class="tt-track space-y-4 rounded-xl border border-teal-100 bg-teal-50/30 p-5" style="display:none">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-teal-50 px-2.5 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-teal-500"></span>
                        <span class="text-[11px] font-semibold text-teal-700 uppercase tracking-widest">Track D — Other Services</span>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Please Specify <span class="text-red-500">*</span></label>
                        <input type="text" name="other_service_details" value="{{ old('other_service_details') }}"
                            class="w-full rounded-lg border border-teal-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100 placeholder-gray-400"
                            placeholder="Detail your custom or miscellaneous request">
                    </div>
                </div>

                {{-- Supporting documents --}}
                <div class="rounded-xl border border-emerald-100 bg-emerald-50/40 p-4">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Attach Supporting Documents</label>
                    <p class="mb-2 text-xs italic text-gray-500">Attach narrative reports, requirements, or other supporting documents. Accepted: PDF, DOC, DOCX, JPG, JPEG, PNG. Max 2MB each.</p>
                    @include('applications._file-dropzone', [
                        'name' => 'documents[]',
                        'id' => 'tech_transfer_documents',
                        'multiple' => true,
                        'required' => false,
                        'hint' => 'Optional but recommended.',
                    ])
                    @error('documents')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between gap-4 pt-2">
                    <button type="button" onclick="goToStep(1)" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-600 transition-all hover:bg-gray-50 hover:text-gray-900 active:scale-95">
                        <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back
                    </button>
                    <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 active:scale-95">
                        <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Submit Application
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function syncTracks() {
        var checked = Array.prototype.map.call(
            document.querySelectorAll('input[name="services[]"]:checked'),
            function (c) { return c.value; }
        );
        document.querySelectorAll('.tt-track').forEach(function (track) {
            var active = checked.indexOf(track.id.replace('track-', '')) !== -1;
            track.style.display = active ? 'block' : 'none';
            track.querySelectorAll('input, select, textarea').forEach(function (field) {
                field.disabled = !active;
            });
        });
    }

    function goToStep(step) {
        var step1 = document.getElementById('wizard-step-1');
        var step2 = document.getElementById('wizard-step-2');
        if (step === 2) {
            var checked = document.querySelector('input[name="services[]"]:checked');
            if (!checked) {
                alert('Please select at least one service pathway.');
                return;
            }
            syncTracks();
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
        } else {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input[name="services[]"]').forEach(function (cb) {
            cb.addEventListener('change', syncTracks);
        });
        var any = document.querySelector('input[name="services[]"]:checked');
        if (any) syncTracks();
    });
</script>
@endpush
@endsection
