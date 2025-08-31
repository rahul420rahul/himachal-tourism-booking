@extends('layouts.app')

@section('title', 'About Us - MyBirBilling')

@section('content')
<!-- Hero Section -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                <span class="text-red-600">My</span><span class="text-orange-500">Bir</span><span class="text-green-600">Billing</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Your gateway to the skies in the heart of Himachal Pradesh
            </p>
        </div>
    </div>
</section>

<!-- Main Story Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Text Content -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Journey Started</h2>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        MyBirBilling was born from a simple dream - to share the incredible experience 
                        of paragliding in one of India's most beautiful destinations. Bir Billing, 
                        known as the "Paragliding Capital of India", offers perfect conditions for 
                        both beginners and experienced pilots.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">What We Offer</h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mt-1">
                                <span class="text-white text-sm font-bold">1</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Tandem Flights</h4>
                                <p class="text-gray-600">Experience the thrill with our certified pilots</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mt-1">
                                <span class="text-white text-sm font-bold">2</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Training Courses</h4>
                                <p class="text-gray-600">Learn to fly solo with professional instruction</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center mt-1">
                                <span class="text-white text-sm font-bold">3</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Adventure Packages</h4>
                                <p class="text-gray-600">Complete travel experiences with accommodation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats & Info Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-center mb-8 text-gray-900">Our Track Record</h3>
                
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-2">1000+</div>
                        <div class="text-sm text-gray-600">Safe Flights</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600 mb-2">5+</div>
                        <div class="text-sm text-gray-600">Years Experience</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-orange-600 mb-2">24/7</div>
                        <div class="text-sm text-gray-600">Support</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-red-600 mb-2">100%</div>
                        <div class="text-sm text-gray-600">Safety Record</div>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h4 class="font-bold text-gray-900 mb-4">Safety Certifications</h4>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">APPI Certified Instructors</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">International Safety Standards</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">Premium Equipment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Bir Billing?</h2>
            <p class="text-lg text-gray-600">Discover what makes this location perfect for paragliding</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-blue-50 rounded-lg p-6 text-center">
                <div class="w-12 h-12 bg-blue-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Perfect Weather</h3>
                <p class="text-gray-600">Ideal thermal conditions throughout the flying season</p>
            </div>

            <div class="bg-green-50 rounded-lg p-6 text-center">
                <div class="w-12 h-12 bg-green-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Stunning Views</h3>
                <p class="text-gray-600">Breathtaking Himalayan landscapes and valleys below</p>
            </div>

            <div class="bg-orange-50 rounded-lg p-6 text-center">
                <div class="w-12 h-12 bg-orange-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Safe Landing</h3>
                <p class="text-gray-600">Large, clear landing zones for comfortable touchdowns</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-purple-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ready for Your Adventure?</h2>
        <p class="text-xl text-blue-100 mb-8">Join us for an unforgettable paragliding experience</p>
        <div class="space-x-4">
            <a href="{{ route('packages.index') }}" 
               class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition-colors">
                View Packages
            </a>
            <a href="{{ route('contact') }}" 
               class="inline-block border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-600 transition-colors">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection