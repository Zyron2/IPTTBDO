@extends('layouts.app')

@section('content')
<div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md animate-slide-up">
    <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
        <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">New submission</span>
    </div>
    <h2 class="mt-2 text-lg font-semibold text-gray-900">Submit an application</h2>

    <form method="POST" action="{{ route('applications.store') }}" class="mt-6 grid gap-5 lg:grid-cols-2">
        @csrf
        <input type="hidden" name="branch" value="{{ request('branch') ?? old('branch') }}">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const branch = document.querySelector('input[name="branch"]').value;
                const standardFields = document.getElementById('standard-fields-section');

                if (branch !== 'ip' && branch !== 'consultation') {
                    standardFields.style.display = 'contents';
                }
            });
        </script>

        <div id="standard-fields-section" class="contents lg:col-span-2">
            <div class="block lg:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Title</label>
                <input type="text" name="title" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30" placeholder="Startup name or IP title">
            </div>

            <div class="block lg:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Description</label>
                <textarea name="description" rows="4" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30" placeholder="Describe the submission, idea, or project"></textarea>
            </div>

            <div class="block">
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Proponent name</label>
                <input type="text" name="proponent_name" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
            </div>

            <div class="block">
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Inventor name</label>
                <input type="text" name="inventor_name" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
            </div>

            <div class="block">
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Startup name</label>
                <input type="text" name="startup_name" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
            </div>

            <div class="block">
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Date filed</label>
                <input type="date" name="date_filed" value="{{ now()->toDateString() }}" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
            </div>

            <div class="block lg:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Remarks</label>
                <textarea name="remarks" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30" placeholder="Review notes or revisions"></textarea>
            </div>

            <div class="block lg:col-span-2">
                <label class="mb-1.5 block text-sm font-medium text-gray-600">Additional Details</label>
                <textarea name="payload[ip_ownership]" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30" placeholder="Optional branch-specific data can be documented here as text for now."></textarea>
            </div>
        </div>

        <div class="lg:col-span-2 flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-amber-500 to-amber-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 active:scale-95">
                <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Submit application
            </button>
            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 transition-all hover:text-gray-700 hover:underline underline-offset-4">Cancel</a>
        </div>
    </form>
</div>
@endsection