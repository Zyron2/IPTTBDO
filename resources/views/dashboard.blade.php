@extends('layouts.app')

@section('content')
    <div class="grid gap-6 lg:grid-cols-4">
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
            <p class="text-sm text-slate-400">Total submissions</p>
            <p class="mt-3 text-4xl font-semibold text-white">{{ $stats['total'] }}</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
            <p class="text-sm text-slate-400">For evaluation</p>
            <p class="mt-3 text-4xl font-semibold text-white">{{ $stats['for_evaluation'] }}</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
            <p class="text-sm text-slate-400">Reviewed</p>
            <p class="mt-3 text-4xl font-semibold text-white">{{ $stats['reviewed'] }}</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
            <p class="text-sm text-slate-400">Registered</p>
            <p class="mt-3 text-4xl font-semibold text-white">{{ $stats['registered'] }}</p>
        </div>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
        <section class="rounded-[2rem] border border-white/10 bg-slate-900/70 p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-amber-300/80">Workspace</p>
                    <h2 class="mt-2 text-2xl font-semibold text-white">{{ $user->isAdmin() ? 'Admin dashboard' : 'Client dashboard' }}</h2>
                </div>
                <a href="{{ route('applications.create') }}" class="rounded-full bg-amber-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-300">New submission</a>
            </div>

            <div class="mt-6 overflow-hidden rounded-2xl border border-white/10">
                <table class="min-w-full divide-y divide-white/10 text-left text-sm">
                    <thead class="bg-white/5 text-slate-300">
                        <tr>
                            <th class="px-4 py-3 font-medium">Tracking</th>
                            <th class="px-4 py-3 font-medium">Branch</th>
                            <th class="px-4 py-3 font-medium">Title</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-4 py-3 font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 bg-slate-950/40 text-slate-200">
                        @forelse ($applications as $application)
                            <tr>
                                <td class="px-4 py-3">{{ $application->tracking_no }}</td>
                                <td class="px-4 py-3">{{ $application->branchLabel() }}</td>
                                <td class="px-4 py-3">{{ $application->title }}</td>
                                <td class="px-4 py-3">{{ $application->statusLabel() }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('applications.show', $application) }}" class="text-amber-300 hover:text-amber-200">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-slate-400">No submissions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <aside class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
            <p class="text-sm uppercase tracking-[0.3em] text-amber-300/80">Flowchart notes</p>
            <div class="mt-4 space-y-4 text-sm leading-6 text-slate-300">
                <div class="rounded-2xl border border-white/10 bg-slate-900/50 p-4">Login opens the system and routes users into a role-aware dashboard.</div>
                <div class="rounded-2xl border border-white/10 bg-slate-900/50 p-4">Branch selection supports IP, Tech Transfer / Commercialization, Business Development, and Incubation.</div>
                <div class="rounded-2xl border border-white/10 bg-slate-900/50 p-4">Submitted records can be reviewed, filtered, updated, and downloaded.</div>
            </div>
        </aside>
    </div>
@endsection