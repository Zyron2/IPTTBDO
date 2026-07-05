@extends('layouts.app')

@section('content')
    <div class="rounded-[2rem] border border-white/10 bg-slate-900/70 p-6">
        <p class="text-sm uppercase tracking-[0.3em] text-amber-300/80">New submission</p>
        <h2 class="mt-2 text-2xl font-semibold text-white">Create application</h2>

        <form method="POST" action="{{ route('applications.store') }}" class="mt-6 grid gap-6 lg:grid-cols-2">
            @csrf
            <label class="block">
                <span class="mb-2 block text-sm text-slate-300">Branch</span>
                <select name="branch" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white">
                    @foreach ($branches as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block">
                <span class="mb-2 block text-sm text-slate-300">Form type</span>
                <select name="application_type" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white">
                    <option value="">Select type</option>
                    @foreach ($formTypes as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block lg:col-span-2">
                <span class="mb-2 block text-sm text-slate-300">Title</span>
                <input type="text" name="title" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white" placeholder="Startup name or IP title">
            </label>

            <label class="block lg:col-span-2">
                <span class="mb-2 block text-sm text-slate-300">Description</span>
                <textarea name="description" rows="4" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white" placeholder="Describe the submission, idea, or project"></textarea>
            </label>

            <label class="block">
                <span class="mb-2 block text-sm text-slate-300">Proponent name</span>
                <input type="text" name="proponent_name" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white">
            </label>

            <label class="block">
                <span class="mb-2 block text-sm text-slate-300">Inventor name</span>
                <input type="text" name="inventor_name" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white">
            </label>

            <label class="block">
                <span class="mb-2 block text-sm text-slate-300">Startup name</span>
                <input type="text" name="startup_name" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white">
            </label>

            <label class="block">
                <span class="mb-2 block text-sm text-slate-300">Date filed</span>
                <input type="date" name="date_filed" value="{{ now()->toDateString() }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white">
            </label>

            <label class="block lg:col-span-2">
                <span class="mb-2 block text-sm text-slate-300">Remarks</span>
                <textarea name="remarks" rows="3" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white" placeholder="Review notes or revisions"></textarea>
            </label>

            <label class="block lg:col-span-2">
                <span class="mb-2 block text-sm text-slate-300">Payload</span>
                <textarea name="payload[ip_ownership]" rows="3" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white" placeholder="Optional branch-specific data can be documented here as text for now."></textarea>
            </label>

            <div class="lg:col-span-2 flex items-center gap-4">
                <button class="rounded-full bg-amber-400 px-5 py-3 font-semibold text-slate-950 transition hover:bg-amber-300">Submit application</button>
                <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-white">Cancel</a>
            </div>
        </form>
    </div>
@endsection