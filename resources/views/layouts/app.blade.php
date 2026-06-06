<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jaguines Digital Solutions')</title>
    <link rel="icon" type="image/png" href="/images/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <nav class="bg-white shadow" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-3">
                <img src="/images/logo.png" alt="Jaguines Digital Solutions" class="h-14 sm:h-20">
                <div class="leading-tight">
                    <span class="block text-base sm:text-lg font-bold text-indigo-600 tracking-[0.3em]">JAGUINES</span>
                    <span class="block text-xs text-gray-500 tracking-widest">DIGITAL SOLUTIONS</span>
                </div>
            </a>
            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="/" class="hover:text-indigo-600 {{ request()->is('/') ? 'text-indigo-600 font-semibold' : '' }}">Home</a>
                <a href="/about" class="hover:text-indigo-600 {{ request()->is('about') ? 'text-indigo-600 font-semibold' : '' }}">About</a>
                <a href="/services" class="hover:text-indigo-600 {{ request()->is('services') ? 'text-indigo-600 font-semibold' : '' }}">Services</a>
                <a href="/portfolio" class="hover:text-indigo-600 {{ request()->is('portfolio') ? 'text-indigo-600 font-semibold' : '' }}">Portfolio</a>
                <a href="/contact" class="hover:text-indigo-600 {{ request()->is('contact') ? 'text-indigo-600 font-semibold' : '' }}">Contact</a>
                <a href="/contact" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Get Quote</a>
            </div>
            <!-- Mobile Hamburger -->
            <button @click="open = !open" class="lg:hidden text-gray-700 focus:outline-none">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="lg:hidden border-t px-4 pb-4 space-y-3">
            <a href="/" class="block py-2 hover:text-indigo-600 {{ request()->is('/') ? 'text-indigo-600 font-semibold' : '' }}">Home</a>
            <a href="/about" class="block py-2 hover:text-indigo-600 {{ request()->is('about') ? 'text-indigo-600 font-semibold' : '' }}">About</a>
            <a href="/services" class="block py-2 hover:text-indigo-600 {{ request()->is('services') ? 'text-indigo-600 font-semibold' : '' }}">Services</a>
            <a href="/portfolio" class="block py-2 hover:text-indigo-600 {{ request()->is('portfolio') ? 'text-indigo-600 font-semibold' : '' }}">Portfolio</a>
            <a href="/contact" class="block py-2 hover:text-indigo-600 {{ request()->is('contact') ? 'text-indigo-600 font-semibold' : '' }}">Contact</a>
            <a href="/contact" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Get Quote</a>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
