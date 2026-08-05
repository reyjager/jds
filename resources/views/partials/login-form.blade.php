<div class="mt-8 bg-white text-gray-800 rounded-lg shadow-lg p-6 w-80 mx-auto">
    <h2 class="text-xl font-bold mb-4">Login</h2>

    @if (session('login_error'))
        <div class="mb-4 bg-red-100 text-red-700 text-sm px-4 py-3 rounded-lg">
            {{ session('login_error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 text-sm px-4 py-3 rounded-lg">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" autocomplete="username"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 {{ $errors->has('username') ? 'border-red-500' : '' }}" required>
            @error('username')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" autocomplete="current-password"
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 {{ $errors->has('password') ? 'border-red-500' : '' }}" required>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">Login</button>
    </form>
    <input required>
</div>
