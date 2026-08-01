@extends('layouts.app')

@section('content')
<div class="animate-slide-up">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('dashboard') }}" class="transition hover:text-gray-700">Dashboard</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <a href="{{ route('applications.ip-services') }}" class="transition hover:text-gray-700">IP Services</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">Intent to Receive Incentives</span>
    </nav>

    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
            <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Intent to Receive Incentives</span>
        </div>
        <h2 class="mt-2 text-lg font-semibold text-gray-900">Incentive Form</h2>
        <p class="mt-1 text-sm text-gray-500">Register your intent to receive IP incentives and support from the IPTTBDO.</p>

        <form method="POST" action="{{ route('applications.ip-incentives.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            {{-- Incentive Type --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Incentive Type <span class="text-red-500">*</span></label>
                <select name="incentive_type" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
                    <option value="" disabled selected>Select incentive type</option>
                    <option value="patent_incentive" @selected(old('incentive_type') === 'patent_incentive')>Patent Incentive</option>
                    <option value="utility_model_incentive" @selected(old('incentive_type') === 'utility_model_incentive')>Utility Model Incentive</option>
                    <option value="industrial_design_incentive" @selected(old('incentive_type') === 'industrial_design_incentive')>Industrial Design Incentive</option>
                    <option value="trademark_incentive" @selected(old('incentive_type') === 'trademark_incentive')>Trademark Incentive</option>
                    <option value="copyright_incentive" @selected(old('incentive_type') === 'copyright_incentive')>Copyright Incentive</option>
                    <option value="ip_commercialization_incentive" @selected(old('incentive_type') === 'ip_commercialization_incentive')>IP Commercialization Incentive</option>
                </select>
                @error('incentive_type')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Title of IP --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Title of IP / Innovation <span class="text-red-500">*</span></label>
                <input type="text" name="ip_title" value="{{ old('ip_title') }}" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30 placeholder-gray-400"
                    placeholder="Enter the title of your IP or innovation">
                @error('ip_title')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Proponent --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Proponent Name <span class="text-red-500">*</span></label>
                <input type="text" name="proponent_name" value="{{ old('proponent_name') }}" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30 placeholder-gray-400"
                    placeholder="Enter your full name">
                @error('proponent_name')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Affiliation / Department --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Affiliation / Department</label>
                <input type="text" name="affiliation" value="{{ old('affiliation') }}"
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30 placeholder-gray-400"
                    placeholder="e.g. College of Engineering, IPTTBDO, external institution">
                @error('affiliation')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- IP Application Status --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Current IP Application Status <span class="text-red-500">*</span></label>
                <select name="ip_status" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
                    <option value="" disabled selected>Select current status</option>
                    <option value="registered" @selected(old('ip_status') === 'registered')>Registered</option>
                    <option value="applied" @selected(old('ip_status') === 'applied')>Application Filed / Pending</option>
                    <option value="not_yet_applied" @selected(old('ip_status') === 'not_yet_applied')>Not Yet Applied</option>
                    <option value="commercialized" @selected(old('ip_status') === 'commercialized')>Already Commercialized</option>
                </select>
                @error('ip_status')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Description of the IP / Innovation <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30 placeholder-gray-400"
                    placeholder="Briefly describe the IP or innovation for which you are seeking incentives">{{ old('description') }}</textarea>
                @error('description')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Attach Supporting Documents --}}
            <div class="rounded-xl border border-amber-100 bg-amber-50/40 p-4">
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Attach Supporting Documents <span class="text-red-500">*</span></label>
                <p class="mb-2 text-xs italic text-gray-500">Attach certificates, IP registration papers, funding proposals, or other supporting documents. Accepted: PDF, DOC, DOCX, JPG, JPEG, PNG. Max 2MB each.</p>
                @include('applications._file-dropzone', [
                    'name' => 'documents[]',
                    'id' => 'incentive_documents',
                    'multiple' => true,
                    'required' => true,
                    'hint' => 'Attach at least one supporting document.',
                ])
                @error('documents')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
                @error('documents.*')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Application --}}
            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-amber-500 to-amber-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 active:scale-95">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Submit Application
                </button>
                <a href="{{ route('applications.ip-services') }}" class="text-sm font-medium text-gray-500 transition-all hover:text-gray-700 hover:underline underline-offset-4">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
