@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
    <div>
        <p class="text-xs font-semibold uppercase tracking-wider text-indigo-600">System</p>
        <h1 class="mt-1 text-2xl font-bold sm:text-3xl">Users</h1>
        <p class="mt-1 text-sm text-gray-500">Administrators and editors with CMS access.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="inline-flex min-h-11 items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-indigo-700">Add user</a>
</div>

<div class="overflow-hidden rounded-xl border bg-white shadow-sm">
    <div class="flex items-center justify-between border-b px-6 py-4">
        <h2 class="font-semibold">All users</h2>
        <span class="text-sm text-gray-500">{{ $users->count() }} total</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full min-w-[760px] text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="sticky left-0 z-10 w-14 bg-gray-50 px-2 py-3 font-semibold">Actions</th>
                    <th class="px-6 py-3 font-semibold">Name</th>
                    <th class="px-6 py-3 font-semibold">Username</th>
                    <th class="px-6 py-3 font-semibold">Email</th>
                    <th class="px-6 py-3 font-semibold">Role</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($users as $user)
                    @php($badge = $user->role === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-700')
                    <tr class="hover:bg-gray-50">
                        <td class="sticky left-0 z-10 bg-white px-2 py-4">
                            <x-row-action-menu :label="$user->name" :edit-url="route('admin.users.edit', $user)" :delete-url="route('admin.users.destroy', $user)" :delete-message="'This will soft-delete '.$user->name.'. The account will no longer be active.'" delete-title="Delete user?" delete-action="Delete user" require-confirmation-text />
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <span class="font-medium text-gray-900">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ $user->username }}</td>
                        <td class="whitespace-nowrap px-6 py-4 text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-medium capitalize {{ $badge }}">{{ $user->role }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-10 text-center text-gray-500">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if ($trashedUsers->isNotEmpty())
<section class="mt-8 overflow-hidden rounded-xl border border-amber-200 bg-white shadow-sm">
    <div class="border-b border-amber-100 bg-amber-50 px-6 py-4">
        <h2 class="font-semibold text-amber-900">Recently deleted users</h2>
        <p class="mt-1 text-sm text-amber-800">These accounts are inactive until restored.</p>
    </div>
    <div class="divide-y divide-gray-200">
        @foreach ($trashedUsers as $user)
            <div class="flex flex-col gap-3 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                <div><p class="font-medium text-gray-900">{{ $user->name }}</p><p class="text-sm text-gray-500">{{ $user->username }} · {{ $user->email }}</p></div>
                <form method="POST" action="{{ route('admin.users.restore', $user->id) }}" data-confirm="This will reactivate {{ $user->name }} and allow the account to sign in again." data-confirm-title="Restore user?" data-confirm-action="Restore user">
                    @csrf
                    <button type="submit" class="inline-flex min-h-11 items-center gap-2 rounded-md px-3 text-sm font-medium text-indigo-700 hover:bg-indigo-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><x-icon name="restore" class="size-4" /><span>Restore user</span></button>
                </form>
            </div>
        @endforeach
    </div>
</section>
@endif
@endsection
