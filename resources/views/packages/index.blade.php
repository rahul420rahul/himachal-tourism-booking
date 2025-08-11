@extends('layouts.app')
@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 py-20 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6" data-aos="fade-up">
            Our Tour Packages
        </h1>
        <p class="text-xl md:text-2xl opacity-90 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            Discover the most beautiful destinations in Himachal Pradesh with our carefully crafted tour packages
        </p>
    </div>
</section>

<!-- Filters Section -->
<section class="py-8 bg-white shadow-sm sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center space-x-4">
                <label class="text-gray-700 font-semibold">Filter by:</label>
                <select id="duration-filter" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">All Durations</option>
                    <option value="1-3">1-3 Days</option>
                    <option value="4-7">4-7 Days</option>
                    <option value="8+">8+ Days</option>
                </select>
                <select id="price-filter" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">All Prices</option>
                    <option value="0-10000">Under ₹10,000</option>
                    <option value="10000-25000">₹10,000 - ₹25,000</option>
                    <option value="25000+">Above ₹25,000</option>
                </select>
            </div>
            <div class="text-gray-600">
                Showing <span id="package-count">{{ $packages->count() }}</span> packages
            </div>
        </div>
    </div>
</section>

<!-- Packages Grid -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="packages-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($packages as $package)
                <div class="package-card bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $loop->index * 100 }}"
                     data-duration="{{ $package->duration }}"
                     data-price="{{ $package->price }}">
                     
                    <!-- Package Image -->
                    <div class="relative overflow-hidden">
                        @if($package->image)
                            <img src="{{ $package->image }}" alt="{{ $package->name }}" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <span class="text-white text-4xl font-bold">{{ substr($package->name, 0, 1) }}</span>
                            </div>
                        @endif
                        
                        <!-- Featured Badge -->
                        @if($package->featured)
                            <div class="absolute top-4 left-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                ⭐ Featured
                            </div>
                        @endif
                        
                        <!-- Price Badge -->
                        <div class="absolute top-4 right-4 bg-black/70 text-white px-3 py-2 rounded-lg">
                            <span class="text-sm">Starting from</span>
                            <div class="text-xl font-bold">₹{{ number_format($package->price) }}</div>
                        </div>
                    </div>
                    
                    <!-- Package Content -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-900">{{ $package->name }}</h3>
                            <div class="flex items-center text-yellow-500">
                                @for($i = 0; $i < 5; $i++)
                                    ⭐
                                @endfor
                                <span class="ml-1 text-gray-600 text-sm">(4.8)</span>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $package->description }}</p>
                        
                        <!-- Package Details -->
                        <div class="flex items-center justify-between mb-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2L3 7v11a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V7l-7-5z"/>
                                </svg>
                                {{ $package->duration }} Days
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                All Inclusive
                            </div>
                        </div>
                        
                        <!-- Key Features -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-900 mb-2">Highlights:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach(json_decode($package->inclusions ?? '[]') as $inclusion)
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $inclusion }}</span>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <a href="{{ route('packages.show', $package) }}" class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-center">
                                View Details
                            </a>
                            @auth
                                <button onclick="quickBook({{ $package->id }})" class="flex-1 bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                                    Quick Book
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="flex-1 bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition text-center">
                                    Login to Book
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-20">
                    <div class="text-gray-400 text-6xl mb-4">📦</div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-2">No Packages Found</h3>
                    <p class="text-gray-600">We're working on adding amazing packages for you!</p>
                </div>
            @endforelse
        </div>
        
        <!-- Load More Button -->
        @if($packages->hasPages())
            <div class="text-center mt-12">
                {{ $packages->links() }}
            </div>
        @endif
    </div>
</section>

<!-- Quick Book Modal -->
<div id="quickBookModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold">Quick Booking</h3>
            <button onclick="closeQuickBook()" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form id="quickBookForm">
            @csrf
            <input type="hidden" id="quick-package-id" name="package_id">
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Travel Date</label>
                <input type="date" name="travel_date" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Adults</label>
                    <input type="number" name="adults" min="1" value="2" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Children</label>
                    <input type="number" name="children" min="0" value="0" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                Proceed to Book
            </button>
        </form>
    </div>
</div>

<script>
// Filter functionality
document.getElementById('duration-filter').addEventListener('change', filterPackages);
document.getElementById('price-filter').addEventListener('change', filterPackages);

function filterPackages() {
    const durationFilter = document.getElementById('duration-filter').value;
    const priceFilter = document.getElementById('price-filter').value;
    const packages = document.querySelectorAll('.package-card');
    let visibleCount = 0;
    
    packages.forEach(package => {
        const duration = parseInt(package.dataset.duration);
        const price = parseInt(package.dataset.price);
        let show = true;
        
        // Duration filter
        if (durationFilter) {
            if (durationFilter === '1-3' && (duration < 1 || duration > 3)) show = false;
            if (durationFilter === '4-7' && (duration < 4 || duration > 7)) show = false;
            if (durationFilter === '8+' && duration < 8) show = false;
        }
        
        // Price filter
        if (priceFilter && show) {
            if (priceFilter === '0-10000' && price > 10000) show = false;
            if (priceFilter === '10000-25000' && (price < 10000 || price > 25000)) show = false;
            if (priceFilter === '25000+' && price < 25000) show = false;
        }
        
        package.style.display = show ? 'block' : 'none';
        if (show) visibleCount++;
    });
    
    document.getElementById('package-count').textContent = visibleCount;
}

// Quick book functionality
function quickBook(packageId) {
    document.getElementById('quick-package-id').value = packageId;
    document.getElementById('quickBookModal').classList.remove('hidden');
}

function closeQuickBook() {
    document.getElementById('quickBookModal').classList.add('hidden');
}

// Handle quick book form submission
document.getElementById('quickBookForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('{{ route("bookings.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = `/bookings/${data.booking_id}`;
        } else {
            alert('Booking failed. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
    });
});
</script>

@endsection
