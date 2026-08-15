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
                {{-- Notification bell --}}
                <div class="relative">
                    <button type="button" id="notification-button" class="relative flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white/50 text-gray-500 transition-all hover:bg-white hover:text-gray-900 hover:shadow-sm focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 active:scale-95" onclick="toggleNotifications()">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span id="notification-badge" class="absolute -top-1 -right-1 hidden h-4 min-w-4 items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white"></span>
                    </button>

                    <div id="notification-dropdown" class="hidden absolute right-0 z-50 mt-2 w-80 overflow-hidden rounded-xl border border-gray-100 bg-white shadow-xl">
                        <div class="flex items-center justify-between border-b border-gray-100 px-4 py-3">
                            <p class="text-sm font-semibold text-gray-900">Notifications</p>
                            <button type="button" onclick="markAllNotificationsRead()" class="text-xs font-medium text-amber-600 transition hover:text-amber-700 hover:underline underline-offset-2">Mark all as read</button>
                        </div>
                        <div id="notification-list" class="max-h-80 overflow-y-auto divide-y divide-gray-50">
                            <div class="px-4 py-8 text-center text-sm text-gray-400">Loading…</div>
                        </div>
                    </div>
                </div>

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

    <script>
        const notificationButton = document.getElementById('notification-button');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationList = document.getElementById('notification-list');
        const notificationBadge = document.getElementById('notification-badge');

        async function fetchNotifications() {
            const res = await fetch('{{ route("notifications.index") }}', {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            const data = await res.json();

            renderNotifications(data);

            if (data.unread_count > 0) {
                notificationBadge.textContent = data.unread_count;
                notificationBadge.classList.remove('hidden');
                notificationBadge.classList.add('flex');
            } else {
                notificationBadge.classList.add('hidden');
                notificationBadge.classList.remove('flex');
            }
        }

        function renderNotifications(data) {
            if (!data.notifications.length) {
                notificationList.innerHTML = '<div class="px-4 py-8 text-center text-sm text-gray-400">No notifications yet.</div>';
                return;
            }

            notificationList.innerHTML = data.notifications.map((n) => {
                const url = n.application_id
                    ? '{{ url("applications") }}/' + n.application_id
                    : null;
                const dot = n.read ? '' : '<span class="mt-1.5 h-2 w-2 shrink-0 rounded-full bg-amber-500"></span>';
                const inner = '<div class="flex items-start gap-2">' + dot +
                    '<div class="min-w-0">' +
                    '<p class="text-sm font-medium text-gray-800">' + escapeHtml(n.message) + '</p>' +
                    (n.tracking_no ? '<p class="mt-0.5 font-mono text-xs text-gray-400">' + escapeHtml(n.tracking_no) + '</p>' : '') +
                    '<p class="mt-0.5 text-xs text-gray-400">' + n.created_at + '</p>' +
                    '</div></div>';
                const body = url
                    ? '<a href="' + url + '" onclick="markNotificationRead(\'' + n.id + '\')" class="block px-4 py-3 transition hover:bg-amber-50/50">' + inner + '</a>'
                    : '<div class="block px-4 py-3">' + inner + '</div>';
                return body;
            }).join('');
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str || '';
            return div.innerHTML;
        }

        async function markNotificationRead(id) {
            await fetch('{{ url("notifications") }}/' + id + '/read', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            });
            fetchNotifications();
        }

        async function markAllNotificationsRead() {
            await fetch('{{ route("notifications.read-all") }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            });
            fetchNotifications();
        }

        function toggleNotifications() {
            if (notificationDropdown.classList.contains('hidden')) {
                notificationDropdown.classList.remove('hidden');
                fetchNotifications();
            } else {
                notificationDropdown.classList.add('hidden');
            }
        }

        document.addEventListener('click', function (e) {
            if (!notificationButton.contains(e.target) && !notificationDropdown.contains(e.target)) {
                notificationDropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html>