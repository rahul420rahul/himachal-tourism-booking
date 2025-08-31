@extends('layouts.app')
@section('content')

<section class="relative bg-gray-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-slate-900 to-black"></div>
    <div class="absolute top-0 left-0 w-full h-full opacity-5" style="background-image: radial-gradient(#60a5fa 1px, transparent 1px), radial-gradient(#eab308 1px, transparent 1px); background-size: 40px 40px; background-position: 0 0, 20px 20px;"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-24 sm:py-32 text-center">
        <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight mb-6">
            Adventure Awaits
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-orange-400 mt-2">
                In The Sky
            </span>
        </h1>
        <p class="text-lg md:text-xl text-gray-400 max-w-3xl mx-auto mb-10">
            Professional Paragliding Courses & Tandem Flights in Bir Billing, Himachal Pradesh
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#packages" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-orange-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 hover:scale-105 transform">
                Explore Packages
                <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
            <a href="tel:+919736696260" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-gray-300 transition-all duration-200 bg-gray-800/50 border-2 border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                Call Now
            </a>
        </div>
    </div>
</section>

<section class="sticky top-0 z-40 bg-gray-900/80 backdrop-blur-sm border-b border-gray-700">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4">
        <div class="md:hidden">
            <button onclick="toggleFilters()" class="w-full bg-gray-800 text-white px-4 py-3 rounded-lg flex items-center justify-between hover:bg-gray-700 transition-colors">
                <span class="font-semibold">Filter Packages</span>
                <svg class="w-5 h-5 transition-transform" id="filter-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>
        
        <div id="filterSection" class="hidden md:block mt-4 md:mt-0">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="relative">
                        <select id="duration-filter" class="w-full bg-gray-800 text-white border border-gray-700 rounded-lg px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 appearance-none">
                            <option value="">All Durations</option>
                            <option value="1">1 Day</option>
                            <option value="2-7">2-7 Days</option>
                            <option value="8-15">8-15 Days</option>
                            <option value="15+">15+ Days</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    <div class="relative">
                        <select id="price-filter" class="w-full bg-gray-800 text-white border border-gray-700 rounded-lg px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 appearance-none">
                            <option value="">All Prices</option>
                            <option value="0-5000">Under ₹5,000</option>
                            <option value="5000-15000">₹5,000 - ₹15,000</option>
                            <option value="15000-30000">₹15,000 - ₹30,000</option>
                            <option value="30000+">Above ₹30,000</option>
                        </select>
                         <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    <div class="relative">
                        <select id="type-filter" class="w-full bg-gray-800 text-white border border-gray-700 rounded-lg px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 appearance-none">
                            <option value="">All Types</option>
                            <option value="tandem">Tandem Flight</option>
                            <option value="p1">P1 Basic</option>
                            <option value="p2">P2 Novice</option>
                            <option value="p3">P3 Intermediate</option>
                            <option value="p4">P4 Advanced</option>
                        </select>
                         <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between lg:justify-end gap-4 mt-4 lg:mt-0">
                    <div class="bg-sky-500/20 text-sky-300 px-4 py-2 rounded-lg text-sm">
                        <span id="package-count" class="font-bold">{{ $packages->count() }}</span> packages found
                    </div>
                    <div class="flex gap-1 bg-gray-800 p-1 rounded-lg">
                        <button onclick="setView('grid')" id="grid-view" class="p-2 rounded-md bg-orange-500 text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </button>
                        <button onclick="setView('list')" id="list-view" class="p-2 rounded-md text-gray-400 hover:bg-gray-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="packages" class="py-16 sm:py-24 bg-gray-900">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                Our <span class="text-orange-400">Packages</span>
            </h2>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                Choose from our range of paragliding experiences, from short tandem flights to advanced pilot courses.
            </p>
        </div>
        
        <div id="packages-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($packages as $index => $package)
                <div class="package-card group relative" 
                     data-duration="{{ $package->duration ?? '1 Day' }}"
                     data-price="{{ $package->price }}"
                     data-type="{{ strtolower($package->name) }}">
                     <div class="absolute -inset-px bg-gradient-to-r from-sky-500 to-orange-500 rounded-xl blur-md opacity-0 group-hover:opacity-70 transition duration-500"></div>
                     <div class="relative h-full bg-gray-800 rounded-xl p-px">
                        <x-package-card :package="$package" :index="$index" />
                     </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-gray-800/50 rounded-lg">
                    <div class="text-6xl mb-6">🪂</div>
                    <h3 class="text-3xl font-bold text-white mb-4">No Packages Found</h3>
                    <p class="text-gray-400 mb-8 text-lg">Your filter selection did not match any packages. Try adjusting your filters.</p>
                    <a href="{{ route('contact') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-lg font-semibold transition-colors">
                        Contact Us For Custom Packages
                    </a>
                </div>
            @endforelse
        </div>
        
        @if(method_exists($packages, 'hasPages') && $packages->hasPages())
            <div class="text-center mt-16">
                {{ $packages->links() }}
            </div>
        @endif
    </div>
