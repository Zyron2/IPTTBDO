@extends('layouts.app')

@section('content')
<div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr] animate-slide-up">
    <section class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                    <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Review details</span>
                </div>
                <h2 class="mt-2 text-lg font-semibold text-gray-900 font-mono">{{ $application->tracking_no }}</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $application->title }}</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('applications.download', $application) }}" class="group inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-600 transition-all hover:bg-gray-50 hover:text-gray-900 hover:shadow-sm active:scale-95">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download
                </a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('applications.edit', $application) }}" class="inline-flex items-center rounded-lg bg-gradient-to-r from-amber-500 to-amber-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 active:scale-95">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                @endif
            </div>
        </div>

        <dl class="mt-6 grid gap-4 sm:grid-cols-2">
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition hover:bg-gray-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-gray-500">Branch</dt>
                <dd class="mt-1.5 font-medium text-gray-900">{{ $application->branchLabel() }}</dd>
            </div>
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition hover:bg-gray-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-gray-500">Type</dt>
                <dd class="mt-1.5 font-medium text-gray-900">{{ $application->formTypeLabel() }}</dd>
            </div>
            @if(in_array($application->application_type, ['prior_art', 'claims_drafting']))
            <div class="rounded-lg border border-blue-100 bg-blue-50/50 p-4 sm:col-span-2 transition hover:bg-blue-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-blue-600">{{ $application->application_type === 'prior_art' ? 'Prior Art Search Details' : 'IP Claims Drafting Details' }}</dt>
                <dd class="mt-2 space-y-3">
                    @if(!empty($application->payload['search_terms']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Search Terms:</span>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $application->payload['search_terms'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['overview_1']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Overview — Layperson's description:</span>
                        <p class="mt-0.5 text-sm text-gray-900 whitespace-pre-line">{{ $application->payload['overview_1'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['overview_2']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Overview — Application / unmet need:</span>
                        <p class="mt-0.5 text-sm text-gray-900 whitespace-pre-line">{{ $application->payload['overview_2'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['technical_description']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Technical Description:</span>
                        <p class="mt-0.5 text-sm text-gray-900 whitespace-pre-line">{{ $application->payload['technical_description'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['development_stage']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Stage of Development:</span>
                        <p class="mt-0.5 text-sm text-gray-900 whitespace-pre-line">{{ $application->payload['development_stage'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['sponsorship']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Sponsorship:</span>
                        <p class="mt-0.5 text-sm text-gray-900 whitespace-pre-line">{{ $application->payload['sponsorship'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['agreements']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Other Agreements and Interactions:</span>
                        <p class="mt-0.5 text-sm text-gray-900 whitespace-pre-line">{{ $application->payload['agreements'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['material_used']) && $application->payload['material_used'] === 'yes')
                    <div>
                        <span class="text-xs font-medium text-gray-500">Used materials from company/institution:</span>
                        <p class="mt-0.5 text-sm text-gray-900 whitespace-pre-line">YES — {{ $application->payload['material_used_details'] ?? 'No details provided' }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['material_transferred']) && $application->payload['material_transferred'] === 'yes')
                    <div>
                        <span class="text-xs font-medium text-gray-500">Transferred materials to outside researcher:</span>
                        <p class="mt-0.5 text-sm text-gray-900 whitespace-pre-line">YES — {{ $application->payload['material_transferred_details'] ?? 'No details provided' }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['other_group_using']) && $application->payload['other_group_using'] === 'yes')
                    <div>
                        <span class="text-xs font-medium text-gray-500">Other group/lab using the invention:</span>
                        <p class="mt-0.5 text-sm text-gray-900 whitespace-pre-line">YES — {{ $application->payload['other_group_details'] ?? 'No details provided' }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['inventors']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Inventors:</span>
                        <ul class="mt-0.5 space-y-1 text-sm text-gray-900">
                            @foreach($application->payload['inventors'] as $inventor)
                            @if(!empty($inventor['name']))
                            <li>{{ $inventor['name'] }}@if(!empty($inventor['role'])) <span class="text-gray-500">({{ $inventor['role'] }})</span>@endif</li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(!empty($application->payload['corresponding_inventor']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Corresponding Inventor:</span>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $application->payload['corresponding_inventor'] }} @if(!empty($application->payload['corresponding_inventor_date'])) — {{ $application->payload['corresponding_inventor_date'] }} @endif</p>
                    </div>
                    @endif
                </dd>
            </div>
            @elseif($application->branch === 'consultation' && !empty($application->payload['consultation_date']))
            <div class="rounded-lg border border-blue-100 bg-blue-50/50 p-4 sm:col-span-2 transition hover:bg-blue-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-blue-600">Consultation Appointment Details</dt>
                <dd class="mt-2 grid gap-2 sm:grid-cols-2">
                    @if(!empty($application->payload['consultation_date']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Preferred Date:</span>
                        <span class="ml-1.5 text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($application->payload['consultation_date'])->format('F j, Y') }}</span>
                    </div>
                    @endif
                    @if(!empty($application->payload['consultation_time']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Preferred Time:</span>
                        <span class="ml-1.5 text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($application->payload['consultation_time'])->format('g:i A') }}</span>
                    </div>
                    @endif
                    @if(!empty($application->payload['consultation_reason']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Reason for Consultation:</span>
                        <p class="mt-1 text-sm text-gray-900">{{ $application->payload['consultation_reason'] }}</p>
                    </div>
                    @endif
                </dd>
            </div>
            @endif
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition hover:bg-gray-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-gray-500">Status</dt>
                <dd class="mt-1.5">
                    <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 ring-1 ring-amber-200/50">{{ $application->statusLabel() }}</span>
                </dd>
            </div>
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition hover:bg-gray-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-gray-500">Date filed</dt>
                <dd class="mt-1.5 font-medium text-gray-900">{{ optional($application->date_filed)->format('M d, Y') }}</dd>
            </div>
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 sm:col-span-2 transition hover:bg-gray-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-gray-500">Submitted by</dt>
                <dd class="mt-1.5 font-medium text-gray-900">{{ $application->submittedBy?->name }} <span class="text-gray-400">/</span> {{ $application->submittedBy?->email }}</dd>
            </div>
        </dl>

        <div class="mt-6 rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition hover:bg-gray-50 hover:shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Description</p>
            <p class="mt-2 whitespace-pre-line text-sm text-gray-700">{{ $application->description }}</p>
        </div>

        <div class="mt-4 rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition hover:bg-gray-50 hover:shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Remarks</p>
            <p class="mt-2 whitespace-pre-line text-sm text-gray-700">{{ $application->remarks ?: 'No remarks yet.' }}</p>
        </div>
    </section>

    <aside class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
        <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
            <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
            <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Payload</span>
        </div>
        <h3 class="mt-2 text-base font-semibold text-gray-900">Branch-specific details</h3>
        <div class="mt-4 space-y-3 text-sm">
            @forelse(($application->payload ?? []) as $key => $value)
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition hover:bg-gray-50 hover:shadow-sm">
                <p class="text-xs uppercase tracking-wider text-gray-500">{{ str_replace('_', ' ', $key) }}</p>
                <p class="mt-1.5 whitespace-pre-line text-gray-700">{{ is_array($value) ? json_encode($value) : $value }}</p>
            </div>
            @empty
            <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-4 text-gray-400">No extra payload stored yet.</div>
            @endforelse
        </div>
    </aside>
</div>
@endsection