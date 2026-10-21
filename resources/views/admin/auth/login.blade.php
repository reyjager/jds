<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login - Jaguines Digital Solutions</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-10 text-gray-800">
    <main class="w-full max-w-md">
        <section class="bg-white rounded-2xl shadow-xl p-8 sm:p-10">
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Jaguines Digital Solutions" class="h-16 w-auto mx-auto mb-5">
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-indigo-600">Restricted Area</p>
                <h1 class="mt-2 text-3xl font-bold">Admin Login</h1>
                <p class="mt-2 text-gray-500">Sign in to manage your website</p>
            </div>

            @if (session('success'))
                <div class="mb-5 rounded-lg bg-green-100 px-4 py-3 text-sm text-green-800" role="status">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-lg bg-red-100 px-4 py-3 text-sm text-red-800" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="login" class="block text-sm font-medium mb-1">Username or email</label>
                    <input id="login" type="text" name="login" value="{{ old('login') }}"
                        autocomplete="username" autocapitalize="none" spellcheck="false" autofocus required
                        class="w-full rounded-lg border border-gray-300 px-3 py-2.5 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password"
                            autocomplete="current-password" required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2.5 pr-12 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button type="button" id="togglePassword" aria-label="Show password"
                            class="absolute inset-y-0 right-0 px-3 text-gray-500 hover:text-indigo-600"
                            aria-controls="password">
                            <svg id="showPasswordIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-4 text-sm">
                    <label class="flex items-center gap-2 text-gray-600">
                        <input type="checkbox" name="remember" value="1" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        Remember me
                    </label>
                    <a href="{{ route('admin.password.request') }}" class="text-indigo-600 hover:underline">Forgot password?</a>
                </div>

                <button type="submit" id="submitBtn"
                    class="w-full rounded-lg bg-indigo-600 py-2.5 font-medium text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-60">
                    Sign In
                </button>
            </form>
        </section>
    </main>

    <script>
        const submitButton = document.getElementById('submitBtn');

        submitButton.form.addEventListener('submit', () => {
            submitButton.disabled = true;
            submitButton.textContent = 'Signing in...';
        });
    </script>
</body>
</html>
