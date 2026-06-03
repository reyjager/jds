@extends('layouts.app')
@section('title', 'Portfolio - Jaguines Digital Solutions')

@section('content')
{{-- Hero Banner --}}
<section class="relative bg-cover bg-center bg-no-repeat h-[50vh] flex items-center justify-center" style="background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1920&q=80');">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative text-center text-white">
        <h1 class="text-3xl sm:text-5xl font-bold">Our Portfolio</h1>
        <p class="mt-2 text-lg">Portfolio</p>
    </div>
</section>

{{-- Filter Buttons --}}
<section class="max-w-7xl mx-auto px-4 pt-16 pb-8 text-center">
    <div class="flex flex-wrap justify-center gap-2">
        <button class="filter-btn px-4 py-2 rounded-lg bg-indigo-600 text-white" data-filter="all">All</button>
        <button class="filter-btn px-4 py-2 rounded-lg bg-gray-200 hover:bg-indigo-600 hover:text-white" data-filter="web">Web Design</button>
        <button class="filter-btn px-4 py-2 rounded-lg bg-gray-200 hover:bg-indigo-600 hover:text-white" data-filter="app">App Development</button>
        <button class="filter-btn px-4 py-2 rounded-lg bg-gray-200 hover:bg-indigo-600 hover:text-white" data-filter="branding">Branding</button>
    </div>
</section>

{{-- Portfolio Grid --}}
<section class="max-w-7xl mx-auto px-4 pb-16">
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6" id="portfolio-grid">
        <div class="portfolio-item group relative overflow-hidden rounded-lg shadow cursor-pointer" data-category="web" onclick="openLightbox(this)">
            <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110" alt="Project">
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center flex-col">
                <h3 class="text-white text-xl font-semibold">E-commerce Website</h3>
                <p class="text-gray-300 text-sm">Web Design</p>
            </div>
        </div>

        <div class="portfolio-item group relative overflow-hidden rounded-lg shadow cursor-pointer" data-category="app" onclick="openLightbox(this)">
            <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110" alt="Project">
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center flex-col">
                <h3 class="text-white text-xl font-semibold">Fitness App</h3>
                <p class="text-gray-300 text-sm">App Development</p>
            </div>
        </div>

        <div class="portfolio-item group relative overflow-hidden rounded-lg shadow cursor-pointer" data-category="branding" onclick="openLightbox(this)">
            <img src="https://images.unsplash.com/photo-1626785774573-4b799315345d?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110" alt="Project">
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center flex-col">
                <h3 class="text-white text-xl font-semibold">Brand Identity</h3>
                <p class="text-gray-300 text-sm">Branding</p>
            </div>
        </div>

        <div class="portfolio-item group relative overflow-hidden rounded-lg shadow cursor-pointer" data-category="web" onclick="openLightbox(this)">
            <img src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110" alt="Project">
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center flex-col">
                <h3 class="text-white text-xl font-semibold">Corporate Website</h3>
                <p class="text-gray-300 text-sm">Web Design</p>
            </div>
        </div>

        <div class="portfolio-item group relative overflow-hidden rounded-lg shadow cursor-pointer" data-category="app" onclick="openLightbox(this)">
            <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110" alt="Project">
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center flex-col">
                <h3 class="text-white text-xl font-semibold">Food Delivery App</h3>
                <p class="text-gray-300 text-sm">App Development</p>
            </div>
        </div>

        <div class="portfolio-item group relative overflow-hidden rounded-lg shadow cursor-pointer" data-category="branding" onclick="openLightbox(this)">
            <img src="https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?auto=format&fit=crop&w=600&q=80" class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-110" alt="Project">
            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center flex-col">
                <h3 class="text-white text-xl font-semibold">Logo Design</h3>
                <p class="text-gray-300 text-sm">Branding</p>
            </div>
        </div>
    </div>
</section>

{{-- Lightbox Modal --}}
<div id="lightbox" class="fixed inset-0 bg-black/80 z-50 hidden items-center justify-center" onclick="closeLightbox()">
    <button class="absolute top-4 right-6 text-white text-4xl">&times;</button>
    <img id="lightbox-img" src="" class="max-w-4xl max-h-[80vh] rounded-lg shadow-lg" alt="Portfolio">
</div>

<script>
    // Filter
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-indigo-600', 'text-white');
                b.classList.add('bg-gray-200');
            });
            btn.classList.add('bg-indigo-600', 'text-white');
            btn.classList.remove('bg-gray-200');

            const filter = btn.dataset.filter;
            document.querySelectorAll('.portfolio-item').forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Lightbox
    function openLightbox(el) {
        const img = el.querySelector('img');
        document.getElementById('lightbox-img').src = img.src;
        document.getElementById('lightbox').classList.remove('hidden');
        document.getElementById('lightbox').classList.add('flex');
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
        document.getElementById('lightbox').classList.remove('flex');
    }
</script>
@endsection
