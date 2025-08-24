@extends('layouts.app')

@section('hero')
<!-- Hero Section Component - Full Width -->
<x-hero-section />
@endsection

@section('content')
<!-- Featured Packages Section -->
<section id="featured" class="py-20 bg-white">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Packages</h2>
            <p class="text-xl text-gray-600">Handpicked destinations for your perfect getaway</p>
        </div>

        <!-- Packages Grid using Component -->
        @if($packages && $packages->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                @foreach($packages as $index => $package)       
                    <x-package-card :package="$package" :index="$index" />
                @endforeach
            </div>
            
            <!-- View All Button -->
            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{ route('packages.index') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <span>View All Packages</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        @else
            <!-- No Packages Available -->
            <div class="text-center py-16" data-aos="fade-up">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Packages Available</h3>
                <p class="text-gray-600 mb-6">We're working on exciting new packages for you. Check back soon!</p>
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Contact Us for Custom Packages
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Weather Section -->
<x-weather-widget city="Billing" />
<!-- Testimonials Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">What Our Travelers Say</h2>
            <p class="text-xl text-gray-600">Real experiences from real people</p>
        </div>
        
        <x-testimonial-slider :testimonials="$testimonials" />
    </div>
</section>

@endsection