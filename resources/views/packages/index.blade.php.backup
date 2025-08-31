@extends('layouts.app')
@section('content')

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 py-32 text-white overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2"/></g></g></svg>');"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight" data-aos="fade-up">
            Adventure Awaits
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-500">
                In The Mountains
            </span>
        </h1>
        <p class="text-xl md:text-2xl opacity-90 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Discover breathtaking landscapes, thrilling adventures, and unforgettable experiences in the heart of Himachal Pradesh
        </p>
        <div class="mt-10" data-aos="fade-up" data-aos-delay="200">
            <a href="#packages" class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:from-orange-600 hover:to-red-700 transform hover:scale-105 transition-all duration-300 shadow-2xl">
                Explore Packages
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Filters Section -->
<section class="py-8 bg-white border-b border-gray-200 sticky top-0 z-40 backdrop-blur-sm bg-white/95">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-6">
            <div class="flex items-center space-x-6">
                <h3 class="text-lg font-bold text-gray-900">Filter Adventures:</h3>
                <select id="duration-filter" class="border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white shadow-sm">
                    <option value="">All Durations</option>
                    <option value="1-3">1-3 Days</option>
                    <option value="4-7">4-7 Days</option>
                    <option value="8+">8+ Days</option>
                </select>
                <select id="price-filter" class="border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white shadow-sm">
                    <option value="">All Prices</option>
                    <option value="0-5000">Under ₹5,000</option>
                    <option value="5000-15000">₹5,000 - ₹15,000</option>
                    <option value="15000+">Above ₹15,000</option>
                </select>
                <select id="type-filter" class="border-2 border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white shadow-sm">
                    <option value="">All Activities</option>
                    <option value="trekking">Trekking</option>
                    <option value="paragliding">Paragliding</option>
                    <option value="camping">Camping</option>
                    <option value="adventure">Adventure</option>
                </select>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600 font-medium">
                    Showing <span id="package-count" class="font-bold text-orange-600">{{ $packages->count() }}</span> adventures
                </span>
                <div class="flex space-x-2">
                    <button id="grid-view" class="p-2 rounded-lg bg-orange-100 text-orange-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </button>
                    <button id="list-view" class="p-2 rounded-lg text-gray-400 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Packages Grid -->
<section id="packages" class="py-20 bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Choose Your 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-red-600">Adventure</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                From thrilling treks to peaceful paragliding experiences, we've got something for every adventurer
            </p>
        </div>

        <div id="packages-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
            @forelse($packages as $index => $package)
                <div class="package-card" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 100 }}"
                     data-duration="{{ $package->duration ?? 2 }}"
                     data-price="{{ $package->price }}"
                     data-type="{{ strtolower($package->type ?? 'adventure') }}">
                     
                    {{-- Use the new Sky Trekkers style card component --}}
                    <x-package-card :package="$package" :index="$index" />
                </div>
            @empty
                <div class="col-span-3 text-center py-20">
                    <div class="relative">
                        <div class="text-gray-300 text-8xl mb-6">🏔️</div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-white rounded-full p-4 shadow-lg">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">No Adventures Found</h3>
                    <p class="text-gray-600 mb-8 text-lg">We're constantly adding new exciting packages. Check back soon or contact us for custom adventures!</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-600 text-white px-8 py-4 rounded-full font-bold hover:from-orange-600 hover:to-red-700 transform hover:scale-105 transition-all duration-300 shadow-xl">
                        Plan Custom Adventure
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            @endforelse
        </div>
        
        {{-- Load More Section --}}
        @if(method_exists($packages, 'hasPages') && $packages->hasPages())
            <div class="text-center mt-16">
                <div class="inline-flex items-center space-x-4 bg-white rounded-full px-8 py-4 shadow-lg">
                    {{ $packages->links() }}
                </div>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up">
            Ready for Your Next Adventure?
        </h2>
        <p class="text-xl opacity-90 mb-10" data-aos="fade-up" data-aos-delay="100">
            Join thousands of adventurers who have experienced the thrill of Himachal Pradesh with us
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('contact') }}" class="bg-gradient-to-r from-orange-500 to-red-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:from-orange-600 hover:to-red-700 transform hover:scale-105 transition-all duration-300 shadow-xl">
                Get Custom Quote
            </a>
            <a href="tel:+91-9876543210" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-gray-900 transform hover:scale-105 transition-all duration-300">
                Call Now: +91-9876543210
            </a>
        </div>
    </div>
</section>

<script>
// Enhanced Filter functionality
document.getElementById('duration-filter').addEventListener('change', filterPackages);
document.getElementById('price-filter').addEventListener('change', filterPackages);
document.getElementById('type-filter').addEventListener('change', filterPackages);

function filterPackages() {
    const durationFilter = document.getElementById('duration-filter').value;
    const priceFilter = document.getElementById('price-filter').value;
    const typeFilter = document.getElementById('type-filter').value;
    const packages = document.querySelectorAll('.package-card');
    let visibleCount = 0;
    
    packages.forEach(package => {
        const duration = parseInt(package.dataset.duration);
        const price = parseInt(package.dataset.price);
        const type = package.dataset.type;
        let show = true;
        
        // Duration filter
        if (durationFilter) {
            if (durationFilter === '1-3' && (duration < 1 || duration > 3)) show = false;
            if (durationFilter === '4-7' && (duration < 4 || duration > 7)) show = false;
            if (durationFilter === '8+' && duration < 8) show = false;
        }
        
        // Price filter
        if (priceFilter && show) {
            if (priceFilter === '0-5000' && price > 5000) show = false;
            if (priceFilter === '5000-15000' && (price < 5000 || price > 15000)) show = false;
            if (priceFilter === '15000+' && price < 15000) show = false;
        }
        
        // Type filter
        if (typeFilter && show) {
            if (!type.includes(typeFilter)) show = false;
        }
        
        // Smooth animation
        if (show) {
            package.style.display = 'block';
            setTimeout(() => {
                package.style.opacity = '1';
                package.style.transform = 'translateY(0)';
            }, 50);
            visibleCount++;
        } else {
            package.style.opacity = '0';
            package.style.transform = 'translateY(20px)';
            setTimeout(() => {
                package.style.display = 'none';
            }, 300);
        }
    });
    
    document.getElementById('package-count').textContent = visibleCount;
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading animation
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
});
</script>

<style>
/* Custom animations and styles */
.package-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.loaded .package-card {
    animation: slideInUp 0.6s ease-out forwards;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Background patterns */
.bg-pattern {
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #f97316, #dc2626);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, #ea580c, #b91c1c);
}
</style>

@endsection