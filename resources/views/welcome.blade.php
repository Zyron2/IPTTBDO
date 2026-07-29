<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'IPTTBDO') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            @import 'tailwindcss';
        </style>
    @endif
    <style>
        .float-anim { animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        .float-anim-delayed { animation: float 6s ease-in-out infinite; animation-delay: -3s; }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden">
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-50 via-white to-orange-50"></div>
        <div class="absolute top-40 left-20 w-96 h-96 bg-amber-200/20 rounded-full blur-3xl float-anim"></div>
        <div class="absolute bottom-40 right-20 w-[30rem] h-[30rem] bg-orange-200/15 rounded-full blur-3xl float-anim-delayed"></div>
    </div>

    <div class="relative mx-auto flex min-h-screen max-w-6xl flex-col px-4 py-6 lg:py-0">
        <header class="flex items-center justify-end gap-4 py-4">
            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center rounded-full bg-gradient-to-r from-amber-500 to-amber-400 px-5 py-2 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 active:scale-95">
                            Dashboard
                            <svg class="ml-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 transition hover:text-gray-900">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center rounded-full bg-gradient-to-r from-amber-500 to-amber-400 px-5 py-2 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 active:scale-95">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="flex flex-1 flex-col items-center justify-center py-12 lg:py-0">
            <div class="text-center max-w-2xl animate-slide-up">
                <div class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1 mb-6 border border-amber-200/50">
                    <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span class="text-xs font-semibold text-amber-700 uppercase tracking-widest">IPTTBDO System</span>
                </div>

                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                    Innovation Portal for
                    <span class="bg-gradient-to-r from-amber-500 to-orange-500 bg-clip-text text-transparent">IP, Tech Transfer & Business Development</span>
                </h1>

                <p class="mt-6 text-lg leading-relaxed text-gray-500 max-w-xl mx-auto">
                    Streamline your innovation pipeline with role-based dashboards, submission tracking, and automated review management.
                </p>

                <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center rounded-full bg-gradient-to-r from-amber-500 to-amber-400 px-6 py-3 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 active:scale-95">
                            Go to Dashboard
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center rounded-full bg-gradient-to-r from-amber-500 to-amber-400 px-6 py-3 text-sm font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 active:scale-95">
                            Get started
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>

            <div class="mt-16 grid gap-4 sm:grid-cols-3 max-w-2xl w-full">
                <div class="rounded-xl border border-gray-100 bg-white/60 backdrop-blur-sm p-5 text-center transition hover:shadow-md hover:bg-white/80">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600 mx-auto">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <p class="mt-3 text-sm font-semibold text-gray-900">4 Branches</p>
                    <p class="mt-1 text-xs text-gray-500">IP, Tech Transfer, Business Dev, Incubation</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white/60 backdrop-blur-sm p-5 text-center transition hover:shadow-md hover:bg-white/80">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600 mx-auto">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="mt-3 text-sm font-semibold text-gray-900">6 Statuses</p>
                    <p class="mt-1 text-xs text-gray-500">Full submission lifecycle tracking</p>
                </div>
                <div class="rounded-xl border border-gray-100 bg-white/60 backdrop-blur-sm p-5 text-center transition hover:shadow-md hover:bg-white/80">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50 text-amber-600 mx-auto">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <p class="mt-3 text-sm font-semibold text-gray-900">Auto Tracking</p>
                    <p class="mt-1 text-xs text-gray-500">Automatic tracking number generation</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>