@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <nav class="mb-4">
        <a href="/">Home</a> / 
        <a href="/packages">Packages</a> / 
        <span>{{ $package->name }}</span>
    </nav>
    
    <h1 class="text-3xl font-bold mb-4">{{ $package->name }}</h1>
    
    <!-- Direct Link Button -->
    <a href="/booking-new/{{ $package->id }}" 
       class="inline-block bg-orange-500 text-white px-6 py-3 rounded-lg font-bold hover:bg-orange-600">
        Book Now
    </a>
    
    <p class="mt-4 text-gray-600">{{ $package->description }}</p>
    
    <!-- Center section -->
    <div class="text-center mt-12 p-8 bg-gray-50 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Ready for Adventure?</h2>
        <p class="mb-4">Book your {{ $package->name }} experience now!</p>
        
        <!-- Second Direct Link Button -->
        <a href="/booking-new/{{ $package->id }}" 
           class="inline-block bg-gradient-to-r from-green-500 to-blue-500 text-white px-8 py-3 rounded-lg font-bold text-lg hover:from-green-600 hover:to-blue-600">
            Book Now
        </a>
        
        <p class="mt-2 text-gray-600">Price: ₹{{ number_format($package->price) }}</p>
    </div>
</div>
@endsection
