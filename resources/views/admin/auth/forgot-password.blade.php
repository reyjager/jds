<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Jaguines Digital Solutions</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-10 text-gray-800">
    <main class="w-full max-w-md rounded-2xl bg-white p-8 shadow-xl sm:p-10">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Jaguines Digital Solutions" class="h-16 w-auto mx-auto mb-5">
            <h1 class="text-3xl font-bold">Forgot password?</h1>
            <p class="mt-2 text-gray-500">Enter your email and we will send you a reset link.</p>
        </div>

        @if (session('success'))
            <div class="mb-5 rounded-lg bg-green-100 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-100 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required
                    class="w-full rounded-lg border px-3 py-2.5 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit" class="w-full rounded-lg bg-indigo-600 py-2.5 font-medium text-white hover:bg-indigo-700">
                Email Password Reset Link
            </button>
        </form>

        <a href="{{ route('admin.login') }}" class="mt-6 block text-center text-sm text-indigo-600 hover:underline">Back to admin login</a>
    </main>
</body>
</html>
