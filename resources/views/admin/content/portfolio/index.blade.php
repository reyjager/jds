@extends('layouts.admin')
@section('title', 'Manage Portfolio')
@section('content')
<section class="max-w-7xl mx-auto px-4 py-10"><div class="flex justify-between items-center mb-8"><h1 class="text-3xl font-bold">Portfolio</h1><a href="{{ route('admin.portfolio.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Add Project</a></div>@if(session('success'))<div class="mb-5 bg-green-100 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>@endif<div class="bg-white rounded-lg shadow divide-y">@forelse($items as $item)<div class="p-5 flex justify-between gap-4"><div><h2 class="font-semibold">{{ $item->title }}</h2><p class="text-sm text-gray-600">{{ $item->category }}</p></div><div class="flex gap-3"><a class="text-indigo-600" href="{{ route('admin.portfolio.edit', $item) }}">Edit</a><form method="POST" action="{{ route('admin.portfolio.destroy', $item) }}" data-confirm="This will remove the portfolio project from the admin list. Continue?" data-confirm-title="Delete project?" data-confirm-action="Delete project">@csrf @method('DELETE')<button type="submit" class="text-red-600">Delete</button></form></div></div>@empty<div class="p-6 text-gray-500">No portfolio projects yet.</div>@endforelse</div></section>
@if ($trashedItems->isNotEmpty())
<section class="mx-auto mt-8 max-w-7xl rounded-lg border border-amber-200 bg-white p-5">
    <h2 class="font-semibold text-amber-900">Recently deleted projects</h2>
    <div class="mt-3 divide-y">@foreach ($trashedItems as $item)<div class="flex items-center justify-between gap-3 py-3"><span>{{ $item->title }}</span><form method="POST" action="{{ route('admin.portfolio.restore', $item->id) }}" data-confirm="Restore this project and make it available in the admin list again?" data-confirm-title="Restore project?" data-confirm-action="Restore project">@csrf<button type="submit" class="text-sm font-medium text-indigo-700">Restore</button></form></div>@endforeach</div>
</section>
@endif
@endsection
