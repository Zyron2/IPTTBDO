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
        <span class="text-gray-900 font-medium">IP Claims Drafting</span>
    </nav>

    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
            <span class="text-[11px] font-semibold text-indigo-700 uppercase tracking-widest">IP Claims Drafting</span>
        </div>
        <h2 class="mt-2 text-lg font-semibold text-gray-900">IP Claims Drafting Request</h2>
        <p class="mt-1 text-sm text-gray-500">Fill out the form below to request IP claims drafting from the IPTTBDO.</p>

        <form method="POST" action="{{ route('applications.ip-claims-drafting.store') }}" class="mt-6 space-y-6">
            @csrf

            {{-- 1. prior art search --}}
            <input type="hidden" name="section" value="claims_drafting">

            {{-- 2. Title or the Invention/Technology --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Title or the Invention/Technology</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note: the Title should described what the invention/technology does, but not how it made or how it works/functions.</p>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                    placeholder="Enter the title of your invention/technology">
                @error('title')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 3. Search Terms (up to 10) --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Search Terms (up to 10)</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note: Please provide search terms that categorize your invention as to type of technology. Industry and market segment it caters to, likely application, etc. This will aid the IPTTBDO in doing patent search as well as in due diligence to assess the commercial potential of your work.</p>
                <input type="text" name="search_terms" value="{{ old('search_terms') }}" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                    placeholder="Enter up to 10 search terms, separated by commas">
                @error('search_terms')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 4. Brief Overview of invention (3-4 paragraphs) --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Brief Overview of invention (3-4 paragraphs)</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note:</p>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">1. In layperson's terms, please provide a short description of your invention/technology and how it works.</p>
                        <textarea name="overview_1" rows="3" required
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                            placeholder="Describe your invention in layperson's terms...">{{ old('overview_1') }}</textarea>
                    </div>
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">2. What is the likely application of your invention? For example, "Which unmet need does it address, or which unexplored market does it target?</p>
                        <textarea name="overview_2" rows="3" required
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                            placeholder="Describe the likely application, unmet need, or target market...">{{ old('overview_2') }}</textarea>
                    </div>
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">3. Is it a new product, process, or composition of matter? Or is it a new use for or improvement of an existing product, process or composition of matter?</p>
                        <textarea name="overview_3" rows="3" required
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                            placeholder="Describe what your invention is (new product, process, improvement, etc.)...">{{ old('overview_3') }}</textarea>
                    </div>
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">4. What benefits can the invention give? (Please use extra sheet/s if necessary)</p>
                        <textarea name="overview_4" rows="3" required
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                            placeholder="Describe the benefits of your invention...">{{ old('overview_4') }}</textarea>
                    </div>
                </div>
                @error('overview_1')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
                @error('overview_2')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
                @error('overview_3')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
                @error('overview_4')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 5. Technical Description, Details and Supporting Data --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Technical Description, Details and Supporting Data</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note: Please provide data (proof-of-concept / functional data, where available) or other evidence which demonstrate how the invention works, or how your research findings can have commercial or industrial applications. You may attach papers, pilot projects or visual material, published or unpublished, in response to this question.</p>
                <textarea name="technical_description" rows="5" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                    placeholder="Provide technical description, data, proof-of-concept, and supporting evidence...">{{ old('technical_description') }}</textarea>
                @error('technical_description')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 6. Prior Findings, Methods, Apparatus, or Developments --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Prior Findings, Methods, Apparatus, or Developments</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note:</p>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">1. Findings, methods, or apparatus in existence / reported closest to yours and the problems of each that the present disclosure solves</p>
                        <textarea name="prior_findings_1" rows="4" required
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                            placeholder="Describe existing findings/methods/apparatus closest to yours...">{{ old('prior_findings_1') }}</textarea>
                    </div>
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">2. Cite any of your own publications and patents, and those of anyone else believed by you to disclose ideas most likely closely related to the invention / research finding. Please attach all relevant publications, patents, advertisements, etc. If available. Please consult the IPTTBDO on how to do Prior Art Search.</p>
                        <textarea name="prior_findings_2" rows="4" required
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                            placeholder="Cite relevant publications, patents, and prior art references...">{{ old('prior_findings_2') }}</textarea>
                    </div>
                </div>
                @error('prior_findings_1')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
                @error('prior_findings_2')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 7. Stage of Development (2-3 paragraphs) --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Stage of Development (2-3 paragraphs)</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note: Describe the development status (concept only, laboratory tested, prototype, etc) and briefly indicate what further development may be necessary to commercialize it.</p>
                <textarea name="development_stage" rows="5" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                    placeholder="Describe the development status and further steps needed for commercialization...">{{ old('development_stage') }}</textarea>
                @error('development_stage')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 8. Potential Licensee, Co-development Partners/End Users --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Potential Licensee, Co-development Partners/End Users</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note: Identify companies or market segments that you think could benefit from your invention/findings.</p>
                <textarea name="potential_licensees" rows="3" required
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                    placeholder="Identify potential licensees, co-development partners, or end users...">{{ old('potential_licensees') }}</textarea>
                @error('potential_licensees')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 9. Publications/Presentations/ and Other Forms of Public Communication --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Publications/Presentations/ and Other Forms of Public Communication (Discl...</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note:</p>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">1. Please identify all past and future seminars, conferences, posters, abstracts, publications (including proceedings), web postings, and other venues wherein your work was or may be publicly disclosed. These may affect the scope of patent protection and the timing of filing.</p>
                        <input type="text" name="publication_title" value="{{ old('publication_title') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                            placeholder="Enter the title or description of the publication/presentation">
                    </div>
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">2. Kindly attach a copy of said publications or presentations. Disclosure is the oral, written, or electronic dissemination of the invention to a person outside the University of the Philippines that would enable someone of ordinary skill working in the field to practice the invention or repeat its development.</p>
                        <p class="text-xs text-gray-400">(File attachment not yet available in this form — please submit physical copies to the IPTTBDO office.)</p>
                    </div>
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">3. Type of disclosure (i.e. publications, posters, etc)</p>
                        <input type="text" name="publication_type" value="{{ old('publication_type') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                            placeholder="e.g. publication, poster, seminar, conference, etc.">
                    </div>
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">4. Date</p>
                        <input type="date" name="publication_date" value="{{ old('publication_date') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30">
                    </div>
                </div>
                @error('publication_title')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 10. Dates of Conception and Reduction to Practice --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Dates of Conception and Reduction to Practice</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note:</p>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs italic text-gray-500 mb-1">1. These dates have to be documented to respond to "first-to-invent" challenges in the case of multiple applicants for the same patent. Conception is the formulation in the mind of the inventors of the ultimate working invention. Simply put, reduction to practice means "when it was shown to work". In the case of an invention, it is best to document the time of its physical creation as well. For intangible assets with commercial applications (e.g., biomarkers, drug targets), please</p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div>
                            <label class="text-xs font-medium text-gray-500">Date of Conception</label>
                            <input type="date" name="conception_date" value="{{ old('conception_date') }}"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30">
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-500">Date of Reduction to Practice</label>
                            <input type="date" name="reduction_date" value="{{ old('reduction_date') }}"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30">
                        </div>
                    </div>
                </div>
                @error('conception_date')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 11. Sponsorship --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Sponsorship</label>
                <textarea name="sponsorship" rows="3"
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                    placeholder="Indicate any grants, contracts, or research funding supporting this invention...">{{ old('sponsorship') }}</textarea>
                @error('sponsorship')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 12. Other Agreements and Interactions --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Other Agreements and Interactions</label>
                <textarea name="agreements" rows="3"
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:bg-blue-50/30 placeholder-gray-400"
                    placeholder="Indicate any material transfer, consulting, or other agreements related to this invention...">{{ old('agreements') }}</textarea>
                @error('agreements')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 13. Material Transfer Questions (Conditional) --}}
            <div class="rounded-xl border border-amber-100 bg-amber-50/40 p-4">
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Did this invention use any materials which were obtained from a company or another institution?</label>
                <div class="flex gap-3">
                    <label class="inline-flex items-center">
                        <input type="radio" name="material_used" value="yes" class="mr-1.5" onchange="document.getElementById('material_used_details_wrap').style.display = this.checked ? 'block' : 'none'"> YES
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="material_used" value="no" class="mr-1.5" checked onchange="document.getElementById('material_used_details_wrap').style.display = this.checked ? 'none' : 'block'"> NO
                    </label>
                </div>
                <div id="material_used_details_wrap" style="display:none" class="mt-3">
                    <p class="text-xs italic text-amber-700 mb-1">Please provide details, and indicate if there is a Materials Transfer Agreement. Kindly attach a copy of relevant documents</p>
                    <textarea name="material_used_details" rows="3"
                        class="w-full rounded-lg border border-amber-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100"
                        placeholder="Provide details of the materials obtained and any Materials Transfer Agreement...">{{ old('material_used_details') }}</textarea>
                </div>
            </div>

            <div class="rounded-xl border border-amber-100 bg-amber-50/40 p-4">
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Did you transfer to any researcher outside of your institution any new Materials (DNA, peptides, cell lines, vectors, catalysts, alloys, etc) related to the invention?</label>
                <div class="flex gap-3">
                    <label class="inline-flex items-center">
                        <input type="radio" name="material_transferred" value="yes" class="mr-1.5" onchange="document.getElementById('material_transferred_details_wrap').style.display = this.checked ? 'block' : 'none'"> YES
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="material_transferred" value="no" class="mr-1.5" checked onchange="document.getElementById('material_transferred_details_wrap').style.display = this.checked ? 'none' : 'block'"> NO
                    </label>
                </div>
                <div id="material_transferred_details_wrap" style="display:none" class="mt-3">
                    <p class="text-xs italic text-amber-700 mb-1">Please provide details.</p>
                    <textarea name="material_transferred_details" rows="3"
                        class="w-full rounded-lg border border-amber-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100"
                        placeholder="Provide details of the materials transferred...">{{ old('material_transferred_details') }}</textarea>
                </div>
            </div>

            <div class="rounded-xl border border-amber-100 bg-amber-50/40 p-4">
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Is any other group, lab, or researcher on campus using your invention in their research</label>
                <div class="flex gap-3">
                    <label class="inline-flex items-center">
                        <input type="radio" name="other_group_using" value="yes" class="mr-1.5" onchange="document.getElementById('other_group_details_wrap').style.display = this.checked ? 'block' : 'none'"> YES
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="other_group_using" value="no" class="mr-1.5" checked onchange="document.getElementById('other_group_details_wrap').style.display = this.checked ? 'none' : 'block'"> NO
                    </label>
                </div>
                <div id="other_group_details_wrap" style="display:none" class="mt-3">
                    <p class="text-xs italic text-amber-700 mb-1">Please provide details.</p>
                    <textarea name="other_group_details" rows="3"
                        class="w-full rounded-lg border border-amber-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100"
                        placeholder="Provide details of other groups/labs using the invention...">{{ old('other_group_details') }}</textarea>
                </div>
            </div>

            {{-- 14. Inventors --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Inventors</label>
                <p class="mb-2 text-xs italic text-gray-500">Guidance / Note: List all those who helped contribute to the invention. Mark the corresponding inventor with an asterisk (*), and note any joint appointments.</p>
                <div id="inventor_list" class="space-y-3">
                    <div class="inventor-row grid gap-3 sm:grid-cols-2">
                        <input type="text" name="inventors[0][name]" placeholder="Inventor name"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400">
                        <div class="flex items-center gap-3">
                            <input type="text" name="inventors[0][role]" placeholder="Role / joint appointment (e.g. Faculty, Co-researcher)"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400">
                            <button type="button" onclick="this.closest('.inventor-row').remove()" class="shrink-0 rounded-lg border border-red-200 bg-red-50 px-2.5 py-2.5 text-xs font-medium text-red-600 transition hover:bg-red-100" title="Remove inventor">✕</button>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addInventor()" class="mt-3 inline-flex items-center gap-1 rounded-lg border border-dashed border-blue-300 bg-blue-50/50 px-3.5 py-2 text-xs font-medium text-blue-600 transition hover:bg-blue-100/50">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Inventor
                </button>

                <div class="mt-5 grid gap-3 sm:grid-cols-2">
                    <div>
                        <label class="text-xs font-medium text-gray-500">Corresponding Inventor Printed Name *</label>
                        <input type="text" name="corresponding_inventor" value="{{ old('corresponding_inventor') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Corresponding Inventor Date</label>
                        <input type="date" name="corresponding_inventor_date" value="{{ old('corresponding_inventor_date') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Department Head and College Dean</label>
                        <input type="text" name="dept_head_name" value="{{ old('dept_head_name') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Department Head and College Dean Date</label>
                        <input type="date" name="dept_head_date" value="{{ old('dept_head_date') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Inventor's Name</label>
                        <input type="text" name="inventor_name" value="{{ old('inventor_name') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Inventor's Date</label>
                        <input type="date" name="inventor_date" value="{{ old('inventor_date') }}"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                    </div>
                </div>
                @error('corresponding_inventor')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 15. Disclosure Statement --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Disclosure Statement</label>
                <div class="rounded-lg border border-gray-200 bg-gray-50/70 p-4 text-sm text-gray-700 leading-relaxed">
                    <p class="font-semibold text-gray-900">DISCLOSURE STATEMENT</p>
                    <p class="mt-2">I/We, the undersigned inventor(s), declare that the above information is true and correct to the best of my/our knowledge. I/We understand that this disclosure is submitted to the Intellectual Property and Technology Transfer and Business Development Office (IPTTBDO) of the University of Southern Mindanao (USM) for the purpose of prior art search, evaluation, and determination of intellectual property protection. I/We agree to cooperate with the IPTTBDO in the preparation, filing, and prosecution of any patent or other intellectual property application. I/We acknowledge that any false statement may jeopardize the validity of any resulting intellectual property rights.</p>
                </div>
                <label class="mt-3 inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                    <input type="checkbox" name="disclosure_agreed" value="yes" required class="rounded border-gray-300"> I have read and understood the above Disclosure Statement.
                </label>
                @error('disclosure_agreed')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- 16. Agreement Regarding the USM Intellectual Property Policy --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Agreement Regarding the USM Intellectual Property Policy</label>
                <div class="rounded-lg border border-gray-200 bg-gray-50/70 p-4 text-sm text-gray-700 leading-relaxed">
                    <p class="font-semibold text-gray-900">AGREEMENT REGARDING THE USM INTELLECTUAL PROPERTY POLICY</p>
                    <p class="mt-2">I/We, the undersigned inventor(s), acknowledge that I/we have read and understood the Intellectual Property Policy of the University of Southern Mindanao (USM). I/We agree to be bound by the terms and conditions set forth therein, including the assignment of rights, disclosure obligations, and revenue sharing arrangements as provided under the said policy. I/We understand that the USM, through the IPTTBDO, shall be responsible for the management, protection, and commercialization of intellectual property developed within the scope of my/our official duties and/or with the use of USM resources.</p>
                </div>
                <label class="mt-3 inline-flex items-center gap-2 text-sm font-medium text-gray-700">
                    <input type="checkbox" name="policy_agreed" value="yes" required class="rounded border-gray-300"> I have read and agree to the USM Intellectual Property Policy.
                </label>
                @error('policy_agreed')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-blue-500 to-blue-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-blue-600 hover:to-blue-500 hover:shadow-lg hover:shadow-blue-200/50 focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 active:scale-95">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Submit IP Claims Drafting Request
                </button>
                <a href="{{ route('applications.ip-services') }}" class="text-sm font-medium text-gray-500 transition-all hover:text-gray-700 hover:underline underline-offset-4">Cancel</a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function addInventor() {
        const list = document.getElementById('inventor_list');
        const count = list.children.length;
        const row = document.createElement('div');
        row.className = 'inventor-row grid gap-3 sm:grid-cols-2';
        row.innerHTML = `
            <input type="text" name="inventors[${count}][name]" placeholder="Inventor name"
                class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400">
            <div class="flex items-center gap-3">
                <input type="text" name="inventors[${count}][role]" placeholder="Role / joint appointment (e.g. Faculty, Co-researcher)"
                    class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-blue-400 focus:ring-2 focus:ring-blue-100 placeholder-gray-400">
                <button type="button" onclick="this.closest('.inventor-row').remove()" class="shrink-0 rounded-lg border border-red-200 bg-red-50 px-2.5 py-2.5 text-xs font-medium text-red-600 transition hover:bg-red-100" title="Remove inventor">✕</button>
            </div>`;
        list.appendChild(row);
    }
</script>
@endpush
@endsection
