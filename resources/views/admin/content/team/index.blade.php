@extends('layouts.admin')

@section('title', 'Manage Team')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-10">
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div><h1 class="text-3xl font-bold">Team Members</h1><p class="mt-1 text-sm text-gray-500">{{ $items->count() }} active member{{ $items->count() === 1 ? '' : 's' }}</p></div>
        <a href="{{ route('admin.team.create') }}" class="inline-flex min-h-11 items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Add Member</a>
    </div>
    <div class="overflow-hidden rounded-lg border bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[520px] text-left text-sm">
                <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                    <tr><th class="sticky left-0 z-10 w-14 bg-gray-50 px-2 py-3 font-semibold">Actions</th><th class="px-6 py-3 font-semibold">Name</th><th class="px-6 py-3 font-semibold">Role</th><th class="px-6 py-3 font-semibold">Status</th></tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="sticky left-0 z-10 bg-white px-2 py-4"><x-row-action-menu :label="$item->name" :edit-url="route('admin.team.edit', $item)" :delete-url="route('admin.team.destroy', $item)" :delete-message="'This will remove '.$item->name.' from the active team list. You can restore the member later.'" delete-title="Delete team member?" delete-action="Delete team member" require-confirmation-text /></td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->role }}</td>
                            <td class="px-6 py-4"><span class="rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700">Published</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-6 py-10 text-gray-500">No team members yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@if ($trashedItems->isNotEmpty())
<section class="mx-auto mt-8 max-w-7xl rounded-lg border border-amber-200 bg-white p-5">
    <h2 class="font-semibold text-amber-900">Recently deleted team members</h2>
    <div class="mt-3 divide-y">@foreach ($trashedItems as $item)<div class="flex items-center justify-between gap-3 py-3"><span>{{ $item->name }}</span><form method="POST" action="{{ route('admin.team.restore', $item->id) }}" data-confirm="Restore this team member and make it available in the admin list again?" data-confirm-title="Restore team member?" data-confirm-action="Restore team member">@csrf<button type="submit" class="inline-flex min-h-11 items-center gap-2 rounded-md px-3 text-sm font-medium text-indigo-700 hover:bg-indigo-50"><x-icon name="restore" class="size-4" /><span>Restore</span></button></form></div>@endforeach</div>
</section>
@endif
@endsection
