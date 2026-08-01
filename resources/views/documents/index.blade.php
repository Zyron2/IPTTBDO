@extends('layouts.app')

@section('content')
<div class="animate-slide-up">
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('dashboard') }}" class="transition hover:text-gray-700">Dashboard</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <a href="{{ route('applications.ip-services') }}" class="transition hover:text-gray-700">IP Services</a>
        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-900 font-medium">Document Dropbox</span>
    </nav>

    <div class="grid gap-6 lg:grid-cols-[1fr_1fr]">
        <section class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="inline-flex items-center gap-1.5 rounded-lg bg-teal-50 px-2.5 py-1">
                <span class="h-1.5 w-1.5 rounded-full bg-teal-500"></span>
                <span class="text-[11px] font-semibold text-teal-700 uppercase tracking-widest">Document Dropbox</span>
            </div>
            <h2 class="mt-2 text-lg font-semibold text-gray-900">Upload documents</h2>
            <p class="mt-1 text-sm text-gray-500">Drop supporting documents here. They will be stored in your personal dropbox.</p>

            <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                @csrf
                <div>
                    @include('applications._file-dropzone', [
                        'name' => 'documents[]',
                        'id' => 'dropbox_documents',
                        'multiple' => true,
                        'hint' => 'Accepted: PDF, DOC, DOCX, JPG, JPEG, PNG, ZIP. Max 2MB each, up to 10 files.',
                    ])
                    @error('documents')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    @error('documents.*')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-teal-500 to-teal-400 px-5 py-2.5 text-sm font-semibold text-white transition-all hover:from-teal-600 hover:to-teal-500 hover:shadow-lg hover:shadow-teal-200/50 focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 active:scale-95">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload documents
                </button>
            </form>
        </section>

        <section class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
            <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1">
                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">My documents</span>
            </div>
            <h2 class="mt-2 text-lg font-semibold text-gray-900">Stored files ({{ count($files) }})</h2>

            <div class="mt-4 space-y-2">
                @forelse($files as $file)
                <div class="flex items-center justify-between gap-3 rounded-lg border border-gray-100 bg-gray-50/50 p-3 transition hover:bg-gray-50">
                    <div class="flex min-w-0 items-center gap-3">
                        <svg class="h-8 w-8 shrink-0 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-gray-900">{{ $file['name'] }}</p>
                            <p class="text-xs text-gray-400">{{ round($file['size'] / 1024, 1) }} KB</p>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-2">
                        <a href="{{ $file['url'] }}" target="_blank" class="inline-flex items-center rounded-lg border border-teal-200 bg-white px-3 py-1.5 text-xs font-medium text-teal-700 transition hover:bg-teal-50">Open</a>
                        <form method="POST" action="{{ route('documents.destroy', $file['name']) }}" onsubmit="return confirm('Delete this document?')">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center rounded-lg border border-red-200 bg-white px-3 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50">Delete</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="rounded-lg border border-gray-100 bg-gray-50/50 p-6 text-center text-sm text-gray-400">No documents uploaded yet.</div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
