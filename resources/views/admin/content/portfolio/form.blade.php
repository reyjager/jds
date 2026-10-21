@extends('layouts.admin')
@section('title', $item->exists ? 'Edit Project' : 'Add Project')
@section('content')
<section class="max-w-3xl mx-auto px-4 py-10"><h1 class="text-3xl font-bold mb-8">{{ $item->exists ? 'Edit Project' : 'Add Project' }}</h1><form method="POST" action="{{ $action }}" class="bg-white rounded-lg shadow p-6 space-y-5" data-track-changes>@csrf @if($item->exists) @method('PUT') @endif
@include('admin.content.shared.field', ['name'=>'title','label'=>'Title','value'=>$item->title,'type'=>'text'])
@include('admin.content.shared.field', ['name'=>'category','label'=>'Category','value'=>$item->category,'type'=>'text'])
<div><label class="block text-sm font-medium mb-1">Description</label><textarea name="description" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2">{{ old('description', $item->description) }}</textarea></div>
@include('admin.content.shared.field', ['name'=>'image','label'=>'Image URL','value'=>$item->image,'type'=>'url'])
@include('admin.content.shared.field', ['name'=>'project_url','label'=>'Project URL','value'=>$item->project_url,'type'=>'url'])
@include('admin.content.shared.field', ['name'=>'sort_order','label'=>'Sort order','value'=>$item->sort_order,'type'=>'number'])
@include('admin.content.shared.published', ['value'=>$item->exists ? $item->published : true])<button class="bg-indigo-600 text-white px-5 py-2 rounded-lg">Save Project</button></form></section>
@endsection
