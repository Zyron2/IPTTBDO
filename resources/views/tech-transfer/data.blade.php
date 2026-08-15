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
        <span class="text-gray-900 font-medium">Data Table</span>
    </nav>

    <div class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1">
        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
        <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-widest">Data Consolidation</span>
    </div>
    <h2 class="mt-2 text-xl font-semibold text-gray-900">Reflect Here / Data Table</h2>
    <p class="mt-1 text-gray-500">Consolidated tracking of tech transfer requests across all service pathways.</p>

    <div class="mt-6 overflow-x-auto rounded-xl border border-gray-100 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-100 text-left text-sm">
            <thead class="bg-gray-50 text-gray-500">
                <tr>
                    <th class="px-4 py-3 font-medium">IP No.</th>
                    <th class="px-4 py-3 font-medium">Mode of Deployment / Commercialization</th>
                    <th class="px-4 py-3 font-medium">Adopters / Association</th>
                    <th class="px-4 py-3 font-medium">Sectors of Adopters</th>
                    <th class="px-4 py-3 font-medium">Income Generated</th>
                    <th class="px-4 py-3 font-medium">Royalty Received</th>
                    <th class="px-4 py-3 font-medium">Remarks</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 bg-white text-gray-600">
                @forelse ($applications as $application)
                <tr class="transition-all hover:bg-emerald-50/50 hover:shadow-sm">
                    <td class="px-4 py-3 font-mono text-xs">{{ $application->tracking_no }}</td>
                    <td class="px-4 py-3">{{ $application->payload['mode_of_transfer'] ?? $application->payload['services'] ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $application->payload['adopters'] ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $application->payload['adopter_sectors'] ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $application->payload['income_generated'] ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $application->payload['royalty_received'] ?? '—' }}</td>
                    <td class="max-w-xs truncate px-4 py-3">{{ $application->payload['data_remarks'] ?? $application->remarks ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 ring-1 ring-amber-200/50">{{ $application->statusLabel() }}</span>
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('applications.show', $application) }}" class="inline-flex items-center font-medium text-emerald-600 transition-all hover:text-emerald-700">
                            View
                            <svg class="ml-0.5 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-10 text-center text-gray-400">
                        <svg class="mx-auto h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h3m-3 4h10a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z"></path>
                        </svg>
                        <p class="mt-2">No tech transfer requests yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <p class="mt-4 text-xs text-gray-400">END — The process officially completes once all pathways have been consolidated.</p>
</div>
@endsection
