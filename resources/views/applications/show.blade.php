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
                @if(auth()->user()->isAdmin() || ($application->submitted_by === auth()->user()->id && $application->status === \App\Models\Application::STATUS_FOR_REVISION))
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
                    @if(!empty($application->payload['documents']) && is_array($application->payload['documents']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Supporting Documents:</span>
                        <ul class="mt-1 space-y-1">
                            @foreach($application->payload['documents'] as $doc)
                            <li>
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($doc) }}" target="_blank" class="inline-flex items-center text-sm text-blue-600 underline underline-offset-2 hover:text-blue-800">
                                    <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    {{ basename($doc) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
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
            @elseif($application->application_type === 'apply_protection')
            <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-4 sm:col-span-2 transition hover:bg-emerald-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-emerald-600">IP Protection Application Details</dt>
                <dd class="mt-2 grid gap-3 sm:grid-cols-2">
                    @if(!empty($application->payload['ip_type']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">IP Type:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ ucwords(str_replace('_', ' ', $application->payload['ip_type'])) }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['ip_ownership']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">IP Ownership:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ ucwords($application->payload['ip_ownership']) }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['research_funded']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Research Funded:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ strtoupper($application->payload['research_funded']) }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['funding_source']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Funding Source:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ ucwords(str_replace('_', ' ', $application->payload['funding_source'])) }}</p>
                    </div>
                    @endif
                    @foreach(['patent_invention_title' => 'Title of Invention', 'patent_inventors' => 'Inventors', 'patent_abstract' => 'Abstract', 'patent_claims' => 'Claims', 'patent_description' => 'Detailed Description', 'patent_priority_date' => 'Priority Date', 'um_title' => 'Title of Utility Model', 'um_inventors' => 'Inventors', 'um_abstract' => 'Abstract', 'um_claims' => 'Claims', 'um_description' => 'Detailed Description', 'um_priority_date' => 'Priority Date', 'id_title' => 'Title of Design', 'id_designer' => 'Designer', 'id_description' => 'Description of Design', 'tm_mark_name' => 'Mark Name', 'tm_owner_name' => 'Owner Name', 'tm_classes' => 'Classes', 'tm_description' => 'Description of Mark', 'cr_title' => 'Title of Work', 'cr_author' => 'Author', 'cr_date_created' => 'Date Created', 'cr_type' => 'Type of Work', 'cr_description' => 'Description of Work'] as $key => $label)
                    @if(!empty($application->payload[$key]))
                    <div class="{{ in_array($key, ['patent_abstract', 'patent_claims', 'patent_description', 'um_abstract', 'um_claims', 'um_description', 'id_description', 'tm_description', 'cr_description']) ? 'sm:col-span-2' : '' }}">
                        <span class="text-xs font-medium text-gray-500">{{ $label }}:</span>
                        <p class="mt-0.5 whitespace-pre-line text-sm text-gray-900">{{ $application->payload[$key] }}</p>
                    </div>
                    @endif
                    @endforeach
                    @if(!empty($application->payload['attachment']) || (!empty($application->payload['documents']) && is_array($application->payload['documents'])))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Documents:</span>
                        <ul class="mt-1 space-y-1">
                            @if(!empty($application->payload['attachment']))
                            <li>
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($application->payload['attachment']) }}" target="_blank" class="inline-flex items-center text-sm text-emerald-700 underline underline-offset-2 hover:text-emerald-900">
                                    <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    {{ basename($application->payload['attachment']) }}
                                </a>
                            </li>
                            @endif
                            @foreach($application->payload['documents'] ?? [] as $doc)
                            <li>
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($doc) }}" target="_blank" class="inline-flex items-center text-sm text-emerald-700 underline underline-offset-2 hover:text-emerald-900">
                                    <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    {{ basename($doc) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </dd>
            </div>
            @elseif($application->application_type === 'incentives')
            <div class="rounded-lg border border-amber-100 bg-amber-50/50 p-4 sm:col-span-2 transition hover:bg-amber-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-amber-600">Incentive Application Details</dt>
                <dd class="mt-2 grid gap-3 sm:grid-cols-2">
                    @if(!empty($application->payload['incentive_type']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Incentive Type:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ ucwords(str_replace('_', ' ', $application->payload['incentive_type'])) }}</p>
                    </div>
                    @endif
                    @if(!empty($application->proponent_name))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Proponent Name:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ $application->proponent_name }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['affiliation']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Affiliation / Department:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ $application->payload['affiliation'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['ip_status']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Current IP Status:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ ucwords(str_replace('_', ' ', $application->payload['ip_status'])) }}</p>
                    </div>
                    @endif
                    @if(!empty($application->description))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Description:</span>
                        <p class="mt-0.5 whitespace-pre-line text-sm text-gray-900">{{ $application->description }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['documents']) && is_array($application->payload['documents']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Supporting Documents:</span>
                        <ul class="mt-1 space-y-1">
                            @foreach($application->payload['documents'] as $doc)
                            <li>
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($doc) }}" target="_blank" class="inline-flex items-center text-sm text-amber-700 underline underline-offset-2 hover:text-amber-900">
                                    <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    {{ basename($doc) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </dd>
            </div>
            @elseif($application->application_type === 'tech_transfer')
            <div class="rounded-lg border border-emerald-100 bg-emerald-50/50 p-4 sm:col-span-2 transition hover:bg-emerald-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-emerald-600">Tech Transfer Request Details</dt>
                <dd class="mt-2 grid gap-3 sm:grid-cols-2">
                    @if(!empty($application->payload['consultation_date']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Consultation Schedule:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($application->payload['consultation_date'])->format('F j, Y') }} @if(!empty($application->payload['consultation_time'])) at {{ \Carbon\Carbon::parse($application->payload['consultation_time'])->format('g:i A') }} @endif</p>
                    </div>
                    @endif
                    @if(!empty($application->proponent_name))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Proponent:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ $application->proponent_name }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['services']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Service Pathways:</span>
                        <div class="mt-1 flex flex-wrap gap-2">
                            @foreach($application->payload['services'] as $service)
                            <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 ring-1 ring-emerald-200/50">{{ ucwords(str_replace('_', ' ', $service)) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if(!empty($application->payload['trl_level']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">TRL Level:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">TRL {{ $application->payload['trl_level'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['trl_narrative']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">TRL Narrative / Report:</span>
                        <p class="mt-0.5 whitespace-pre-line text-sm text-gray-900">{{ $application->payload['trl_narrative'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['packaging_service']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Technology Packaging Service:</span>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $application->payload['packaging_service'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['mode_of_transfer']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Mode of Transfer:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ ucwords(str_replace('_', ' ', $application->payload['mode_of_transfer'])) }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['other_service_details']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Other Services Details:</span>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $application->payload['other_service_details'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['documents']) && is_array($application->payload['documents']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Supporting Documents:</span>
                        <ul class="mt-1 space-y-1">
                            @foreach($application->payload['documents'] as $doc)
                            <li>
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($doc) }}" target="_blank" class="inline-flex items-center text-sm text-emerald-700 underline underline-offset-2 hover:text-emerald-900">
                                    <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    {{ basename($doc) }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </dd>
            </div>
            @elseif($application->application_type === 'bizdev')
            <div class="rounded-lg border border-purple-100 bg-purple-50/50 p-4 sm:col-span-2 transition hover:bg-purple-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-purple-600">Business Dev &amp; Incubation Details</dt>
                <dd class="mt-2 grid gap-3 sm:grid-cols-2">
                    @if(!empty($application->payload['consultation_date']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Consultation Schedule:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($application->payload['consultation_date'])->format('F j, Y') }} @if(!empty($application->payload['consultation_time'])) at {{ \Carbon\Carbon::parse($application->payload['consultation_time'])->format('g:i A') }} @endif</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['track']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Service Track:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ ucwords(str_replace('_', ' ', $application->payload['track'])) }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['tbi']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">TBI:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ ucwords($application->payload['tbi']) }} TBI</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['startup_name']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Startup:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ $application->payload['startup_name'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['team_leader']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Team Leader:</span>
                        <p class="mt-0.5 text-sm font-medium text-gray-900">{{ $application->payload['team_leader'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['skills']))
                    <div>
                        <span class="text-xs font-medium text-gray-500">Required Skills:</span>
                        <p class="mt-0.5 text-sm text-gray-900">{{ $application->payload['skills'] }}</p>
                    </div>
                    @endif
                    @if(isset($application->payload['trl']) || isset($application->payload['brl']) || isset($application->payload['irl']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Readiness Assessments:</span>
                        <div class="mt-1 flex flex-wrap gap-2">
                            @foreach(['trl' => 'TRL', 'brl' => 'BRL', 'irl' => 'IRL'] as $key => $label)
                            @if(isset($application->payload[$key]))
                            <span class="inline-flex rounded-full bg-purple-50 px-2.5 py-0.5 text-xs font-medium text-purple-700 ring-1 ring-purple-200/50">{{ $label }} {{ $application->payload[$key] }}/9</span>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if(!empty($application->payload['technology']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Technology (Invention):</span>
                        <p class="mt-0.5 whitespace-pre-line text-sm text-gray-900">{{ $application->payload['technology'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['overview']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Startup Overview:</span>
                        <p class="mt-0.5 whitespace-pre-line text-sm text-gray-900">{{ $application->payload['overview'] }}</p>
                    </div>
                    @endif
                    @if(!empty($application->payload['letter_of_intent']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Letter of Intent:</span>
                        <div class="mt-1">
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($application->payload['letter_of_intent']) }}" target="_blank" class="inline-flex items-center text-sm text-purple-700 underline underline-offset-2 hover:text-purple-900">
                                <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                {{ basename($application->payload['letter_of_intent']) }}
                            </a>
                        </div>
                    </div>
                    @endif
                    @if(!empty($application->payload['team_leader_id']))
                    <div class="sm:col-span-2">
                        <span class="text-xs font-medium text-gray-500">Team Leader's ID:</span>
                        <div class="mt-1">
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($application->payload['team_leader_id']) }}" target="_blank" class="inline-flex items-center text-sm text-purple-700 underline underline-offset-2 hover:text-purple-900">
                                <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                {{ basename($application->payload['team_leader_id']) }}
                            </a>
                        </div>
                    </div>
                    @endif
                </dd>
            </div>
            @endif
            @if($application->application_type === 'bizdev' && auth()->user()->isAdmin())
            <div class="rounded-lg border border-purple-200 bg-purple-50/70 p-4 sm:col-span-2 transition hover:bg-purple-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-purple-700">Admin Business Dev &amp; Incubation Actions</dt>
                <dd class="mt-3 space-y-4">
                    {{-- Schedule approval --}}
                    @if($application->status === \App\Models\Application::STATUS_FOR_EVALUATION && ($application->payload['track'] ?? null) !== 'apply_incubation' && empty($application->payload['technology']))
                    <form method="POST" action="{{ route('bizdev.approve-schedule', $application) }}" class="rounded-lg border border-purple-100 bg-white p-4">
                        @csrf
                        <p class="text-sm font-semibold text-gray-900">Meeting Schedule Approval</p>
                        <p class="mt-0.5 text-xs text-gray-500">Approve the consultation schedule. The client will proceed to the face-to-face meeting.</p>
                        <button type="submit" class="mt-3 inline-flex items-center rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-purple-600 hover:to-purple-500 hover:shadow-lg hover:shadow-purple-200/50 active:scale-95">
                            Approve Schedule
                        </button>
                    </form>
                    @endif

                    {{-- Post-meeting decision --}}
                    @if($application->status === \App\Models\Application::STATUS_MEETING_APPROVED)
                    <form method="POST" action="{{ route('bizdev.meeting-decision', $application) }}" class="rounded-lg border border-purple-100 bg-white p-4">
                        @csrf
                        <p class="text-sm font-semibold text-gray-900">Meeting Decision</p>
                        <p class="mt-0.5 text-xs text-gray-500">Approve to proceed (or advance to incubation), or reject with the standard message.</p>
                        <div class="mt-3 flex flex-wrap gap-3">
                            <button type="submit" name="decision" value="approve" class="inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 active:scale-95">
                                Approve
                            </button>
                            <button type="submit" name="decision" value="reject" class="inline-flex items-center rounded-lg bg-gradient-to-r from-red-500 to-red-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-red-600 hover:to-red-500 hover:shadow-lg hover:shadow-red-200/50 active:scale-95">
                                Reject
                            </button>
                        </div>
                    </form>
                    @endif

                    {{-- Incubation application evaluation --}}
                    @if($application->status === \App\Models\Application::STATUS_FOR_EVALUATION && !empty($application->payload['technology']))
                    <form method="POST" action="{{ route('bizdev.evaluate', $application) }}" class="rounded-lg border border-purple-100 bg-white p-4">
                        @csrf
                        <p class="text-sm font-semibold text-gray-900">Incubation Application Evaluation</p>
                        <p class="mt-0.5 text-xs text-gray-500">Approve to enter the incubation program, or mark for revision.</p>
                        <div class="mt-3 flex flex-wrap gap-3">
                            <button type="submit" name="decision" value="approve" class="inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 active:scale-95">
                                Approve — Enter Incubation
                            </button>
                            <button type="submit" name="decision" value="revise" class="inline-flex items-center rounded-lg bg-gradient-to-r from-amber-500 to-amber-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 active:scale-95">
                                For Revision
                            </button>
                        </div>
                    </form>
                    @endif

                    {{-- Program stage advancement --}}
                    @if(in_array($application->status, [
                        \App\Models\Application::STATUS_INCUBATION,
                        \App\Models\Application::STATUS_MASTER_CLASS,
                        \App\Models\Application::STATUS_STARTUP_ACTIVITIES,
                        \App\Models\Application::STATUS_MONITORING,
                        \App\Models\Application::STATUS_GRADUATED,
                    ]))
                    <form method="POST" action="{{ route('bizdev.advance-stage', $application) }}" class="rounded-lg border border-purple-100 bg-white p-4">
                        @csrf
                        <p class="text-sm font-semibold text-gray-900">Incubation Program Stage</p>
                        <p class="mt-0.5 text-xs text-gray-500">Advance through: Master Class → Startup Activities → Progress Monitoring → Graduation → Completion.</p>
                        <button type="submit" class="mt-3 inline-flex items-center rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-purple-600 hover:to-purple-500 hover:shadow-lg hover:shadow-purple-200/50 active:scale-95">
                            Advance Stage
                        </button>
                    </form>
                    @endif
                </dd>
            </div>
            @endif
            @if($application->application_type === 'tech_transfer' && auth()->user()->isAdmin())
            <div class="rounded-lg border border-emerald-200 bg-emerald-50/70 p-4 sm:col-span-2 transition hover:bg-emerald-50 hover:shadow-sm">
                <dt class="text-xs font-medium uppercase tracking-wider text-emerald-700">Admin Tech Transfer Actions</dt>
                <dd class="mt-3 space-y-4">
                    @if(!in_array($application->status, [\App\Models\Application::STATUS_REGISTERED, \App\Models\Application::STATUS_COMPLETED]))
                    {{-- TRL rating --}}
                    <form method="POST" action="{{ route('tech-transfer.rate-trl', $application) }}" class="rounded-lg border border-emerald-100 bg-white p-4">
                        @csrf
                        <p class="text-sm font-semibold text-gray-900">TRL Assessment</p>
                        <p class="mt-0.5 text-xs text-gray-500">Only admins can rate the TRL. The result reflects on the client side.</p>
                        <div class="mt-3 grid gap-3 sm:grid-cols-2">
                            <select name="trl_level" required class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">
                                <option value="" disabled @if(empty($application->payload['trl_level'])) selected @endif>Select TRL 1–9</option>
                                @foreach([1 => 'TRL 1 — Basic principles observed', 2 => 'TRL 2 — Technology concept formulated', 3 => 'TRL 3 — Experimental proof of concept', 4 => 'TRL 4 — Technology validated in lab', 5 => 'TRL 5 — Technology validated in relevant environment', 6 => 'TRL 6 — Technology demonstrated in relevant environment', 7 => 'TRL 7 — System prototype demonstration in operational environment', 8 => 'TRL 8 — System complete and qualified', 9 => 'TRL 9 — Actual system proven in operational environment'] as $lv => $label)
                                <option value="{{ $lv }}" @if(($application->payload['trl_level'] ?? null) == $lv) selected @endif>{{ $label }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="trl_narrative" value="{{ $application->payload['trl_narrative'] ?? '' }}" placeholder="TRL narrative / notes"
                                class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 placeholder-gray-400">
                        </div>
                        <button type="submit" class="mt-3 inline-flex items-center rounded-lg bg-gradient-to-r from-blue-500 to-blue-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-blue-600 hover:to-blue-500 hover:shadow-lg hover:shadow-blue-200/50 active:scale-95">
                            Save TRL Rating
                        </button>
                    </form>

                    {{-- Schedule approval --}}
                    @if($application->status === \App\Models\Application::STATUS_FOR_EVALUATION)
                    <form method="POST" action="{{ route('tech-transfer.approve-schedule', $application) }}" class="rounded-lg border border-emerald-100 bg-white p-4">
                        @csrf
                        <p class="text-sm font-semibold text-gray-900">Meeting Schedule Approval</p>
                        <p class="mt-0.5 text-xs text-gray-500">Approve the consultation schedule. The client will see a popup to proceed to the TBI office.</p>
                        <button type="submit" class="mt-3 inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 active:scale-95">
                            Approve Schedule
                        </button>
                    </form>
                    @endif

                    {{-- Post-meeting decision --}}
                    @if($application->status === \App\Models\Application::STATUS_MEETING_APPROVED)
                    <form method="POST" action="{{ route('tech-transfer.meeting-decision', $application) }}" class="rounded-lg border border-emerald-100 bg-white p-4">
                        @csrf
                        <p class="text-sm font-semibold text-gray-900">Meeting Decision</p>
                        <p class="mt-0.5 text-xs text-gray-500">Approve to proceed to requirements, or mark for revision.</p>
                        <div class="mt-3 flex flex-wrap gap-3">
                            <button type="submit" name="decision" value="approve" class="inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 active:scale-95">
                                Approve — Proceed to Requirements
                            </button>
                            <button type="submit" name="decision" value="revise" class="inline-flex items-center rounded-lg bg-gradient-to-r from-amber-500 to-amber-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 active:scale-95">
                                Revise
                            </button>
                        </div>
                    </form>
                    @endif
                    @endif
                </dd>
            </div>
            @endif
                <dd class="mt-1.5">
                    <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 ring-1 ring-amber-200/50">{{ $application->statusLabel() }}</span>
                    @if($application->status === \App\Models\Application::STATUS_FOR_REVISION)
                    <div class="mt-3 rounded-lg border border-amber-200 bg-amber-50 p-3">
                        <p class="text-sm font-medium text-amber-800">This application needs revision. Please update the details and resubmit.</p>
                        @if($application->application_type === 'bizdev' && $application->submitted_by === auth()->user()->id)
                        <a href="{{ route('bizdev.incubation', $application) }}" class="mt-2 inline-flex items-center text-sm font-semibold text-amber-700 underline underline-offset-4 hover:text-amber-900">Update incubation application &amp; resubmit</a>
                        @elseif(auth()->user()->isAdmin() || $application->submitted_by === auth()->user()->id)
                        <a href="{{ route('applications.edit', $application) }}" class="mt-2 inline-flex items-center text-sm font-semibold text-amber-700 underline underline-offset-4 hover:text-amber-900">Update &amp; resubmit</a>
                        @endif
                    </div>
                    @elseif($application->status === \App\Models\Application::STATUS_MEETING_APPROVED)
                    <div class="mt-3 rounded-lg border border-emerald-200 bg-emerald-50 p-3">
                        <p class="text-sm font-medium text-emerald-800">Your schedule has been approved. Please proceed to the {{ ($application->payload['tbi'] ?? null) === 'agraqua' ? 'AGRIAQUA' : 'USMart' }} TBI Office for your face-to-face meeting.</p>
                        @if($application->submitted_by === auth()->user()->id && $application->application_type === 'tech_transfer')
                        <button type="button" onclick="document.getElementById('tbi-modal').classList.remove('hidden')" class="mt-2 inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 active:scale-95">
                            Proceed to TBI Office
                        </button>
                        @endif
                    </div>
                    @elseif($application->status === \App\Models\Application::STATUS_REQUIREMENTS)
                    <div class="mt-3 rounded-lg border border-emerald-200 bg-emerald-50 p-3">
                        <p class="text-sm font-medium text-emerald-800">Meeting approved. Please submit the required documents to continue.</p>
                        @if($application->submitted_by === auth()->user()->id)
                        <a href="#requirements-section" class="mt-2 inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 active:scale-95">
                            Submit Requirements
                        </a>
                        @endif
                    </div>
                    @elseif($application->status === \App\Models\Application::STATUS_COMPLETED)
                    <div class="mt-3 rounded-lg border border-emerald-200 bg-emerald-50 p-3">
                        <p class="text-sm font-medium text-emerald-800">This application has been registered and is now completed.</p>
                    </div>
                    @elseif($application->application_type === 'bizdev' && $application->status === \App\Models\Application::STATUS_INCUBATION_APPLY)
                    <div class="mt-3 rounded-lg border border-purple-200 bg-purple-50 p-3">
                        <p class="text-sm font-medium text-purple-800">Your application is ready for the incubation pipeline. Please complete the incubation application.</p>
                        @if($application->submitted_by === auth()->user()->id)
                        <a href="{{ route('bizdev.incubation', $application) }}" class="mt-2 inline-flex items-center rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-purple-600 hover:to-purple-500 hover:shadow-lg hover:shadow-purple-200/50 active:scale-95">
                            Continue to Apply Incubation
                        </a>
                        @endif
                    </div>
                    @elseif($application->application_type === 'bizdev' && $application->status === \App\Models\Application::STATUS_REJECTED)
                    <div class="mt-3 rounded-lg border border-red-200 bg-red-50 p-3">
                        <p class="text-sm font-medium text-red-800">{{ $application->remarks }}</p>
                    </div>
                    @elseif($application->application_type === 'bizdev' && in_array($application->status, [
                        \App\Models\Application::STATUS_INCUBATION,
                        \App\Models\Application::STATUS_MASTER_CLASS,
                        \App\Models\Application::STATUS_STARTUP_ACTIVITIES,
                        \App\Models\Application::STATUS_MONITORING,
                        \App\Models\Application::STATUS_GRADUATED,
                    ]))
                    <div class="mt-3 rounded-lg border border-purple-200 bg-purple-50 p-3">
                        <p class="text-sm font-medium text-purple-800">You are in the incubation program. Current stage: <span class="font-semibold">{{ $application->statusLabel() }}</span>.</p>
                        <p class="mt-1 text-xs text-purple-600">The incubation lifecycle: Master Class → Startup Activities → Progress Monitoring &amp; Evaluation → Graduation.</p>
                    </div>
                    @else
                    <div class="mt-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                        <p class="text-sm text-gray-600">Wait until registered or revision needed.</p>
                    </div>
                    @endif
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

        @if($application->application_type === 'tech_transfer' && $application->status === \App\Models\Application::STATUS_REQUIREMENTS && $application->submitted_by === auth()->user()->id)
        <div id="requirements-section" class="mt-4 scroll-mt-24 rounded-xl border border-emerald-200 bg-white p-5 shadow-sm transition-all hover:shadow-md">
            <div class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-widest">Requirements</span>
            </div>
            <h3 class="mt-2 text-base font-semibold text-gray-900">Submit Required Documents</h3>
            <p class="mt-1 text-sm text-gray-500">Your meeting was approved. Upload the required documents to continue the tech transfer process.</p>
            <form method="POST" action="{{ route('tech-transfer.requirements', $application) }}" enctype="multipart/form-data" class="mt-4">
                @csrf
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Requirements / Documents <span class="text-red-500">*</span></label>
                <div class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-emerald-200 bg-emerald-50/40 px-6 py-8 text-center transition-all hover:border-emerald-400 hover:bg-emerald-50">
                    <svg class="h-10 w-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <p class="mt-2 text-sm font-medium text-gray-600">Click to select files</p>
                    <p class="text-xs text-gray-400">PDF, Word, images, ZIP — up to 10 files, 2MB each</p>
                    <input type="file" name="documents[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.zip" class="mt-3 block w-full max-w-sm cursor-pointer rounded-lg border border-gray-200 bg-white text-sm text-gray-600 file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-500 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-emerald-600">
                </div>
                @error('documents')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
                <div id="requirements-preview" class="mt-3 hidden flex-wrap gap-2"></div>
                <button type="submit" class="mt-4 inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 active:scale-95">
                    Submit Requirements
                </button>
            </form>
        </div>
        @endif

        @if(!empty($application->payload['requirements']))
        <div class="mt-4 rounded-lg border border-gray-100 bg-gray-50/50 p-4 transition hover:bg-gray-50 hover:shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Submitted Requirements</p>
            <ul class="mt-2 space-y-1">
                @foreach($application->payload['requirements'] as $doc)
                <li>
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($doc) }}" target="_blank" class="inline-flex items-center text-sm text-emerald-700 underline underline-offset-2 hover:text-emerald-900">
                        <svg class="mr-1 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        {{ basename($doc) }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
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

@if($application->application_type === 'tech_transfer' && $application->status === \App\Models\Application::STATUS_MEETING_APPROVED && $application->submitted_by === auth()->user()->id)
<div id="tbi-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm">
    <div class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-2xl">
        <div class="flex items-start justify-between">
            <div class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-widest">TBI Office Visit</span>
            </div>
            <button type="button" onclick="document.getElementById('tbi-modal').classList.add('hidden')" class="rounded-lg p-1.5 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <h3 class="mt-3 text-lg font-semibold text-gray-900">Proceed to TBI Office</h3>
        <p class="mt-2 text-sm text-gray-600">
            Your consultation schedule has been <span class="font-semibold text-emerald-700">approved</span>. Please proceed to the
            <span class="font-semibold text-gray-900">USMart TBI Office</span> for your face-to-face meeting.
        </p>
        <div class="mt-3 rounded-lg border border-gray-200 bg-gray-50 p-3 text-sm text-gray-700">
            <p><span class="font-medium text-gray-500">Date:</span> {{ \Carbon\Carbon::parse($application->payload['consultation_date'])->format('F j, Y') }}</p>
            @if(!empty($application->payload['consultation_time']))
            <p class="mt-1"><span class="font-medium text-gray-500">Time:</span> {{ \Carbon\Carbon::parse($application->payload['consultation_time'])->format('g:i A') }}</p>
            @endif
        </div>
        <div class="mt-5 flex items-center justify-end gap-3">
            <button type="button" onclick="document.getElementById('tbi-modal').classList.add('hidden')" class="rounded-lg px-4 py-2 text-sm font-semibold text-gray-600 transition hover:bg-gray-100">
                Maybe later
            </button>
            <form method="POST" action="{{ route('tech-transfer.proceed-tbi', $application) }}">
                @csrf
                <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-emerald-600 hover:to-emerald-500 hover:shadow-lg hover:shadow-emerald-200/50 active:scale-95">
                    Confirm — I will proceed
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    @if(session('proceed_tbi'))
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('tbi-modal')?.classList.remove('hidden');
    });
    @endif
</script>
@endif

@if($application->application_type === 'tech_transfer' && $application->status === \App\Models\Application::STATUS_REQUIREMENTS && $application->submitted_by === auth()->user()->id)
<script>
    document.querySelector('#requirements-section input[type="file"]')?.addEventListener('change', function() {
        var preview = document.getElementById('requirements-preview');
        preview.classList.remove('hidden');
        preview.classList.add('flex');
        preview.innerHTML = '';
        Array.from(this.files).forEach(function(file) {
            var chip = document.createElement('span');
            chip.className = 'inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700 ring-1 ring-emerald-200/50';
            chip.textContent = file.name;
            preview.appendChild(chip);
        });
    });
</script>
@endif
@endsection