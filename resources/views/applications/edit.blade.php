@extends('layouts.app')

@section('content')
<div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md animate-slide-up">
    <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
        <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Admin edit</span>
    </div>
    <h2 class="mt-2 text-lg font-semibold text-gray-900">Update application</h2>

    <form method="POST" action="{{ route('applications.update', $application) }}" class="mt-6 grid gap-5 lg:grid-cols-2">
        @csrf
        @method('PUT')
        <label class="block">
            <span class="mb-1.5 block text-sm font-medium text-gray-600">Branch</span>
            <select name="branch" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
                @foreach ($branches as $key => $label)
                <option value="{{ $key }}" @selected($application->branch === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </label>

        <label class="block">
            <span class="mb-1.5 block text-sm font-medium text-gray-600">Status</span>
            <select name="status" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
                @foreach ($statuses as $key => $label)
                <option value="{{ $key }}" @selected($application->status === $key)>{{ $label }}</option>
                @endforeach
            </select>
        </label>

        <script>
            function toggleSections(value) {
                const standardFields = document.getElementById('standard-fields-section');
                standardFields.style.display = 'none';

                if (value !== 'ip' && value !== 'consultation') {
                    standardFields.style.display = 'contents';
                }
            }

            document.querySelector('select[name="branch"]').addEventListener('change', function() {
                toggleSections(this.value);
            });

            document.addEventListener('DOMContentLoaded', function() {
                const branchSelect = document.querySelector('select[name="branch"]');
                toggleSections(branchSelect.value);
            });
        </script>

        <div id="standard-fields-section" class="contents lg:col-span-2">
            <label class="block lg:col-span-2">
                <span class="mb-1.5 block text-sm font-medium text-gray-600">Title</span>
                <input type="text" name="title" value="{{ $application->title }}" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
            </label>

            <label class="block lg:col-span-2">
                <span class="mb-1.5 block text-sm font-medium text-gray-600">Description</span>
                <textarea name="description" rows="4" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">{{ $application->description }}</textarea>
            </label>

            <label class="block">
                <span class="mb-1.5 block text-sm font-medium text-gray-600">Proponent name</span>
                <input type="text" name="proponent_name" value="{{ $application->proponent_name }}" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
            </label>

            <label class="block">
                <span class="mb-1.5 block text-sm font-medium text-gray-600">Inventor name</span>
                <input type="text" name="inventor_name" value="{{ $application->inventor_name }}" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
            </label>

            <label class="block">
                <span class="mb-1.5 block text-sm font-medium text-gray-600">Startup name</span>
                <input type="text" name="startup_name" value="{{ $application->startup_name }}" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
            </label>

            <label class="block">
                <span class="mb-1.5 block text-sm font-medium text-gray-600">Date filed</span>
                <input type="date" name="date_filed" value="{{ optional($application->date_filed)->format('Y-m-d') }}" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">
            </label>

            <label class="block lg:col-span-2">
                <span class="mb-1.5 block text-sm font-medium text-gray-600">Remarks</span>
                <textarea name="remarks" rows="3" class="w-full rounded-lg border border-gray-200 bg-white px-3.5 py-2.5 text-sm text-gray-900 outline-none placeholder-gray-400 transition-all focus:border-amber-400 focus:ring-2 focus:ring-amber-100 focus:bg-amber-50/30">{{ $application->remarks }}</textarea>
            </label>
        </div>

        <div class="lg:col-span-2 flex items-center gap-4 pt-2">
            <button class="inline-flex items-center rounded-lg bg-gradient-to-r from-amber-500 to-amber-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 active:scale-95">
                <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>
                Save changes
            </button>
            <a href="{{ route('applications.show', $application) }}" class="text-sm font-medium text-gray-500 transition-all hover:text-gray-700 hover:underline underline-offset-4">Cancel</a>
        </div>
    </form>
</div>
@endsection