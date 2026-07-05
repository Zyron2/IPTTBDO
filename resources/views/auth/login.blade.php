<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | IPTTBDO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,rgba(248,180,3,0.2),transparent_26%),radial-gradient(circle_at_bottom_right,rgba(249,115,22,0.14),transparent_28%),linear-gradient(180deg,#0a1020_0%,#050816_100%)]"></div>
    <div class="mx-auto flex min-h-screen max-w-7xl items-center px-6 py-12">
        <div class="grid w-full gap-8 lg:grid-cols-[1.2fr_0.8fr]">
            <section class="rounded-[2rem] border border-white/10 bg-white/5 p-8 shadow-2xl shadow-black/30 backdrop-blur">
                <p class="text-sm uppercase tracking-[0.3em] text-amber-300/80">IPTTBDO System</p>
                <h1 class="mt-4 max-w-2xl text-4xl font-semibold leading-tight text-white lg:text-6xl">A flowchart-driven portal for IP, tech transfer, business development, and incubation.</h1>
                <p class="mt-6 max-w-2xl text-base leading-7 text-slate-300">This system supports login, role-based dashboards, branch selection, submission tracking, revision status, and downloadable review details.</p>
                <div class="mt-8 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                        <p class="text-sm text-slate-400">Branches</p>
                        <p class="mt-2 text-xl font-semibold text-white">4</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                        <p class="text-sm text-slate-400">Statuses</p>
                        <p class="mt-2 text-xl font-semibold text-white">6</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-4">
                        <p class="text-sm text-slate-400">Tracking</p>
                        <p class="mt-2 text-xl font-semibold text-white">Auto code</p>
                    </div>
                </div>
            </section>

            <section class="rounded-[2rem] border border-white/10 bg-slate-900/70 p-8 shadow-2xl shadow-black/30 backdrop-blur">
                <h2 class="text-2xl font-semibold text-white">Sign in</h2>
                <p class="mt-2 text-sm text-slate-400">Use an admin or client account seeded in the database.</p>

                @if ($errors->any())
                    <div class="mt-6 rounded-2xl border border-rose-400/30 bg-rose-400/10 p-4 text-sm text-rose-100">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}" class="mt-6 space-y-5">
                    @csrf
                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-300">Email</span>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none ring-0 transition placeholder:text-slate-500 focus:border-amber-300/60" placeholder="admin@ipttbdo.test">
                    </label>

                    <label class="block">
                        <span class="mb-2 block text-sm font-medium text-slate-300">Password</span>
                        <input type="password" name="password" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none ring-0 transition placeholder:text-slate-500 focus:border-amber-300/60" placeholder="password">
                    </label>

                    <label class="flex items-center gap-3 text-sm text-slate-300">
                        <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/5 text-amber-400 focus:ring-amber-400">
                        Remember me
                    </label>

                    <button class="w-full rounded-2xl bg-amber-400 px-4 py-3 font-semibold text-slate-950 transition hover:bg-amber-300">Log in</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>