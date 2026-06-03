@extends('layouts.app')
@section('title', 'Services - Jaguines Digital Solutions')

@section('content')
{{-- Hero Banner --}}
<section class="relative bg-cover bg-center bg-no-repeat h-[50vh] flex items-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1504384764586-bb4cdc1707b0?auto=format&fit=crop&w=1920&q=80');">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative text-center text-white">
        <h1 class="text-3xl sm:text-5xl font-bold">Our Services</h1>
        <p class="mt-2 text-lg">Services</p>
    </div>
</section>

{{-- Intro --}}
<section class="max-w-7xl mx-auto px-4 py-16 text-center">
    <h2 class="text-3xl font-bold mb-4">What We Offer</h2>
    <p class="text-gray-600 max-w-2xl mx-auto">We provide end-to-end digital solutions tailored to your business needs. From concept to launch, our expert team ensures quality, performance, and results that exceed expectations.</p>
</section>

{{-- Services --}}
<section class="max-w-7xl mx-auto px-4 pb-16 space-y-16">
    {{-- Service 1 --}}
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" class="rounded-lg shadow-lg w-full" alt="Web Development">
        <div>
            <h3 class="text-2xl font-bold mb-3">Web Development</h3>
            <p class="text-gray-600 mb-4">We build fast, secure, and scalable websites using the latest technologies. Whether you need a landing page, corporate site, or a complex web application — we deliver pixel-perfect results on time.</p>
            <ul class="text-gray-600 space-y-2">
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> Custom Website Development</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> E-commerce Solutions</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> CMS & Admin Panels</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> API Integration & Development</li>
            </ul>
        </div>
    </div>

    {{-- Service 2 --}}
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="order-2 md:order-1">
            <h3 class="text-2xl font-bold mb-3">UI/UX Design</h3>
            <p class="text-gray-600 mb-4">Great design is more than aesthetics — it's about creating intuitive experiences that keep users engaged. We craft interfaces that are beautiful, functional, and conversion-focused.</p>
            <ul class="text-gray-600 space-y-2">
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> User Research & Wireframing</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> Responsive Design</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> Prototyping & Testing</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> Brand-Consistent Interfaces</li>
            </ul>
        </div>
        <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80" class="rounded-lg shadow-lg w-full order-1 md:order-2" alt="UI/UX Design">
    </div>

    {{-- Service 3 --}}
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <img src="https://images.unsplash.com/photo-1533750349088-cd871a92f312?auto=format&fit=crop&w=800&q=80" class="rounded-lg shadow-lg w-full" alt="Digital Marketing">
        <div>
            <h3 class="text-2xl font-bold mb-3">Digital Marketing</h3>
            <p class="text-gray-600 mb-4">Reach the right audience at the right time. Our data-driven marketing strategies help you grow your brand, increase traffic, and convert visitors into loyal customers.</p>
            <ul class="text-gray-600 space-y-2">
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> SEO & Content Strategy</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> Social Media Management</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> PPC & Ad Campaigns</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> Analytics & Reporting</li>
            </ul>
        </div>
    </div>

    {{-- Service 4 --}}
    <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="order-2 md:order-1">
            <h3 class="text-2xl font-bold mb-3">Mobile App Development</h3>
            <p class="text-gray-600 mb-4">We develop high-performance mobile applications for iOS and Android that deliver seamless user experiences and help your business stay connected with customers on the go.</p>
            <ul class="text-gray-600 space-y-2">
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> Native & Cross-Platform Apps</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> App Store Optimization</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> Push Notifications & Analytics</li>
                <li class="flex items-center"><span class="text-indigo-600 mr-2">✓</span> Ongoing Maintenance & Support</li>
            </ul>
        </div>
        <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80" class="rounded-lg shadow-lg w-full order-1 md:order-2" alt="Mobile App Development">
    </div>
</section>

{{-- Why Choose Us --}}
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-12">Why Choose Us</h2>
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <div class="text-4xl mb-3">🚀</div>
                <h4 class="font-semibold mb-2">Fast Delivery</h4>
                <p class="text-gray-600 text-sm">We deliver projects on time without compromising quality.</p>
            </div>
            <div>
                <div class="text-4xl mb-3">🛡️</div>
                <h4 class="font-semibold mb-2">Secure & Reliable</h4>
                <p class="text-gray-600 text-sm">Security-first approach in every solution we build.</p>
            </div>
            <div>
                <div class="text-4xl mb-3">💡</div>
                <h4 class="font-semibold mb-2">Innovative Solutions</h4>
                <p class="text-gray-600 text-sm">We use the latest technologies to keep you ahead.</p>
            </div>
            <div>
                <div class="text-4xl mb-3">🤝</div>
                <h4 class="font-semibold mb-2">24/7 Support</h4>
                <p class="text-gray-600 text-sm">Dedicated support team available whenever you need us.</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 text-center">
    <h2 class="text-3xl font-bold mb-4">Ready to Start Your Project?</h2>
    <p class="text-gray-600 mb-8">Let's work together to bring your ideas to life.</p>
    <a href="/contact" class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 text-lg">Get a Free Quote</a>
</section>
@endsection
