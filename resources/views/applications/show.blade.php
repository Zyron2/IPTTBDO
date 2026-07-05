@extends('layouts.app')

@section('content')
    <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr]">
        <section class="rounded-[2rem] border border-white/10 bg-slate-900/70 p-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-amber-300/80">Review details</p>
                    <h2 class="mt-2 text-2xl font-semibold text-white">{{ $application->tracking_no }}</h2>
                    <p class="mt-2 text-slate-400">{{ $application->title }}</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('applications.download', $application) }}" class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/10">Download</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('applications.edit', $application) }}" class="rounded-full bg-amber-400 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-300">Edit</a>
                    @endif
                </div>
            </div>

            <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                    <dt class="text-sm text-slate-400">Branch</dt>
                    <dd class="mt-2 text-white">{{ $application->branchLabel() }}</dd>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                    <dt class="text-sm text-slate-400">Type</dt>
                    <dd class="mt-2 text-white">{{ $application->formTypeLabel() }}</dd>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                    <dt class="text-sm text-slate-400">Status</dt>
                    <dd class="mt-2 text-white">{{ $application->statusLabel() }}</dd>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                    <dt class="text-sm text-slate-400">Date filed</dt>
                    <dd class="mt-2 text-white">{{ optional($application->date_filed)->format('M d, Y') }}</dd>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 sm:col-span-2">
                    <dt class="text-sm text-slate-400">Submitted by</dt>
                    <dd class="mt-2 text-white">{{ $application->submittedBy?->name }} / {{ $application->submittedBy?->email }}</dd>
                </div>
            </dl>

            <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-4">
                <p class="text-sm text-slate-400">Description</p>
                <p class="mt-2 whitespace-pre-line text-slate-100">{{ $application->description }}</p>
            </div>

            <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-4">
                <p class="text-sm text-slate-400">Remarks</p>
                <p class="mt-2 whitespace-pre-line text-slate-100">{{ $application->remarks ?: 'No remarks yet.' }}</p>
            </div>
        </section>

        <aside class="rounded-[2rem] border border-white/10 bg-white/5 p-6">
            <p class="text-sm uppercase tracking-[0.3em] text-amber-300/80">Payload</p>
            <h3 class="mt-2 text-xl font-semibold text-white">Branch-specific details</h3>
            <div class="mt-4 space-y-3 text-sm text-slate-300">
                @forelse(($application->payload ?? []) as $key => $value)
                    <div class="rounded-2xl border border-white/10 bg-slate-900/50 p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">{{ str_replace('_', ' ', $key) }}</p>
                        <p class="mt-2 whitespace-pre-line text-slate-100">{{ is_array($value) ? json_encode($value) : $value }}</p>
                    </div>
                @empty
                    <div class="rounded-2xl border border-white/10 bg-slate-900/50 p-4 text-slate-400">No extra payload stored yet.</div>
                @endforelse
            </div>
        </aside>
    </div>
@endsection