@extends('layouts.app')

@section('hero')
<!-- Hero Section Component - Full Width -->
<x-hero-section />
@endsection

@section('content')
<!-- Travel Packages Section -->
<section id="featured" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-5xl font-bold mb-6">
                <span class="text-orange-500">TRAVEL PACKAGES</span> 
                <span class="text-gray-800">FOR ALL ADVENTURES</span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                If you want to explore the beauty of nature and create unforgettable memories, 
                our carefully crafted travel packages are designed just for you
            </p>
        </div>

        <!-- Packages Grid using Component -->
        @if($packages && $packages->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            @foreach($packages as $index => $package)
            <x-package-card :package="$package" :index="$index" />
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="text-center mt-16" data-aos="fade-up">
            <a href="{{ route('packages.index') }}"
               class="inline-flex items-center px-10 py-4 bg-orange-500 text-white font-bold text-lg rounded-lg hover:bg-orange-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                <span>Explore All Packages</span>
                <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
        @else
        <!-- No Packages Available -->
        <div class="text-center py-20" data-aos="fade-up">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-100 rounded-full mb-6">
                <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">New Adventures Coming Soon</h3>
            <p class="text-gray-600 mb-8 text-lg max-w-md mx-auto">
                We're preparing amazing travel experiences that will take your breath away. 
                Stay tuned for incredible journeys!
            </p>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center px-8 py-4 bg-teal-600 text-white font-semibold rounded-lg hover:bg-teal-700 transition-colors shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                Contact for Custom Packages
            </a>
        </div>
        @endif
    </div>
</section>

<!-- About Us Section -->
@include('partials.about-us-section')

<!-- Customer Stories Section -->
<!-- Clean Customer Stories Section -->
<section class="py-16 bg-gradient-to-r from-gray-50 to-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Simple Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                SEE WHAT OUR <span class="text-orange-500">EXPLORERS</span> SAYS
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Real adventures, real memories, real people. Experience the thrill through their eyes.
            </p>
        </div>
        
        <!-- Compact Testimonials -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <x-testimonial-slider :testimonials="$testimonials" />
        </div>
    </div>
</section>
@endsection