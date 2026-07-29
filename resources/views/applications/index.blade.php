@extends('layouts.app')

@section('content')
<div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md animate-slide-up">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Applications</span>
            </div>
            <h2 class="mt-2 text-lg font-semibold text-gray-900">Submitted forms</h2>
        </div>
        <a href="{{ route('applications.create') }}" class="group inline-flex items-center rounded-lg bg-gradient-to-r from-amber-500 to-amber-400 px-4 py-2 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 active:scale-95">
            <svg class="mr-1.5 h-4 w-4 transition-all group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create form
        </a>
    </div>

    <form class="mt-6 grid gap-3 lg:grid-cols-4">
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search tracking, title, proponent..." class="w-full rounded-lg border border-gray-200 bg-white pl-9 pr-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
        </div>
        <select name="branch" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-600 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
            <option value="">All branches</option>
            @foreach ($branches as $key => $label)
            <option value="{{ $key }}" @selected(request('branch')===$key)>{{ $label }}</option>
            @endforeach
        </select>
        <select name="status" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-600 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100">
            <option value="">All statuses</option>
            @foreach ($statuses as $key => $label)
            <option value="{{ $key }}" @selected(request('status')===$key)>{{ $label }}</option>
            @endforeach
        </select>
        <button class="rounded-lg bg-gray-100 px-4 py-2.5 text-sm font-medium text-gray-700 transition-all hover:bg-gray-200 hover:shadow-sm focus:ring-2 focus:ring-amber-100 active:scale-95">Filter</button>
    </form>

    <div class="mt-6 overflow-hidden rounded-lg border border-gray-100">
        <table class="min-w-full divide-y divide-gray-100 text-left text-sm">
            <thead class="bg-gray-50 text-gray-500">
                <tr>
                    <th class="px-4 py-3 font-medium">Tracking</th>
                    <th class="px-4 py-3 font-medium">Branch</th>
                    <th class="px-4 py-3 font-medium">Type</th>
                    <th class="px-4 py-3 font-medium">Title</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Filed</th>
                    <th class="px-4 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 bg-white text-gray-600">
                @forelse ($applications as $application)
                <tr class="transition-all hover:bg-amber-50/50 hover:shadow-sm">
                    <td class="px-4 py-3 font-mono text-xs">{{ $application->tracking_no }}</td>
                    <td class="px-4 py-3">{{ $application->branchLabel() }}</td>
                    <td class="px-4 py-3">{{ $application->formTypeLabel() }}</td>
                    <td class="max-w-xs truncate px-4 py-3 font-medium text-gray-900">{{ $application->title }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-medium text-amber-700 ring-1 ring-amber-200/50">{{ $application->statusLabel() }}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ optional($application->date_filed)->format('M d, Y') }}</td>
                    <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('applications.show', $application) }}" class="font-medium text-amber-600 transition-all hover:text-amber-700 inline-flex items-center">
                                View
                                <svg class="ml-0.5 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('applications.edit', $application) }}" class="font-medium text-gray-500 transition-all hover:text-gray-700 inline-flex items-center">
                                Edit
                                <svg class="ml-0.5 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            @endif
                            <a href="{{ route('applications.download', $application) }}" class="font-medium text-emerald-600 transition-all hover:text-emerald-700 inline-flex items-center">
                                Download
                                <svg class="ml-0.5 h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-10 text-center text-gray-400">
                        <svg class="mx-auto h-8 w-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="mt-2">No applications found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $applications->links() }}</div>
</div>
@endsection