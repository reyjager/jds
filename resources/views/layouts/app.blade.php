<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jaguines Digital Solutions')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-3">
                <img src="/images/logo.png" alt="Jaguines Digital Solutions" class="h-20">
                <div class="leading-tight">
                    <span class="block text-lg font-bold text-indigo-600 tracking-[0.3em]">JAGUINES</span>
                    <span class="block text-xs text-gray-500 tracking-widest">DIGITAL SOLUTIONS</span>
                </div>
            </a>
            <div class="space-x-6">
                <a href="/" class="hover:text-indigo-600 {{ request()->is('/') ? 'text-indigo-600 font-semibold' : '' }}">Home</a>
                <a href="/about" class="hover:text-indigo-600 {{ request()->is('about') ? 'text-indigo-600 font-semibold' : '' }}">About</a>
                <a href="/services" class="hover:text-indigo-600 {{ request()->is('services') ? 'text-indigo-600 font-semibold' : '' }}">Services</a>
                <a href="/portfolio" class="hover:text-indigo-600 {{ request()->is('portfolio') ? 'text-indigo-600 font-semibold' : '' }}">Portfolio</a>
                <a href="/contact" class="hover:text-indigo-600 {{ request()->is('contact') ? 'text-indigo-600 font-semibold' : '' }}">Contact</a>
                <a href="/contact" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Get Quote</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
