@extends('layouts.app')
@section('title', 'About Us - Jaguines Digital Solutions')

@section('content')
{{-- Hero Banner --}}
<section class="relative bg-cover bg-center bg-no-repeat h-[50vh] flex items-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80');">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative text-center text-white">
        {{-- <img src="/images/logo.png" alt="Jaguines Digital Solutions" class="h-24 mx-auto mb-4 mix-blend-screen"> --}}
        <h1 class="text-3xl sm:text-5xl font-bold">About Us</h1>
        <p class="mt-2 text-lg">About Us</p>
    </div>
</section>

{{-- Who We Are --}}
<section class="max-w-7xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-12 items-center">
    <div>
        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=800&q=80" class="rounded-lg shadow-lg w-full" alt="About us">
    </div>
    <div>
        <h2 class="text-3xl font-bold mb-4">Who We Are</h2>
        <p class="text-gray-600 mb-4">We are a team of creative professionals dedicated to delivering innovative digital solutions. With years of experience in web development, design, and marketing, we help businesses achieve their goals through technology.</p>
        <p class="text-gray-600">Our approach combines creativity with technical expertise to build solutions that not only look great but also perform exceptionally well.</p>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12">
        <div class="bg-white p-8 rounded-lg shadow">
            <h3 class="text-2xl font-bold mb-4 text-indigo-600">Our Mission</h3>
            <p class="text-gray-600">To empower businesses with cutting-edge digital solutions that drive growth, enhance user experiences, and create lasting impact in the digital landscape.</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow">
            <h3 class="text-2xl font-bold mb-4 text-indigo-600">Our Vision</h3>
            <p class="text-gray-600">To be a globally recognized digital agency known for innovation, quality, and delivering transformative results for our clients across all industries.</p>
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div>
            <p class="text-4xl font-bold text-indigo-600">150+</p>
            <p class="text-gray-600 mt-2">Projects Completed</p>
        </div>
        <div>
            <p class="text-4xl font-bold text-indigo-600">50+</p>
            <p class="text-gray-600 mt-2">Happy Clients</p>
        </div>
        <div>
            <p class="text-4xl font-bold text-indigo-600">10+</p>
            <p class="text-gray-600 mt-2">Years Experience</p>
        </div>
        <div>
            <p class="text-4xl font-bold text-indigo-600">20+</p>
            <p class="text-gray-600 mt-2">Team Members</p>
        </div>
    </div>
</section>

{{-- Team --}}
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Meet Our Team</h2>
        <div class="grid md:grid-cols-4 gap-8">
            <div class="bg-white rounded-lg shadow overflow-hidden text-center">
                <div class="w-full h-56 bg-gray-300 flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/></svg>
                </div>
                <div class="p-4">
                    <h4 class="font-semibold">Rey Jaguines</h4>
                    <p class="text-gray-500 text-sm">CEO & Founder</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow overflow-hidden text-center">
                <div class="w-full h-56 bg-gray-300 flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/></svg>
                </div>
                <div class="p-4">
                    <h4 class="font-semibold">John Mark Solomon Jaguines</h4>
                    <p class="text-gray-500 text-sm">Lead Designer</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow overflow-hidden text-center">
                <div class="w-full h-56 bg-gray-300 flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/></svg>
                </div>
                <div class="p-4">
                    <h4 class="font-semibold">Mike J</h4>
                    <p class="text-gray-500 text-sm">Senior Developer</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow overflow-hidden text-center">
                <div class="w-full h-56 bg-gray-300 flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/></svg>
                </div>
                <div class="p-4">
                    <h4 class="font-semibold">Sarah Ws</h4>
                    <p class="text-gray-500 text-sm">Marketing Head</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
