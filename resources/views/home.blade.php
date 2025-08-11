@extends('layouts.app')
@section('content')

<!-- Hero Section -->
<section class="relative h-screen bg-gradient-to-br from-blue-600 to-purple-700 flex items-center justify-center text-white">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="relative z-10 text-center max-w-4xl mx-auto px-4" data-aos="fade-up">
        <h1 class="text-5xl md:text-7xl font-bold mb-6">
            Discover <span class="text-yellow-400">Himachal</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 opacity-90">
            Experience the breathtaking beauty of the Himalayas with our premium tour packages
        </p>
        <div class="space-x-4">
            <a href="{{ route('packages.index') }}" class="bg-yellow-500 text-gray-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-yellow-400 transition transform hover:scale-105">
                Explore Packages
            </a>
            <a href="#featured" class="border-2 border-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-gray-900 transition">
                Learn More
            </a>
        </div>
    </div>
</section>

<!-- Featured Packages Section -->
<section id="featured" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Packages</h2>
            <p class="text-xl text-gray-600">Handpicked destinations for your perfect getaway</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($packages as $package)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    @if($package->image)
                        <img src="{{ $package->image }}" alt="{{ $package->name }}" class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="text-white text-2xl font-bold">{{ substr($package->name, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $package->description }}</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm text-gray-500">{{ $package->duration }} Days</span>
                            <span class="text-2xl font-bold text-blue-600">₹{{ number_format($package->price) }}</span>
                        </div>
                        
                        <a href="{{ route('packages.show', $package) }}" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-center block">
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500 text-lg">No packages available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Weather Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Current Weather</h2>
            <p class="text-xl text-gray-600">Plan your trip with live weather updates</p>
        </div>
        
        <div id="weather-section" class="max-w-md mx-auto">
            <!-- Weather widget will be loaded here -->
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">What Our Travelers Say</h2>
            <p class="text-xl text-gray-600">Real experiences from real people</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $testimonial)
                <div class="bg-gray-50 rounded-2xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr($testimonial->customer_name, 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">{{ $testimonial->customer_name }}</h4>
                            <div class="flex text-yellow-500">
                                @for($i = 0; $i < $testimonial->rating; $i++)
                                    ⭐
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"{{ $testimonial->review }}"</p>
                </div>
            @empty
                <div class="col-span-3 text-center">
                    <p class="text-gray-500">No testimonials available yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<script>
// Load detailed weather widget
fetch('/weather/Billing')
    .then(response => response.json())
    .then(data => {
        if (!data.error) {
            document.getElementById('weather-section').innerHTML = `
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-8 text-white text-center shadow-2xl" data-aos="zoom-in">
                    <div class="mb-4">
                        <h3 class="text-2xl font-bold mb-2">${data.city}</h3>
                        <div class="text-5xl font-bold mb-2">${Math.round(data.temperature)}°C</div>
                        <p class="text-xl capitalize opacity-90">${data.description}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-6 pt-6 border-t border-white/20">
                        <div>
                            <div class="text-sm opacity-75">Humidity</div>
                            <div class="text-xl font-semibold">${data.humidity}%</div>
                        </div>
                        <div>
                            <div class="text-sm opacity-75">Wind Speed</div>
                            <div class="text-xl font-semibold">${data.wind_speed} m/s</div>
                        </div>
                    </div>
                </div>
            `;
        }
    })
    .catch(error => {
        document.getElementById('weather-section').innerHTML = `
            <div class="bg-gray-200 rounded-2xl p-8 text-center text-gray-500">
                <p>Weather information unavailable</p>
            </div>
        `;
    });
</script>

@endsection
