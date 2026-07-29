<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | IPTTBDO</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .float-anim {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .gradient-text {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="min-h-screen text-gray-900 overflow-x-hidden">
    <div class="fixed inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-50 via-white to-orange-50"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-amber-200/30 rounded-full blur-3xl float-anim"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-orange-200/20 rounded-full blur-3xl float-anim" style="animation-delay: -3s"></div>
    </div>

    <div class="mx-auto flex min-h-screen max-w-6xl items-center justify-center px-4 py-8">
        <div class="grid w-full max-w-5xl gap-0 lg:grid-cols-5 rounded-3xl shadow-2xl overflow-hidden animate-scale-in">
            <!-- Left Section - Branding -->
            <section class="lg:col-span-3 bg-gradient-to-br from-amber-400 via-amber-500 to-orange-500 p-10 lg:p-12 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
                <div class="relative">
                    <div class="mb-8 inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 backdrop-blur-sm border border-white/10">
                        <span class="h-2 w-2 rounded-full bg-white animate-pulse"></span>
                        <span class="text-xs font-medium text-white/90">IPTTBDO System</span>
                    </div>
                    <h1 class="mt-2 text-3xl font-bold leading-tight lg:text-4xl">Innovation Portal for IP, Tech Transfer & Business Development</h1>
                    <p class="mt-4 text-base leading-relaxed text-white/80">Streamline your innovation pipeline with role-based dashboards, submission tracking, and automated review management.</p>

                    <div class="mt-10 grid grid-cols-3 gap-4">
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm p-4 border border-white/10 transition hover:bg-white/15">
                            <p class="text-xs text-white/70">Branches</p>
                            <p class="mt-1 text-2xl font-bold text-white">4</p>
                        </div>
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm p-4 border border-white/10 transition hover:bg-white/15">
                            <p class="text-xs text-white/70">Statuses</p>
                            <p class="mt-1 text-2xl font-bold text-white">6</p>
                        </div>
                        <div class="rounded-2xl bg-white/10 backdrop-blur-sm p-4 border border-white/10 transition hover:bg-white/15">
                            <p class="text-xs text-white/70">Tracking</p>
                            <p class="mt-1 text-2xl font-bold text-white">Auto</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Right Section - Login Form -->
            <section class="lg:col-span-2 glass-card p-10 lg:p-12 flex flex-col justify-center">
                <div class="w-full max-w-sm mx-auto">
                    <div class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1 mb-4">
                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        <span class="text-[11px] font-semibold text-amber-700 uppercase tracking-widest">Access</span>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-900">Welcome back</h2>
                    <p class="mt-2 text-sm text-gray-500">Sign in to access your dashboard.</p>

                    @if ($errors->any())
                    <div class="mt-6 animate-slide-up rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-600">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $errors->first() }}
                        </div>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
                        @csrf
                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">Email</label>
                            <div class="relative">
                                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-xl border border-gray-200 bg-white/50 pl-10 pr-4 py-3 text-gray-900 placeholder-gray-400 outline-none transition-all focus:border-amber-400 focus:ring-1 focus:ring-amber-400 focus:bg-white" placeholder="admin@ipttbdo.test">
                            </div>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative">
                                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <input type="password" name="password" class="w-full rounded-xl border border-gray-200 bg-white/50 pl-10 pr-4 py-3 text-gray-900 placeholder-gray-400 outline-none transition-all focus:border-amber-400 focus:ring-1 focus:ring-amber-400 focus:bg-white" placeholder="••••••••">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer">
                                <input type="checkbox" name="remember" class="rounded border-gray-300 bg-white text-amber-500 focus:ring-amber-400 focus:ring-offset-0 cursor-pointer">
                                Remember me
                            </label>
                        </div>

                        <button type="submit" class="w-full rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 px-4 py-3 font-semibold text-white transition-all hover:from-amber-600 hover:to-amber-500 hover:shadow-lg hover:shadow-amber-200/50 focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 active:scale-[0.98]">
                            Log in
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>

</html>