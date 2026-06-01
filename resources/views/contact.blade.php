@extends('layouts.app')
@section('title', 'Contact - Jaguines Digital Solutions')

@section('content')
<section class="max-w-3xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold mb-8">Contact Us</h1>
    <form class="space-y-4">
        <div>
            <label class="block font-medium mb-1">Name</label>
            <input type="text" class="w-full border rounded-lg px-4 py-2" placeholder="Your name">
        </div>
        <div>
            <label class="block font-medium mb-1">Email</label>
            <input type="email" class="w-full border rounded-lg px-4 py-2" placeholder="Your email">
        </div>
        <div>
            <label class="block font-medium mb-1">Message</label>
            <textarea rows="5" class="w-full border rounded-lg px-4 py-2" placeholder="Your message"></textarea>
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">Send Message</button>
    </form>
</section>
@endsection
