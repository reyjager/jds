@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-end">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Overview</p>
            <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">Dashboard</h1>
            <p class="mt-2 text-slate-500">Welcome back, {{ auth()->user()->name }}.</p>
        </div>
        <span class="text-sm text-slate-400">{{ now()->format('F j, Y') }}</span>
    </div>

    <div class="mt-8 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
        <a href="{{ route('admin.services') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md">
            <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-xl text-indigo-600">◈</div>
            <h2 class="font-semibold text-slate-900">Services</h2>
            <p class="mt-2 text-sm text-slate-500">Manage the services you offer.</p>
        </a>
        <a href="{{ route('admin.portfolio') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md">
            <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-violet-50 text-xl text-violet-600">▣</div>
            <h2 class="font-semibold text-slate-900">Portfolio</h2>
            <p class="mt-2 text-sm text-slate-500">Manage your projects.</p>
        </a>
        <a href="{{ route('admin.team') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md">
            <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-xl text-emerald-600">♙</div>
            <h2 class="font-semibold text-slate-900">Team</h2>
            <p class="mt-2 text-sm text-slate-500">Manage team members.</p>
        </a>
        @if (auth()->user()->isAdmin())
            <a href="{{ route('admin.users') }}" class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-indigo-200 hover:shadow-md">
                <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-xl text-amber-600">♧</div>
                <h2 class="font-semibold text-slate-900">Users</h2>
                <p class="mt-2 text-sm text-slate-500">Manage administrator accounts.</p>
            </a>
        @endif
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white/60 p-6">
            <div class="mb-5 flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100 text-xl text-slate-500">✉</div>
            <h2 class="font-semibold text-slate-900">Messages</h2>
            <p class="mt-2 text-sm text-slate-500">Contact messages will be added in a future update.</p>
        </div>
    </div>
@endsection
