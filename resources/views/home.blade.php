@extends('layouts.app')
@section('title', 'Home - Jaguines Digital Solutions')

@section('content')
<section class="relative bg-cover bg-center bg-no-repeat min-h-[80vh] flex items-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1920&q=100');">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative text-center text-white px-4">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4">Welcome to Jaguines Digital Solutions</h1>
        <p class="text-base sm:text-xl mb-8">We build digital experiences that matter.</p>
        <a href="/contact" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">Get in Touch</a>

        <div class="mt-8" x-data="{ open: false }">
            {{-- <button @click="open = !open" class="bg-white text-gray-800 px-6 py-3 rounded-lg shadow flex items-center gap-2 mx-auto">
                Users
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button> --}}
            <div x-show="open" x-transition class="mt-2 bg-white rounded-lg shadow-lg text-left text-gray-800 w-64 mx-auto">
                {{-- @foreach($users as $user)
                <div class="px-4 py-3 border-b last:border-0">
                    <p class="font-medium">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <br>
                </div>
                @endforeach --}}
            </div>
        </div>
        <!-- @auth
            <div class="mt-8 bg-white text-gray-800 rounded-lg shadow-lg p-6 w-80 mx-auto">
                <p class="text-lg font-semibold mb-4">Welcome, {{ Auth::user()->username }}!</p>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">Logout</button>
                </form>
            </div>
        @else
            @include('partials.login-form')
        @endauth -->

    </div>
</section>
@endsection
