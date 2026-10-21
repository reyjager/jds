@extends('layouts.admin')
@section('title', $item->exists ? 'Edit Team Member' : 'Add Team Member')
@section('content')
<section class="max-w-3xl mx-auto px-4 py-10"><h1 class="text-3xl font-bold mb-8">{{ $item->exists ? 'Edit Team Member' : 'Add Team Member' }}</h1><form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-5" data-track-changes>@csrf @if($item->exists) @method('PUT') @endif
@include('admin.content.shared.field', ['name'=>'name','label'=>'Name','value'=>$item->name,'type'=>'text'])
@include('admin.content.shared.field', ['name'=>'role','label'=>'Role','value'=>$item->role,'type'=>'text'])
<div><label class="block text-sm font-medium mb-1" for="bio">Bio</label><textarea id="bio" name="bio" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2">{{ old('bio', $item->bio) }}</textarea></div>
<div><label class="block text-sm font-medium mb-1" for="photo">Photo</label><input id="photo" name="photo" type="file" accept="image/jpeg,image/png,image/webp" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"><p class="mt-1 text-xs text-gray-500">JPG, PNG, or WebP up to 2 MB. Existing image URLs remain supported.</p>@if($item->photo)<img src="{{ $item->photo_url }}" alt="" class="mt-3 h-24 w-24 rounded-lg object-cover">@endif</div>
@include('admin.content.shared.field', ['name'=>'sort_order','label'=>'Sort order','value'=>$item->sort_order,'type'=>'number'])
@include('admin.content.shared.published', ['value'=>$item->exists ? $item->published : true])<button class="bg-indigo-600 text-white px-5 py-2 rounded-lg">Save Team Member</button></form></section>
@endsection
