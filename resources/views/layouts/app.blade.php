<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'IPTTBDO System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-amber-50/30 text-gray-900 antialiased">
    <header class="sticky top-0 z-50 border-b border-gray-100/80 bg-white/80 backdrop-blur-xl shadow-sm">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1 transition hover:bg-amber-100">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">IPTTBDO</span>
                    </div>
                    <span class="hidden h-4 w-px bg-gray-200 sm:block"></span>
                    <h1 class="hidden text-sm font-medium text-gray-500 sm:block">Innovation Portal</h1>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-lg border border-gray-200 bg-white/50 px-4 py-1.5 text-sm font-medium text-gray-600 transition-all hover:bg-white hover:text-gray-900 hover:shadow-sm focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 active:scale-95">Sign out</button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 animate-fade-in">
        @if (session('success'))
        <div class="mb-6 animate-slide-up rounded-xl border border-emerald-200/80 bg-emerald-50/90 px-4 py-3 text-sm text-emerald-700 backdrop-blur-sm shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-gray-100 bg-white/50 backdrop-blur-sm mt-12">
        <div class="mx-auto max-w-6xl px-4 py-6 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} IPTTBDO System &mdash; Innovation Portal for IP, Tech Transfer &amp; Business Development
        </div>
    </footer>

    @stack('scripts')
</body>

</html>