</section>

<section class="py-16 sm:py-24 bg-gray-900">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center bg-gradient-to-br from-sky-500/10 via-transparent to-orange-500/10 py-16 rounded-2xl border border-gray-800">
        <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6">Ready to Take Flight?</h2>
        <p class="text-xl text-gray-400 mb-10">Book your paragliding adventure today and experience the thrill of a lifetime.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('booking.react') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white transition-all duration-200 bg-orange-500 rounded-lg focus:outline-none hover:scale-105 transform">
                Book Your Adventure Now
            </a>
            <a href="https://wa.me/919736696260" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-gray-300 transition-all duration-200 bg-gray-800/50 border-2 border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white">
                Message on WhatsApp
            </a>
        </div>
    </div>
</section>

<script>
// All your existing Javascript remains the same.
// It targets elements by ID, and I have not changed any IDs.
function toggleFilters() {
    const filterSection = document.getElementById('filterSection');
    const arrow = document.getElementById('filter-arrow');
    filterSection.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}

function setView(view) {
    const grid = document.getElementById('packages-grid');
    const gridBtn = document.getElementById('grid-view');
    const listBtn = document.getElementById('list-view');
    
    grid.classList.remove('grid-cols-1', 'md:grid-cols-2', 'lg:grid-cols-3');

    if (view === 'list') {
        grid.classList.add('grid-cols-1');
        listBtn.classList.add('bg-orange-500', 'text-white');
        listBtn.classList.remove('text-gray-400', 'hover:bg-gray-700');
        gridBtn.classList.remove('bg-orange-500', 'text-white');
        gridBtn.classList.add('text-gray-400', 'hover:bg-gray-700');
    } else {
        grid.classList.add('grid-cols-1', 'md:grid-cols-2', 'lg:grid-cols-3');
        gridBtn.classList.add('bg-orange-500', 'text-white');
        gridBtn.classList.remove('text-gray-400', 'hover:bg-gray-700');
        listBtn.classList.remove('bg-orange-500', 'text-white');
        listBtn.classList.add('text-gray-400', 'hover:bg-gray-700');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const durationFilterEl = document.getElementById('duration-filter');
    const priceFilterEl = document.getElementById('price-filter');
    const typeFilterEl = document.getElementById('type-filter');

    if(durationFilterEl) durationFilterEl.addEventListener('change', filterPackages);
    if(priceFilterEl) priceFilterEl.addEventListener('change', filterPackages);
    if(typeFilterEl) typeFilterEl.addEventListener('change', filterPackages);
});

function filterPackages() {
    const durationFilter = document.getElementById('duration-filter').value;
    const priceFilter = document.getElementById('price-filter').value;
    const typeFilter = document.getElementById('type-filter').value;
    const packages = document.querySelectorAll('.package-card');
    let visibleCount = 0;
    
    packages.forEach(package => {
        const price = parseInt(package.dataset.price);
        const type = package.dataset.type.toLowerCase();
        
        const durationText = package.dataset.duration || "";
        const durationValue = parseInt(durationText.split(" ")[0]);

        let show = true;
        
        if (durationFilter && show) {
            if (durationFilter === '1' && durationValue !== 1) show = false;
            if (durationFilter === '2-7' && (durationValue < 2 || durationValue > 7)) show = false;
            if (durationFilter === '8-15' && (durationValue < 8 || durationValue > 15)) show = false;
            if (durationFilter === '15+' && durationValue < 16) show = false;
        }
        
        if (priceFilter && show) {
            if (priceFilter === '0-5000' && price > 5000) show = false;
            if (priceFilter === '5000-15000' && (price < 5000 || price > 15000)) show = false;
            if (priceFilter === '15000-30000' && (price < 15000 || price > 30000)) show = false;
            if (priceFilter === '30000+' && price < 30000) show = false;
        }
        
        if (typeFilter && show) {
            if (!type.includes(typeFilter)) show = false;
        }
        
        package.style.display = show ? 'block' : 'none';
        if (show) visibleCount++;
    });
    
    document.getElementById('package-count').textContent = visibleCount;
}

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
</script>

@endsection