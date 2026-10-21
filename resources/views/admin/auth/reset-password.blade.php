<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password - Jaguines Digital Solutions</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-10 text-gray-800">
    <main class="w-full max-w-md rounded-2xl bg-white p-8 shadow-xl sm:p-10">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Jaguines Digital Solutions" class="h-16 w-auto mx-auto mb-5">
            <h1 class="text-3xl font-bold">Set new password</h1>
        </div>

        @if ($errors->any())
            <div class="mb-5 rounded-lg bg-red-100 px-4 py-3 text-sm text-red-800">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email', $email) }}" autocomplete="email" required
                    class="w-full rounded-lg border px-3 py-2.5 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium mb-1">New password</label>
                <input id="password" type="password" name="password" autocomplete="new-password" required
                    class="w-full rounded-lg border px-3 py-2.5 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirm new password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required
                    class="w-full rounded-lg border px-3 py-2.5 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <button type="submit" class="w-full rounded-lg bg-indigo-600 py-2.5 font-medium text-white hover:bg-indigo-700">
                Reset Password
            </button>
        </form>
    </main>
</body>
</html>
