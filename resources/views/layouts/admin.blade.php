<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') - Jaguines Digital Solutions</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script>
        if (localStorage.getItem('sidebar-collapsed') === '1') {
            document.documentElement.classList.add('sidebar-collapsed');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    <div id="overlay" class="fixed inset-0 z-30 hidden bg-black/40 lg:hidden"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col overflow-hidden rounded-r-2xl border-r bg-white shadow-xl lg:inset-y-3 lg:left-3 lg:translate-x-0 lg:rounded-2xl lg:border lg:shadow-sm">
        <div class="flex h-16 items-center gap-3 border-b px-5">
            <button type="button" id="toggleSidebar" aria-label="Toggle sidebar" title="Toggle sidebar"
                class="flex shrink-0 items-center rounded-lg text-left outline-none ring-indigo-500 focus-visible:ring-2">
                <img src="{{ asset('images/logo.png') }}" alt="Jaguines Digital Solutions" class="h-9 w-auto">
            </button>
            <div class="sidebar-label">
                <p class="text-sm font-bold leading-tight">Jaguines Digital</p>
                <p class="text-xs text-gray-500">Admin Panel</p>
            </div>
        </div>

        @php
            $nav = [
                ['Dashboard', 'admin.dashboard', 'admin.dashboard', null, false, '<rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>'],
                ['About page', 'admin.about.edit', 'admin.about.*', 'Content', false, '<circle cx="12" cy="12" r="9"/><path d="M12 10v6"/><path d="M12 7h.01"/>'],
                ['Services', 'admin.services', 'admin.services*', 'Content', false, '<polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>'],
                ['Portfolio', 'admin.portfolio', 'admin.portfolio*', 'Content', false, '<rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>'],
                ['Team', 'admin.team', 'admin.team*', 'Content', false, '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
                ['Users', 'admin.users', 'admin.users*', 'System', true, '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
            ];
            $lastSection = null;
        @endphp

        <nav class="flex-1 space-y-1 overflow-y-auto p-4">
            @foreach ($nav as [$label, $route, $match, $section, $adminOnly, $icon])
                @continue($adminOnly && ! auth()->user()->isAdmin())

                @if ($section && $section !== $lastSection)
                    <p class="sidebar-label px-3 pt-5 pb-1 text-xs font-semibold uppercase tracking-wider text-gray-400">{{ $section }}</p>
                    <hr class="sidebar-rule my-3">
                    @php $lastSection = $section; @endphp
                @endif

                @php $isActive = request()->routeIs($match); @endphp
                <a href="{{ route($route) }}" title="{{ $label }}"
                    class="sidebar-item flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition {{ $isActive ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 {{ $isActive ? 'text-indigo-600' : 'text-gray-400' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">{!! $icon !!}</svg>
                    <span class="sidebar-label">{{ $label }}</span>
                </a>
            @endforeach
        </nav>

        <div class="border-t p-4">
            <div class="sidebar-item flex items-center gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="sidebar-label min-w-0">
                    <p class="truncate text-sm font-medium">{{ auth()->user()->name }}</p>
                    <p class="text-xs capitalize text-gray-500">{{ auth()->user()->role }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.logout') }}" class="mt-3" data-confirm="Sign out of the admin panel?" data-confirm-title="Sign out?" data-confirm-action="Sign out">
                @csrf
                <button type="submit" title="Logout"
                    class="sidebar-item flex w-full items-center justify-center gap-2 rounded-lg border py-2 text-sm font-medium text-red-600 transition hover:bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    <span class="sidebar-label">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div id="main" class="relative min-h-screen lg:ml-[17rem]">
        <header class="flex h-16 items-center justify-between border-b bg-white px-4 lg:hidden">
            <button type="button" data-sidebar-toggle aria-label="Open navigation menu"
                class="rounded-lg p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <span class="text-sm font-semibold text-gray-700">@yield('title', 'Admin')</span>
            <span class="w-10" aria-hidden="true"></span>
        </header>

        <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer"
            class="absolute right-4 top-4 z-20 text-sm text-gray-500 hover:text-indigo-600 sm:right-6 lg:right-8">
            View website &nearr;
        </a>

        <main class="p-4 pt-8 sm:p-6 lg:p-8 lg:pt-20">
            <div class="mx-auto max-w-6xl">
                @yield('content')
            </div>
        </main>
    </div>

    <div id="confirmation-modal" class="fixed inset-0 z-[110] hidden items-center justify-center bg-slate-950/50 p-4" role="dialog" aria-modal="true" aria-labelledby="confirmation-modal-title" aria-describedby="confirmation-modal-message">
        <div data-confirm-panel class="w-full max-w-md rounded-2xl border border-red-200 bg-red-50 p-6 text-center shadow-2xl">
            <h2 id="confirmation-modal-title" class="text-lg font-semibold text-gray-900">Please confirm</h2>
            <p id="confirmation-modal-message" class="mt-2 text-sm text-gray-700"></p>
            <div data-confirm-input-wrap class="mt-4 hidden">
                <label for="confirmation-modal-input" class="block text-sm font-medium text-gray-800">Type <span class="font-mono text-red-700">confirm</span> to continue</label>
                <input id="confirmation-modal-input" data-confirm-input type="text" autocomplete="off" autocapitalize="none" spellcheck="false" class="mt-2 block w-full rounded-lg border border-red-300 bg-white px-3 py-2.5 text-left focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500">
                <p data-confirm-feedback class="mt-2 min-h-5 text-sm text-red-600" aria-live="polite"></p>
            </div>
            <div class="mt-6 flex flex-col-reverse justify-center gap-3 sm:flex-row">
                <button type="button" data-confirm-cancel class="rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cancel</button>
                <button type="button" data-confirm-submit class="rounded-lg bg-red-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Confirm</button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="pointer-events-none fixed right-4 top-4 z-[100] flex w-[min(24rem,calc(100vw-2rem))] flex-col gap-3 sm:right-6 lg:right-8">
        @if (session('success'))
            <div data-toast class="pointer-events-auto flex items-start gap-3 rounded-xl border border-green-200 bg-white p-4 text-sm text-green-800 shadow-lg" role="status">
                <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-green-100 font-bold text-green-700">✓</span>
                <p class="flex-1">{{ session('success') }}</p>
                <button type="button" data-dismiss-toast aria-label="Dismiss notification" class="text-lg leading-none text-green-600 hover:text-green-900">&times;</button>
            </div>
        @endif
        @if (session('error'))
            <div data-toast class="pointer-events-auto flex items-start gap-3 rounded-xl border border-red-200 bg-white p-4 text-sm text-red-800 shadow-lg" role="alert">
                <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-red-100 font-bold text-red-700">!</span>
                <p class="flex-1">{{ session('error') }}</p>
                <button type="button" data-dismiss-toast aria-label="Dismiss notification" class="text-lg leading-none text-red-600 hover:text-red-900">&times;</button>
            </div>
        @endif
        @if ($errors->any())
            <div data-toast class="pointer-events-auto flex items-start gap-3 rounded-xl border border-amber-200 bg-white p-4 text-sm text-amber-900 shadow-lg" role="alert">
                <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-amber-100 font-bold text-amber-700">!</span>
                <p class="flex-1">{{ $errors->first() }}</p>
                <button type="button" data-dismiss-toast aria-label="Dismiss notification" class="text-lg leading-none text-amber-600 hover:text-amber-900">&times;</button>
            </div>
        @endif
    </div>

    <script>
        const root = document.documentElement;
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const sidebarToggleButtons = document.querySelectorAll('[data-sidebar-toggle], #toggleSidebar');

        function openMenu() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeMenu() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        function toggleSidebar() {
            if (window.innerWidth >= 1024) {
                const collapsed = root.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', collapsed ? '1' : '0');
            } else if (sidebar.classList.contains('-translate-x-full')) {
                openMenu();
            } else {
                closeMenu();
            }
        }

        sidebarToggleButtons.forEach((button) => button.addEventListener('click', toggleSidebar));
        overlay.addEventListener('click', closeMenu);
        sidebar.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMenu));

        document.querySelectorAll('[data-toast]').forEach((toast) => {
            const dismiss = () => toast.remove();
            toast.querySelector('[data-dismiss-toast]').addEventListener('click', dismiss);
            window.setTimeout(dismiss, 5000);
        });
    </script>
</body>
</html>
