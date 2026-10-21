@extends('layouts.app')
@section('title', $settings['hero_title'].' - Jaguines Digital Solutions')

@section('content')
<section class="relative flex min-h-[50vh] items-center justify-center bg-cover bg-center bg-no-repeat" style="background-image: url('{{ media_url($settings['hero_image']) ?? asset('images/logo.png') }}');">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative px-4 text-center text-white">
        <h1 class="text-3xl font-bold sm:text-5xl">{{ $settings['hero_title'] }}</h1>
    </div>
</section>

<section class="mx-auto grid max-w-7xl items-center gap-12 px-4 py-16 md:grid-cols-2">
    <div>
        @if ($settings['who_image'])
            <img src="{{ media_url($settings['who_image']) }}" class="w-full rounded-lg shadow-lg" alt="{{ $settings['who_title'] }}">
        @else
            <div class="flex h-64 items-center justify-center rounded-lg bg-gray-200 text-sm text-gray-500">No image available</div>
        @endif
    </div>
    <div>
        <h2 class="mb-4 text-3xl font-bold">{{ $settings['who_title'] }}</h2>
        @foreach (preg_split("/\r\n|\n|\r/", $settings['who_body']) as $paragraph)
            @if (trim($paragraph) !== '')<p class="mb-4 text-gray-600">{{ $paragraph }}</p>@endif
        @endforeach
    </div>
</section>

<section class="bg-gray-100 py-16">
    <div class="mx-auto grid max-w-7xl gap-12 px-4 md:grid-cols-2">
        <div class="rounded-lg bg-white p-8 shadow">
            <h3 class="mb-4 text-2xl font-bold text-indigo-600">{{ $settings['mission_title'] }}</h3>
            <p class="text-gray-600">{{ $settings['mission_body'] }}</p>
        </div>
        <div class="rounded-lg bg-white p-8 shadow">
            <h3 class="mb-4 text-2xl font-bold text-indigo-600">{{ $settings['vision_title'] }}</h3>
            <p class="text-gray-600">{{ $settings['vision_body'] }}</p>
        </div>
    </div>
</section>

@if (count($stats))
<section class="py-16">
    <div class="mx-auto grid max-w-7xl grid-cols-2 gap-8 px-4 text-center md:grid-cols-4">
        @foreach ($stats as $stat)
            <div><p class="text-4xl font-bold text-indigo-600">{{ $stat['value'] ?? '' }}</p><p class="mt-2 text-gray-600">{{ $stat['label'] ?? '' }}</p></div>
        @endforeach
    </div>
</section>
@endif

<section class="bg-gray-100 py-16">
    <div class="mx-auto max-w-7xl px-4">
        <h2 class="mb-12 text-center text-3xl font-bold">Meet Our Team</h2>
        @if ($teamMembers->isEmpty())
            <p class="rounded-lg bg-white p-8 text-center text-gray-500">Our team information is being updated.</p>
        @else
            <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-4">
                @foreach ($teamMembers as $member)
                    <article class="overflow-hidden rounded-lg bg-white text-center shadow">
                        @if ($member->photo_url)
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="h-56 w-full object-cover">
                        @else
                            <div class="flex h-56 items-center justify-center bg-gray-300" aria-hidden="true">
                                <svg class="h-20 w-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/></svg>
                            </div>
                        @endif
                        <div class="p-4"><h3 class="font-semibold">{{ $member->name }}</h3><p class="text-sm text-gray-500">{{ $member->role }}</p>@if($member->bio)<p class="mt-2 text-sm text-gray-600">{{ $member->bio }}</p>@endif</div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
