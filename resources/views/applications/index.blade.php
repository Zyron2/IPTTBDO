@extends('layouts.app')

@section('content')
    <div class="rounded-[2rem] border border-white/10 bg-slate-900/70 p-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-amber-300/80">Applications</p>
                <h2 class="mt-2 text-2xl font-semibold text-white">Submitted forms</h2>
            </div>
            <a href="{{ route('applications.create') }}" class="rounded-full bg-amber-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-300">Create form</a>
        </div>

        <form class="mt-6 grid gap-4 lg:grid-cols-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search tracking, title, proponent" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-slate-500">
            <select name="branch" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white">
                <option value="">All branches</option>
                @foreach ($branches as $key => $label)
                    <option value="{{ $key }}" @selected(request('branch') === $key)>{{ $label }}</option>
                @endforeach
            </select>
            <select name="status" class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white">
                <option value="">All statuses</option>
                @foreach ($statuses as $key => $label)
                    <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                @endforeach
            </select>
            <button class="rounded-2xl bg-white/10 px-4 py-3 font-medium text-white transition hover:bg-white/15">Filter</button>
        </form>

        <div class="mt-6 overflow-hidden rounded-2xl border border-white/10">
            <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                <thead class="bg-white/5 text-slate-300">
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
                <tbody class="divide-y divide-white/5 bg-slate-950/40 text-slate-200">
                    @forelse ($applications as $application)
                        <tr>
                            <td class="px-4 py-3">{{ $application->tracking_no }}</td>
                            <td class="px-4 py-3">{{ $application->branchLabel() }}</td>
                            <td class="px-4 py-3">{{ $application->formTypeLabel() }}</td>
                            <td class="px-4 py-3">{{ $application->title }}</td>
                            <td class="px-4 py-3">{{ $application->statusLabel() }}</td>
                            <td class="px-4 py-3">{{ optional($application->date_filed)->format('M d, Y') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('applications.show', $application) }}" class="text-amber-300 hover:text-amber-200">View details</a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('applications.edit', $application) }}" class="text-sky-300 hover:text-sky-200">Edit</a>
                                    @endif
                                    <a href="{{ route('applications.download', $application) }}" class="text-emerald-300 hover:text-emerald-200">Download</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-slate-400">No applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $applications->links() }}</div>
    </div>
@endsection