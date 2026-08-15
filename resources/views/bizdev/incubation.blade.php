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
        <span class="text-gray-900 font-medium">Incubation Application</span>
    </nav>

    <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-purple-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-purple-500"></span>
            <span class="text-[11px] font-semibold text-purple-700 uppercase tracking-widest">Incubation Application</span>
        </div>
        <h2 class="mt-2 text-lg font-semibold text-gray-900">Apply Incubation</h2>
        <p class="mt-1 text-sm text-gray-500">Tracking: <span class="font-mono text-xs text-purple-600">{{ $application->tracking_no }}</span>. Complete all sections below.</p>

        <form method="POST" action="{{ route('bizdev.incubation.store', $application) }}" enctype="multipart/form-data" class="mt-6 space-y-8">
            @csrf

            {{-- Section 2: TBI Selection & Team Setup --}}
            <section class="space-y-5">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-purple-100 text-sm font-semibold text-purple-700">2</span>
                    <span class="text-sm font-semibold text-gray-900">TBI Selection &amp; Team Setup</span>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Choose TBI <span class="text-red-500">*</span></label>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-purple-100 bg-purple-50/40 p-4 transition-all hover:border-purple-300 hover:shadow-sm">
                            <input type="radio" name="tbi" value="usmart" @checked(old('tbi', 'usmart') === 'usmart') class="mt-1 h-4 w-4 accent-purple-600">
                            <span>
                                <span class="block text-sm font-semibold text-gray-900">USMart TBI</span>
                                <span class="mt-0.5 block text-xs text-gray-500">University Science &amp; Technology Business Incubator</span>
                            </span>
                        </label>
                        <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-emerald-100 bg-emerald-50/40 p-4 transition-all hover:border-emerald-300 hover:shadow-sm">
                            <input type="radio" name="tbi" value="agraqua" @checked(old('tbi') === 'agraqua') class="mt-1 h-4 w-4 accent-emerald-600">
                            <span>
                                <span class="block text-sm font-semibold text-gray-900">AGRIAQUA TBI</span>
                                <span class="mt-0.5 block text-xs text-gray-500">Agriculture &amp; Aquaculture Business Incubator</span>
                            </span>
                        </label>
                    </div>
                    @error('tbi')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="rounded-lg border border-amber-200 bg-amber-50 p-4">
                    <p class="text-sm font-semibold text-amber-800">Terms and Conditions</p>
                    <p class="mt-1 text-xs text-gray-600">By proceeding with this application you agree to the terms and conditions of the USM Technology Business Incubator, including full participation in the incubation program, reporting requirements, and the journey from pre-incubation to commercialization. You acknowledge that final acceptance is subject to evaluation by the IPTTBDO.</p>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">
                        @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Name of Startup <span class="text-red-500">*</span></label>
                        <input type="text" name="startup_name" value="{{ old('startup_name', $application->title) }}" required
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">
                        @error('startup_name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Name of Team Leader <span class="text-red-500">*</span></label>
                        <input type="text" name="team_leader" value="{{ old('team_leader', $application->proponent_name) }}" required
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">
                        @error('team_leader')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Mobile Numbers</label>
                        <input type="text" name="mobile_numbers" value="{{ old('mobile_numbers') }}" placeholder="e.g. 09171234567, 09281234567"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Name of Members</label>
                        <textarea name="team_members" rows="2" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" placeholder="List all team members (one per line)">{{ old('team_members') }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Does your team require additional team members? <span class="text-red-500">*</span></label>
                    <div class="flex gap-3">
                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 transition-all hover:border-purple-300 has-[:checked]:border-purple-400 has-[:checked]:bg-purple-50/40">
                            <input type="radio" name="team_needs_skills" value="yes" @checked(old('team_needs_skills') === 'yes') class="h-4 w-4 accent-purple-600"> Yes
                        </label>
                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 transition-all hover:border-purple-300 has-[:checked]:border-purple-400 has-[:checked]:bg-purple-50/40">
                            <input type="radio" name="team_needs_skills" value="no" @checked(old('team_needs_skills') === 'no') class="h-4 w-4 accent-purple-600"> No
                        </label>
                    </div>
                    @error('team_needs_skills')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div id="skills-block" class="hidden">
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Required Skills <span class="text-red-500">*</span></label>
                    <input type="text" name="required_skills" value="{{ old('required_skills') }}" placeholder="e.g. Technical, Business, Marketing"
                        class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">
                    <p class="mt-1.5 text-xs italic text-gray-500">Input the required skills (e.g., Technical, Business, Marketing).</p>
                </div>
            </section>

            {{-- Section 3: Product & Market Information --}}
            <section class="space-y-5">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-purple-100 text-sm font-semibold text-purple-700">3</span>
                    <span class="text-sm font-semibold text-gray-900">Product &amp; Market Information</span>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Technology (Invention) <span class="text-red-500">*</span></label>
                        <textarea name="technology" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" required>{{ old('technology') }}</textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Brief Overview of Startup Idea / Project <span class="text-red-500">*</span></label>
                        <textarea name="overview" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" required>{{ old('overview') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Problem / Need Addressed <span class="text-red-500">*</span></label>
                        <textarea name="problem" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" required>{{ old('problem') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Proposed Solution <span class="text-red-500">*</span></label>
                        <textarea name="solution" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" required>{{ old('solution') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Target Market(s) <span class="text-red-500">*</span></label>
                        <textarea name="target_market" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" required>{{ old('target_market') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Competitors / Similar Solutions <span class="text-red-500">*</span></label>
                        <textarea name="competitors" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" required>{{ old('competitors') }}</textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Competitive Advantage / Differentiation <span class="text-red-500">*</span></label>
                        <textarea name="competitive_advantage" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" required>{{ old('competitive_advantage') }}</textarea>
                    </div>
                </div>
            </section>

            {{-- Section 4: Readiness Assessments & Commitment --}}
            <section class="space-y-5">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-purple-100 text-sm font-semibold text-purple-700">4</span>
                    <span class="text-sm font-semibold text-gray-900">Readiness Assessments &amp; Commitment</span>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach(['trl' => ['TRL', 'Technology Readiness Level'], 'brl' => ['BRL', 'Business Readiness Level'], 'irl' => ['IRL', 'Investment Readiness Level']] as $key => [$label, $full])
                    <div class="rounded-xl border border-purple-100 bg-purple-50/30 p-4">
                        <p class="text-sm font-semibold text-gray-900">{{ $label }} — {{ $full }}</p>
                        <p class="mt-0.5 text-xs text-gray-500">Rate your readiness from 0–9.</p>
                        <input type="range" name="{{ $key }}" min="0" max="9" step="1" value="{{ old($key, 0) }}" class="bizdev-range mt-3 w-full accent-purple-600" oninput="this.nextElementSibling.value = this.value">
                        <div class="mt-2 flex items-center justify-between text-xs text-gray-500">
                            <span>0</span>
                            <span>9</span>
                        </div>
                        <div class="mt-2 flex items-center gap-2">
                            <input type="number" value="{{ old($key, 0) }}" min="0" max="9" class="w-16 rounded-lg border border-gray-200 bg-white px-2 py-1.5 text-center text-sm text-gray-900 outline-none focus:border-purple-400 focus:ring-2 focus:ring-purple-100" oninput="this.previousElementSibling.value = this.value" readonly>
                            <span class="text-xs text-gray-500">/ 9</span>
                        </div>
                        @error($key)
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    @endforeach
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Accomplishments</label>
                    <textarea name="accomplishments" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" placeholder="List past accomplishments (e.g., prototypes, market validation, competitions)">{{ old('accomplishments') }}</textarea>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Commitment Statement <span class="text-red-500">*</span></label>
                    <textarea name="commitment_statement" rows="3" maxlength="600" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" required placeholder="Write your commitment statement (up to 3 sentences, max 600 characters)">{{ old('commitment_statement') }}</textarea>
                    <p class="mt-1.5 text-xs italic text-gray-500">Commitment requirement: 3-sentence limit statement.</p>
                    @error('commitment_statement')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Are founders committed to attend activities? <span class="text-red-500">*</span></label>
                    <div class="flex gap-3">
                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 transition-all hover:border-purple-300 has-[:checked]:border-purple-400 has-[:checked]:bg-purple-50/40">
                            <input type="radio" name="founders_committed" value="yes" @checked(old('founders_committed') === 'yes') class="h-4 w-4 accent-purple-600"> YES
                        </label>
                        <label class="flex cursor-pointer items-center gap-2 rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 transition-all hover:border-purple-300 has-[:checked]:border-purple-400 has-[:checked]:bg-purple-50/40">
                            <input type="radio" name="founders_committed" value="no" @checked(old('founders_committed') === 'no') class="h-4 w-4 accent-purple-600"> NO
                        </label>
                    </div>
                    @error('founders_committed')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Factors Hindering the Goal</label>
                        <textarea name="hindrances" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30" placeholder="e.g. resource constraints, regulatory hurdles">{{ old('hindrances') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-600">Support Needed from USMart TBI</label>
                        <textarea name="support_needed" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">{{ old('support_needed') }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-600">Future Plans</label>
                    <textarea name="future_plans" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-purple-400 focus:ring-2 focus:ring-purple-100 focus:bg-purple-50/30">{{ old('future_plans') }}</textarea>
                </div>
            </section>

            {{-- Section 5: Document Submission & Verification --}}
            <section class="space-y-5">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-purple-100 text-sm font-semibold text-purple-700">5</span>
                    <span class="text-sm font-semibold text-gray-900">Document Submission &amp; Verification</span>
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="rounded-xl border border-gray-200 bg-gray-50/50 p-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700">Letter of Intent (PDF)</label>
                        <p class="mb-2 text-xs italic text-gray-500">Addressed to the Project Leader and Project Administrative Officer. Accepted: PDF. Max 2MB.</p>
                        @include('applications._file-dropzone', [
                            'name' => 'letter_of_intent',
                            'id' => 'bizdev_loi',
                            'multiple' => false,
                            'required' => false,
                            'hint' => 'Optional but recommended.',
                        ])
                        @error('letter_of_intent')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="rounded-xl border border-gray-200 bg-gray-50/50 p-4">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700">Team Leader's ID (Image)</label>
                        <p class="mb-2 text-xs italic text-gray-500">Accepted: JPG, JPEG, PNG. Max 2MB.</p>
                        @include('applications._file-dropzone', [
                            'name' => 'team_leader_id',
                            'id' => 'bizdev_id',
                            'multiple' => false,
                            'required' => false,
                            'hint' => 'Optional but recommended.',
                        ])
                        @error('team_leader_id')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="rounded-lg border border-purple-200 bg-purple-50/40 p-4">
                    <label class="flex items-start gap-3 text-sm font-medium text-gray-800">
                        <input type="checkbox" name="commitment_ack" value="yes" @checked(old('commitment_ack') === 'yes') class="mt-0.5 h-4 w-4 accent-purple-600">
                        <span>
                            I confirm that I understand the journey from pre-incubation to commercialization and commit to the incubation program. <span class="text-red-500">*</span>
                        </span>
                    </label>
                    @error('commitment_ack')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end pt-2">
                    <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-purple-600 hover:to-purple-500 hover:shadow-lg hover:shadow-purple-200/50 focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 active:scale-95">
                        <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Submit Incubation Application
                    </button>
                </div>
            </section>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var radios = document.querySelectorAll('input[name="team_needs_skills"]');
        var block = document.getElementById('skills-block');
        function sync() {
            var yes = document.querySelector('input[name="team_needs_skills"]:checked');
            block.classList.toggle('hidden', !yes || yes.value !== 'yes');
            var input = block.querySelector('input[name="required_skills"]');
            if (input) input.disabled = !yes || yes.value !== 'yes';
        }
        radios.forEach(function (r) { r.addEventListener('change', sync); });
        sync();
    });
</script>
@endpush
@endsection
