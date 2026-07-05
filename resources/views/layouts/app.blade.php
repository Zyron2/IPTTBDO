<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'IPTTBDO System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,rgba(248,180,3,0.18),transparent_32%),radial-gradient(circle_at_top_right,rgba(249,115,22,0.18),transparent_30%),linear-gradient(180deg,#0b1020_0%,#050816_100%)]"></div>
    <header class="border-b border-white/10 bg-white/5 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-amber-300/80">IPTTBDO</p>
                <h1 class="text-lg font-semibold text-white">Innovation, IP, Tech Transfer, Business Development, and Incubation</h1>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/20">Sign out</button>
            </form>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-8">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-400/30 bg-emerald-400/10 px-4 py-3 text-emerald-100">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>