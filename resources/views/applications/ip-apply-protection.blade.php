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
        <span class="text-gray-900 font-medium">Apply for IP Protection</span>
    </nav>

    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
            <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-widest">Apply for IP Protection</span>
        </div>
        <h2 class="mt-2 text-lg font-semibold text-gray-900">IP Protection Application</h2>
        <p class="mt-1 text-sm text-gray-500">Complete the initial selection, then the details and document attachment for your chosen IP type.</p>

        <div class="mt-6 flex items-center gap-3">
            <div id="step-badge-1" class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-semibold text-emerald-700">
                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-500 text-white">1</span>
                Initial Selection
            </div>
            <svg class="h-4 w-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <div id="step-badge-2" class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3.5 py-1 text-xs font-semibold text-gray-500">
                <span class="flex h-5 w-5 items-center justify-center rounded-full bg-gray-400 text-white">2</span>
                Details &amp; Attachment
            </div>
        </div>

        <form method="POST" action="{{ route('applications.ip-apply-protection.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
            @csrf

            {{-- STEP 1: Initial Selection --}}
            <div id="wizard-step-1" class="space-y-5">
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">IP Type <span class="text-red-500">*</span></label>
                    <select name="ip_type" id="ip_type" required
                        class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-emerald-50/30">
                        <option value="" disabled selected>Select IP type</option>
                        <option value="patent" @selected(old('ip_type') === 'patent')>Patent</option>
                        <option value="um" @selected(old('ip_type') === 'um')>Utility Model (UM)</option>
                        <option value="id" @selected(old('ip_type') === 'id')>Industrial Design (ID)</option>
                        <option value="trademark" @selected(old('ip_type') === 'trademark')>Trademark</option>
                        <option value="copyright" @selected(old('ip_type') === 'copyright')>Copyright</option>
                    </select>
                    @error('ip_type')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">IP Ownership <span class="text-red-500">*</span></label>
                    <select name="ip_ownership" required
                        class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-emerald-50/30">
                        <option value="" disabled selected>Select ownership</option>
                        <option value="university" @selected(old('ip_ownership') === 'university')>University</option>
                        <option value="external" @selected(old('ip_ownership') === 'external')>External</option>
                    </select>
                    @error('ip_ownership')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-xl border border-emerald-100 bg-emerald-50/40 p-4">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700">Derived from research funded? <span class="text-red-500">*</span></label>
                    <div class="flex gap-3">
                        <label class="inline-flex items-center">
                            <input type="radio" name="research_funded" value="yes" class="mr-1.5" onchange="toggleFundingSource(this)" @checked(old('research_funded') === 'yes')> YES
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="research_funded" value="no" class="mr-1.5" onchange="toggleFundingSource(this)" @checked(old('research_funded') === 'no')> NO
                        </label>
                    </div>
                    <div id="funding_source_wrap" class="mt-3" style="display:none">
                        <label class="mb-1.5 block text-xs font-medium text-gray-500">Funding Source <span class="text-red-500">*</span></label>
                        <select name="funding_source" class="w-full rounded-lg border border-emerald-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">
                            <option value="" disabled selected>Select funding source</option>
                            <option value="external" @selected(old('funding_source') === 'external')>External</option>
                            <option value="locally_funded" @selected(old('funding_source') === 'locally_funded')>Locally Funded</option>
                        </select>
                    </div>
                    @error('research_funded')
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

            {{-- STEP 2: Dynamic details + attachment --}}
            <div id="wizard-step-2" class="hidden space-y-6">
                {{-- Patent --}}
                <div id="section-patent" class="ip-section space-y-4" style="display:none">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-blue-50 px-2.5 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                        <span class="text-[11px] font-semibold text-blue-700 uppercase tracking-widest">Patent Form</span>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Title of Invention <span class="text-red-500">*</span></label>
                        <input type="text" name="patent_invention_title" value="{{ old('patent_invention_title') }}" data-rq
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400">
                        @error('patent_invention_title')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Inventors <span class="text-red-500">*</span></label>
                        <textarea name="patent_inventors" rows="2" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400" placeholder="List all inventors">{{ old('patent_inventors') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Abstract <span class="text-red-500">*</span></label>
                        <textarea name="patent_abstract" rows="3" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400" placeholder="Provide a concise abstract">{{ old('patent_abstract') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Claims <span class="text-red-500">*</span></label>
                        <textarea name="patent_claims" rows="4" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400" placeholder="State the scope of protection sought">{{ old('patent_claims') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Detailed Description <span class="text-red-500">*</span></label>
                        <textarea name="patent_description" rows="4" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400" placeholder="Describe the invention in detail">{{ old('patent_description') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Priority Date</label>
                        <input type="date" name="patent_priority_date" value="{{ old('patent_priority_date') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                    </div>
                </div>

                {{-- Utility Model --}}
                <div id="section-um" class="ip-section space-y-4" style="display:none">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-teal-50 px-2.5 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-teal-500"></span>
                        <span class="text-[11px] font-semibold text-teal-700 uppercase tracking-widest">Utility Model Form</span>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Title of Utility Model <span class="text-red-500">*</span></label>
                        <input type="text" name="um_title" value="{{ old('um_title') }}" data-rq
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100 placeholder-gray-400">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Inventors <span class="text-red-500">*</span></label>
                        <textarea name="um_inventors" rows="2" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100 placeholder-gray-400" placeholder="List all inventors">{{ old('um_inventors') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Abstract <span class="text-red-500">*</span></label>
                        <textarea name="um_abstract" rows="3" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100 placeholder-gray-400" placeholder="Provide a concise abstract">{{ old('um_abstract') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Claims <span class="text-red-500">*</span></label>
                        <textarea name="um_claims" rows="4" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100 placeholder-gray-400" placeholder="State the scope of protection sought">{{ old('um_claims') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Detailed Description <span class="text-red-500">*</span></label>
                        <textarea name="um_description" rows="4" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100 placeholder-gray-400" placeholder="Describe the utility model in detail">{{ old('um_description') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Priority Date</label>
                        <input type="date" name="um_priority_date" value="{{ old('um_priority_date') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-teal-400 focus:ring-2 focus:ring-teal-100">
                    </div>
                </div>

                {{-- Industrial Design --}}
                <div id="section-id" class="ip-section space-y-4" style="display:none">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-2.5 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                        <span class="text-[11px] font-semibold text-indigo-700 uppercase tracking-widest">Industrial Design Form</span>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Title of Design <span class="text-red-500">*</span></label>
                        <input type="text" name="id_title" value="{{ old('id_title') }}" data-rq
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 placeholder-gray-400">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Designer <span class="text-red-500">*</span></label>
                        <input type="text" name="id_designer" value="{{ old('id_designer') }}" data-rq
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 placeholder-gray-400">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Description of Design <span class="text-red-500">*</span></label>
                        <textarea name="id_description" rows="4" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 placeholder-gray-400" placeholder="Describe the visual features of the design">{{ old('id_description') }}</textarea>
                    </div>
                </div>

                {{-- Trademark --}}
                <div id="section-trademark" class="ip-section space-y-4" style="display:none">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Trademark Form</span>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Mark Name <span class="text-red-500">*</span></label>
                        <input type="text" name="tm_mark_name" value="{{ old('tm_mark_name') }}" data-rq
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 placeholder-gray-400">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Owner Name <span class="text-red-500">*</span></label>
                        <input type="text" name="tm_owner_name" value="{{ old('tm_owner_name') }}" data-rq
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 placeholder-gray-400">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Classes <span class="text-red-500">*</span></label>
                        <input type="text" name="tm_classes" value="{{ old('tm_classes') }}" data-rq
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 placeholder-gray-400"
                            placeholder="e.g. Class 35 (Advertising), Class 41 (Education)">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Description of Mark <span class="text-red-500">*</span></label>
                        <textarea name="tm_description" rows="3" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 placeholder-gray-400" placeholder="Describe the mark and its use">{{ old('tm_description') }}</textarea>
                    </div>
                </div>

                {{-- Copyright --}}
                <div id="section-copyright" class="ip-section space-y-4" style="display:none">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-rose-50 px-2.5 py-1">
                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                        <span class="text-[11px] font-semibold text-rose-700 uppercase tracking-widest">Copyright Form</span>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Title of Work <span class="text-red-500">*</span></label>
                        <input type="text" name="cr_title" value="{{ old('cr_title') }}" data-rq
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-rose-400 focus:ring-2 focus:ring-rose-100 placeholder-gray-400">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Author <span class="text-red-500">*</span></label>
                        <input type="text" name="cr_author" value="{{ old('cr_author') }}" data-rq
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-rose-400 focus:ring-2 focus:ring-rose-100 placeholder-gray-400">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Date Created</label>
                        <input type="date" name="cr_date_created" value="{{ old('cr_date_created') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-rose-400 focus:ring-2 focus:ring-rose-100">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Type of Work <span class="text-red-500">*</span></label>
                        <select name="cr_type" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-rose-400 focus:ring-2 focus:ring-rose-100">
                            <option value="" disabled selected>Select type of work</option>
                            @foreach(['Literary', 'Musical', 'Artistic', 'Dramatic', 'Audiovisual', 'Photographic', 'Computer Program', 'Other'] as $type)
                            <option value="{{ $type }}" @selected(old('cr_type') === $type)>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Description of Work <span class="text-red-500">*</span></label>
                        <textarea name="cr_description" rows="3" data-rq class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-rose-400 focus:ring-2 focus:ring-rose-100 placeholder-gray-400" placeholder="Describe the work">{{ old('cr_description') }}</textarea>
                    </div>
                </div>

                {{-- Document Dropbox --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Documents <span class="text-red-500">*</span></label>
                    <p class="mb-2 text-xs italic text-gray-500">Upload the relevant documents for your selected IP type, plus any additional supporting documents. Accepted: PDF, DOC, DOCX, JPG, JPEG, PNG, ZIP. Max 2MB each.</p>
                    @include('applications._file-dropzone', [
                        'name' => 'documents[]',
                        'id' => 'apply_protection_documents',
                        'multiple' => true,
                        'required' => true,
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
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
    function toggleFundingSource(el) {
        var wrap = document.getElementById('funding_source_wrap');
        var select = wrap.querySelector('select');
        var show = el.value === 'yes';
        wrap.style.display = show ? 'block' : 'none';
        select.disabled = !show;
    }

    function syncSections(type) {
        document.querySelectorAll('.ip-section').forEach(function (section) {
            var active = section.id === 'section-' + type;
            section.style.display = active ? 'block' : 'none';
            section.querySelectorAll('[name], select, input, textarea').forEach(function (field) {
                field.disabled = !active;
                if (active && field.hasAttribute('data-rq')) {
                    field.setAttribute('required', '');
                } else {
                    field.removeAttribute('required');
                }
            });
        });
    }

    function goToStep(step) {
        var step1 = document.getElementById('wizard-step-1');
        var step2 = document.getElementById('wizard-step-2');
        var badge1 = document.getElementById('step-badge-1');
        var badge2 = document.getElementById('step-badge-2');

        if (step === 2) {
            var selects = step1.querySelectorAll('select');
            var radios = step1.querySelectorAll('input[type="radio"]');
            var checked = step1.querySelector('input[type="radio"]:checked');
            var valid = true;
            selects.forEach(function (s) {
                if (!s.disabled && !s.value) valid = false;
            });
            if (!checked) valid = false;
            if (!valid) {
                alert('Please complete all required fields in the Initial Selection.');
                return;
            }
            syncSections(document.getElementById('ip_type').value);
            step1.classList.add('hidden');
            step2.classList.remove('hidden');
            badge1.className = 'inline-flex items-center gap-2 rounded-full bg-gray-100 px-3.5 py-1 text-xs font-semibold text-gray-500';
            badge2.className = 'inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-semibold text-emerald-700';
        } else {
            step2.classList.add('hidden');
            step1.classList.remove('hidden');
            badge2.className = 'inline-flex items-center gap-2 rounded-full bg-gray-100 px-3.5 py-1 text-xs font-semibold text-gray-500';
            badge1.className = 'inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3.5 py-1 text-xs font-semibold text-emerald-700';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('ip_type').addEventListener('change', function () {
            syncSections(this.value);
        });

        var funded = document.querySelector('input[name="research_funded"]:checked');
        if (funded) toggleFundingSource(funded);

        if (document.getElementById('ip_type').value) {
            syncSections(document.getElementById('ip_type').value);
        }
    });
</script>
@endpush
@endsection
