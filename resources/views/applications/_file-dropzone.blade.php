@php
    $dzId = $id ?? $name;
    $dzMultiple = $multiple ?? false;
    $dzRequired = $required ?? false;
    $dzAccept = $accept ?? '.pdf,.doc,.docx,.jpg,.jpeg,.png';
@endphp
<div class="file-dropzone group relative overflow-hidden rounded-xl border-2 border-dashed border-gray-300 bg-gray-50/50 p-6 text-center transition-all hover:border-emerald-300 hover:bg-emerald-50/30" id="{{ $dzId }}-dz">
    <input type="file" name="{{ $name }}" id="{{ $dzId }}" accept="{{ $dzAccept }}" @if($dzMultiple) multiple @endif @if($dzRequired) required @endif class="sr-only">
    <div class="dz-inner">
        <svg class="mx-auto h-10 w-10 text-gray-300 transition-all group-hover:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
        </svg>
        <p class="dz-message mt-3">
            <span class="block text-sm font-semibold text-gray-700">Drag &amp; drop your file{{ $dzMultiple ? 's' : '' }} here</span>
            <span class="mt-0.5 block text-xs text-gray-400">or click to browse</span>
        </p>
        <div class="dz-files mt-3 flex flex-wrap justify-center gap-2"></div>
    </div>
</div>
@if(isset($hint) && $hint)
<p class="mt-1.5 text-xs italic text-gray-500">{{ $hint }}</p>
@endif

@once
@push('scripts')
<script>
    function initDropzone(el) {
        var input = el.querySelector('input[type="file"]');
        var list = el.querySelector('.dz-files');
        var message = el.querySelector('.dz-message');
        var multiple = input.hasAttribute('multiple');
        var dt = new DataTransfer();

        function render() {
            list.innerHTML = '';
            dt.items.forEach(function (item, i) {
                var file = item.getAsFile();
                var chip = document.createElement('span');
                chip.className = 'inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-white px-3 py-1 text-xs font-medium text-gray-700 shadow-sm';
                var name = document.createElement('span');
                name.className = 'max-w-[160px] truncate';
                name.textContent = file.name;
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'text-red-400 hover:text-red-600';
                btn.textContent = '\u00d7';
                btn.addEventListener('click', function () {
                    dt.remove(i);
                    input.files = dt.files;
                    render();
                });
                chip.appendChild(name);
                chip.appendChild(btn);
                list.appendChild(chip);
            });
            message.style.display = dt.files.length ? 'none' : '';
        }

        input.addEventListener('change', function () {
            Array.prototype.forEach.call(input.files, function (f) {
                if (multiple || dt.files.length === 0) dt.items.add(f);
            });
            input.files = dt.files;
            render();
        });

        ['dragenter', 'dragover'].forEach(function (ev) {
            el.addEventListener(ev, function (e) {
                e.preventDefault();
                el.classList.add('border-emerald-400', 'bg-emerald-50/40');
            });
        });
        ['dragleave', 'drop'].forEach(function (ev) {
            el.addEventListener(ev, function (e) {
                e.preventDefault();
                el.classList.remove('border-emerald-400', 'bg-emerald-50/40');
            });
        });
        el.addEventListener('drop', function (e) {
            if (e.dataTransfer && e.dataTransfer.files.length) {
                Array.prototype.forEach.call(e.dataTransfer.files, function (f) {
                    if (multiple || dt.files.length === 0) dt.items.add(f);
                });
                input.files = dt.files;
                render();
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.file-dropzone').forEach(initDropzone);
    });
</script>
@endpush
@endonce
