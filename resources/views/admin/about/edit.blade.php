@extends('layouts.admin')

@section('title', 'Edit About Page')

@section('content')
<section class="mx-auto max-w-3xl">
    <div class="mb-8">
        <p class="text-xs font-semibold uppercase tracking-wider text-indigo-600">Content</p>
        <h1 class="mt-1 text-2xl font-bold sm:text-3xl">About page</h1>
        <p class="mt-1 text-sm text-gray-500">Update the public About page content and statistics.</p>
    </div>

    <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data" class="space-y-6" data-track-changes data-tabs>
        @csrf
        @method('PUT')

        <div class="overflow-x-auto border-b border-gray-200" role="tablist" aria-label="About page sections">
            <div class="flex min-w-max gap-1">
                @foreach (['hero' => 'Hero', 'story' => 'Who We Are', 'direction' => 'Mission and vision', 'statistics' => 'Statistics'] as $tabId => $tabLabel)
                    <button type="button" role="tab" id="tab-{{ $tabId }}" aria-controls="panel-{{ $tabId }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-tab-target="{{ $tabId }}" class="min-h-11 border-b-2 px-3 text-sm font-medium {{ $loop->first ? 'border-indigo-600 text-indigo-700' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        {{ $tabLabel }}
                    </button>
                @endforeach
            </div>
        </div>

        <div id="panel-hero" role="tabpanel" aria-labelledby="tab-hero" data-tab-panel="hero" class="space-y-4 rounded-xl border bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold">Hero</h2>
            @include('admin.content.shared.field', ['name' => 'hero_title', 'label' => 'Title', 'value' => $settings['hero_title'], 'type' => 'text'])
            <div>
                <label for="hero_image" class="mb-1 block text-sm font-medium">Background image</label>
                <input id="hero_image" name="hero_image" type="file" accept="image/jpeg,image/png,image/webp" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                @if ($settings['hero_image'])<img src="{{ media_url($settings['hero_image']) }}" alt="" class="mt-3 h-24 w-full rounded-lg object-cover">@endif
            </div>
        </div>

        <div id="panel-story" role="tabpanel" aria-labelledby="tab-story" data-tab-panel="story" class="hidden space-y-4 rounded-xl border bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold">Who We Are</h2>
            @include('admin.content.shared.field', ['name' => 'who_title', 'label' => 'Title', 'value' => $settings['who_title'], 'type' => 'text'])
            <div><label for="who_body" class="mb-1 block text-sm font-medium">Content</label><textarea id="who_body" name="who_body" rows="6" class="w-full rounded-lg border border-gray-300 px-3 py-2">{{ old('who_body', $settings['who_body']) }}</textarea></div>
            <div><label for="who_image" class="mb-1 block text-sm font-medium">Image</label><input id="who_image" name="who_image" type="file" accept="image/jpeg,image/png,image/webp" class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">@if ($settings['who_image'])<img src="{{ media_url($settings['who_image']) }}" alt="" class="mt-3 h-24 w-40 rounded-lg object-cover">@endif</div>
        </div>

        <div id="panel-direction" role="tabpanel" aria-labelledby="tab-direction" data-tab-panel="direction" class="hidden grid gap-4 rounded-xl border bg-white p-5 shadow-sm sm:grid-cols-2">
            <h2 class="text-lg font-semibold sm:col-span-2">Mission and vision</h2>
            @include('admin.content.shared.field', ['name' => 'mission_title', 'label' => 'Mission title', 'value' => $settings['mission_title'], 'type' => 'text'])
            @include('admin.content.shared.field', ['name' => 'vision_title', 'label' => 'Vision title', 'value' => $settings['vision_title'], 'type' => 'text'])
            <div><label for="mission_body" class="mb-1 block text-sm font-medium">Mission content</label><textarea id="mission_body" name="mission_body" rows="5" class="w-full rounded-lg border border-gray-300 px-3 py-2">{{ old('mission_body', $settings['mission_body']) }}</textarea></div>
            <div><label for="vision_body" class="mb-1 block text-sm font-medium">Vision content</label><textarea id="vision_body" name="vision_body" rows="5" class="w-full rounded-lg border border-gray-300 px-3 py-2">{{ old('vision_body', $settings['vision_body']) }}</textarea></div>
        </div>

        <div id="panel-statistics" role="tabpanel" aria-labelledby="tab-statistics" data-tab-panel="statistics" class="hidden space-y-4 rounded-xl border bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold">Statistics</h2>
            @for ($index = 0; $index < 4; $index++)
                <div class="grid gap-4 sm:grid-cols-2">
                    <div><label for="stat_value_{{ $index }}" class="mb-1 block text-sm font-medium">Value {{ $index + 1 }}</label><input id="stat_value_{{ $index }}" name="stat_value[]" value="{{ old('stat_value.'.$index, $stats[$index]['value'] ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2"></div>
                    <div><label for="stat_label_{{ $index }}" class="mb-1 block text-sm font-medium">Label {{ $index + 1 }}</label><input id="stat_label_{{ $index }}" name="stat_label[]" value="{{ old('stat_label.'.$index, $stats[$index]['label'] ?? '') }}" class="w-full rounded-lg border border-gray-300 px-3 py-2"></div>
                </div>
            @endfor
        </div>

        <button type="submit" class="w-full rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700 sm:w-auto">Save About page</button>
    </form>
</section>
@endsection
