@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="mb-8">
        <p class="text-xs font-semibold uppercase tracking-wider text-indigo-600">System</p>
        <h1 class="mt-1 text-2xl font-bold sm:text-3xl">Edit user</h1>
        <p class="mt-1 text-sm text-gray-500">Update {{ $user->name }}'s CMS account.</p>
    </div>

    <div class="max-w-3xl rounded-xl border bg-white p-6 shadow-sm sm:p-8">
        <form method="POST" action="{{ route('admin.users.update', $user) }}" data-track-changes>
            @method('PUT')
            @include('admin.users._form')
        </form>
    </div>
@endsection
