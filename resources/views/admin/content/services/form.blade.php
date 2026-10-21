@extends('layouts.admin')
@section('title', $item->exists ? 'Edit Service' : 'Add Service')
@section('content')
<section class="max-w-3xl mx-auto px-4 py-10"><h1 class="text-3xl font-bold mb-8">{{ $item->exists ? 'Edit Service' : 'Add Service' }}</h1>
<form method="POST" action="{{ $action }}" class="bg-white rounded-lg shadow p-6 space-y-5" data-track-changes>@csrf @if($item->exists) @method('PUT') @endif
@include('admin.content.shared.field', ['name'=>'name','label'=>'Name','value'=>$item->name,'type'=>'text'])
<div><label class="block text-sm font-medium mb-1">Description</label><textarea name="description" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>{{ old('description', $item->description) }}</textarea></div>
<div><label class="block text-sm font-medium mb-1">Features (one per line)</label><textarea name="features" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2">{{ old('features', implode("\n", $item->features ?? [])) }}</textarea></div>
@include('admin.content.shared.field', ['name'=>'image','label'=>'Image URL','value'=>$item->image,'type'=>'url'])
@include('admin.content.shared.field', ['name'=>'sort_order','label'=>'Sort order','value'=>$item->sort_order,'type'=>'number'])
@include('admin.content.shared.published', ['value'=>$item->exists ? $item->published : true])
<button class="bg-indigo-600 text-white px-5 py-2 rounded-lg">Save Service</button></form></section>
@endsection
