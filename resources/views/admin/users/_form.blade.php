@csrf

<div class="grid gap-6 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autocomplete="name"
            class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="username" class="mb-1.5 block text-sm font-medium text-gray-700">Username</label>
        <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required autocomplete="username" autocapitalize="none" spellcheck="false"
            class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('username')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="email"
            class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="role" class="mb-1.5 block text-sm font-medium text-gray-700">Role</label>
        <select id="role" name="role" required
            class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @foreach ($roles as $role)
                <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
        @error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700">
            Password
            @if ($user->exists)<span class="font-normal text-gray-500">(leave blank to keep current)</span>@endif
        </label>
        <input id="password" name="password" type="password" {{ $user->exists ? '' : 'required' }} autocomplete="{{ $user->exists ? 'new-password' : 'new-password' }}"
            class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-gray-700">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" {{ $user->exists ? '' : 'required' }} autocomplete="new-password"
            class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('password_confirmation')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>
</div>

<div class="mt-6 flex flex-col-reverse gap-3 border-t pt-5 sm:flex-row sm:justify-end">
    <a href="{{ route('admin.users') }}" class="rounded-lg border border-gray-300 px-4 py-2.5 text-center text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        {{ $user->exists ? 'Update user' : 'Create user' }}
    </button>
</div>
