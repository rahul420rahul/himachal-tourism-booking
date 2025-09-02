@extends('layouts.app')

@section('content')

<div class="bg-white text-slate-800 antialiased">

    <header>
        <div class="w-full">
            {{-- Main section with increased height --}}
            <section class="grid lg:grid-cols-3">
                
                {{-- Left side: 4 Different Videos Grid --}}
                <div class="lg:col-span-2 relative w-full h-[400px] sm:h-[500px] lg:h-[600px] overflow-hidden bg-black">
                    {{-- 2x2 Grid with 4 Different Videos --}}
                    <div class="grid grid-cols-2 grid-rows-2 h-full">
                        {{-- Top Left - First Video --}}
                        <div class="relative overflow-hidden group bg-black">
                            <video class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                   autoplay 
                                   loop 
                                   muted 
                                   playsinline>
                                <source src="{{ asset('storage/p1hero.mp4') }}" type="video/mp4">
                                <source src="{{ asset('storage/p1p2hero.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        {{-- Top Right - Second Video --}}
                        <div class="relative overflow-hidden group bg-black">
                            <video class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                   autoplay 
                                   loop 
                                   muted 
                                   playsinline>
                                <source src="{{ asset('storage/p2hero.mp4') }}" type="video/mp4">
                                <source src="{{ asset('storage/hero-mobile.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        {{-- Bottom Left - Third Video --}}
                        <div class="relative overflow-hidden group bg-black">
                            <video class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                   autoplay 
                                   loop 
                                   muted 
                                   playsinline>
                                <source src="{{ asset('storage/p3hero.mp4') }}" type="video/mp4">
                                <source src="{{ asset('storage/hero-final.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        {{-- Bottom Right - Fourth Video --}}
                        <div class="relative overflow-hidden group bg-black">
                            <video class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                   autoplay 
                                   loop 
                                   muted 
                                   playsinline>
                                <source src="{{ asset('storage/p4hero.mp4') }}" type="video/mp4">
                                <source src="{{ asset('storage/p4hero1.mp4') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                </div>
    
                {{-- Right side: Content with dark background --}}
                <div class="lg:col-span-1 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 flex flex-col justify-center p-8 sm:p-10 lg:p-12 h-[400px] sm:h-[500px] lg:h-[600px]">
                    
                    <span class="font-semibold text-amber-400 tracking-widest uppercase mb-3 text-sm animate-pulse">Professional Certification</span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold leading-tight text-white drop-shadow-lg mb-2">
                        P1-P2 Basic Course
                    </h1>
                    
                    <div class="my-6 lg:my-8">
                        <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-emerald-400 drop-shadow-md">
                            ₹{{ number_format($package->price) }}
                        </div>
                        <div class="text-lg lg:text-xl text-slate-300 mt-3">
                            8-Day Intensive Program
                            <span class="block text-slate-400 font-light mt-1">Become a Certified Solo Pilot</span>
                        </div>
                    </div>
    
                    <div class="flex flex-col sm:flex-row gap-4 mt-6">
                        <a href="/booking-new/{{ $package->id }}"
                           class="flex-1 text-center bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-4 rounded-xl font-bold text-lg hover:from-red-700 hover:to-red-800 transition-all transform hover:scale-105 shadow-2xl hover:shadow-red-500/25">
                            Book Now
                        </a>
                        
                        <a href="https://wa.me/910000000000"
                           target="_blank"
                           class="flex-1 text-center bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4 rounded-xl font-bold text-lg hover:from-green-600 hover:to-green-700 transition-all flex items-center justify-center gap-2 shadow-2xl hover:shadow-green-500/25">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 12c0 1.75.45 3.49 1.32 5l-1.4 5.09 5.23-1.37c1.44.81 3.08 1.24 4.76 1.24h.01c5.46 0 9.91-4.45 9.91-9.91s-4.45-9.9-9.91-9.9zm4.33 11.94c-.19.53-.94 1-1.33 1.05-.33.04-.84.05-1.28-.12-1.33-.52-2.2-1.16-3.08-2.03-.6-1.55.1-1.46.36-1.9.08-.13.12-.22.2-.36.1-.15.05-.28 0-.43-.05-.15-.49-.78-.67-1.04-.18-.27-.36-.31-.5-.31h-.31c-.15 0-.38.05-.56.27-.18.22-.68.67-.86 1.33s-.36 1.38-.05 2.18c.31.8 1.05 1.86 2.25 3.05 1.6 1.6 2.94 2.13 4.25 2.13.43 0 1.2-.18 1.58-.9.38-.72.38-1.33.27-1.48-.12-.15-.45-.23-.63-.41z"/></svg>
                            WhatsApp
                        </a>
                    </div>
    
                </div>
            </section>
        </div>
    </header>

   
    <main id="course-details" class="py-20 sm:py-28">

        <section class="container mx-auto px-6 max-w-6xl mb-20 sm:mb-28">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-slate-800">Your Journey to the <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-600 to-emerald-600">Sky Begins Here</span></h2>
                <p class="text-lg text-slate-600 max-w-3xl mx-auto">Join India's most comprehensive paragliding certification at Bir Billing—Asia's paragliding capital.</p>
            </div>
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="{{ asset('storage/p1.jpg') }}" alt="Paraglider taking off" class="rounded-2xl shadow-2xl hover:shadow-3xl transition-shadow duration-300">
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 hover:shadow-2xl transition-shadow duration-300">
                    <h3 class="text-3xl font-bold mb-8 text-slate-800">What You'll Achieve</h3>
                    <div class="space-y-4">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-5 rounded-xl flex items-center justify-between hover:scale-[1.02] transition-transform">
                            <span class="text-lg font-semibold text-slate-700">Ground Handling Mastery</span>
                            <span class="bg-emerald-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">P1</span>
                        </div>
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-5 rounded-xl flex items-center justify-between hover:scale-[1.02] transition-transform">
                            <span class="text-lg font-semibold text-slate-700">Minimum 5 Solo Flights</span>
                            <span class="bg-sky-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">P2</span>
                        </div>
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-5 rounded-xl flex items-center justify-between hover:scale-[1.02] transition-transform">
                            <span class="text-lg font-semibold text-slate-700">Radio-Supervised Flying</span>
                            <span class="bg-indigo-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">P2</span>
                        </div>
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-5 rounded-xl flex items-center justify-between hover:scale-[1.02] transition-transform">
                            <span class="text-lg font-semibold text-slate-700">International Certification</span>
                            <span class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">BPA</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Full Width Gallery Section with Better Layout --}}
        <section class="w-full bg-gradient-to-b from-gray-50 to-white py-20 sm:py-28">
            <div class="container mx-auto px-6 mb-16">
                <div class="text-center">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-slate-800">Glimpses of Your Adventure</h2>
                    <p class="text-lg text-slate-600">See the moments that await you in the skies of Bir Billing.</p>
                </div>
            </div>
            
            {{-- Full Width Masonry Gallery --}}
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="columns-2 sm:columns-3 lg:columns-4 xl:columns-5 gap-3 sm:gap-4">
                    @php
                        $images = [
                            ['src' => 'p1.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p2.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p3.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p4.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p5.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p6.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p7.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p8.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p9.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p10.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p11.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p12.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p13.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p14.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p15.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'p16.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => '1.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => '3.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => '4.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => '5.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => '6.jpg', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'image copy.png', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => 'image.png', 'class' => 'mb-3 sm:mb-4'],
                            ['src' => '21.png', 'class' => 'mb-3 sm:mb-4'],
                        ];
                    @endphp
                    
                    @foreach($images as $image)
                        <div class="{{ $image['class'] }} break-inside-avoid group">
                            <div class="relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                                <img class="w-full h-auto transform transition-all duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                     src="{{ asset('storage/' . $image['src']) }}" 
                                     alt="Paragliding moment"
                                     loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        {{-- CTA Section - Mobile Optimized --}}
        <section class="w-full bg-slate-900">
            <div class="grid lg:grid-cols-2">
                {{-- Left Side - Video (Hidden on Mobile) --}}
                <div class="hidden lg:block relative h-[400px] overflow-hidden bg-black">
                    <video class="w-full h-full object-cover" 
                           autoplay 
                           loop 
                           muted 
                           playsinline>
                        <source src="{{ asset('storage/p2hero.mp4') }}" type="video/mp4">
                        <source src="{{ asset('storage/p3hero.mp4') }}" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-slate-900/30 lg:to-slate-900/50"></div>
                </div>
                
                {{-- Right Side - Content (Full Width on Mobile) --}}
                <div class="min-h-[400px] lg:h-[400px] flex items-center justify-center p-8 lg:p-12 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
                    <div class="text-center w-full max-w-lg">
                        <h3 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 text-white">
                            Ready to <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Fly Higher?</span>
                        </h3>
                        <p class="mb-6 text-base sm:text-lg text-gray-300">
                            Limited seats. Book now to secure your spot!
                        </p>
                        
                        <div class="bg-white/5 backdrop-blur-sm rounded-xl p-6 border border-white/10">
                            <div class="mb-4">
                                <p class="text-lg text-gray-400 mb-1">Course Investment</p>
                                <p class="text-3xl sm:text-4xl font-bold text-emerald-400">
                                    ₹{{ number_format($package->price) }}
                                </p>
                            </div>
                            
                            <div class="space-y-3">
                                <a href="/booking-new/{{ $package->id }}" 
                                   class="block w-full bg-gradient-to-r from-red-600 to-red-700 text-white px-6 py-3 rounded-lg font-bold text-lg hover:from-red-700 hover:to-red-800 shadow-xl transition-all transform hover:scale-[1.02]">
                                    Book Your Course Now
                                </a>
                                
                                <a href="https://wa.me/910000000000"
                                   target="_blank"
                                   class="block w-full bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg font-bold text-lg hover:from-green-600 hover:to-green-700 transition-all flex items-center justify-center gap-2 shadow-xl">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 12c0 1.75.45 3.49 1.32 5l-1.4 5.09 5.23-1.37c1.44.81 3.08 1.24 4.76 1.24h.01c5.46 0 9.91-4.45 9.91-9.91s-4.45-9.9-9.91-9.9zm4.33 11.94c-.19.53-.94 1-1.33 1.05-.33.04-.84.05-1.28-.12-1.33-.52-2.2-1.16-3.08-2.03-.6-1.55.1-1.46.36-1.9.08-.13.12-.22.2-.36.1-.15.05-.28 0-.43-.05-.15-.49-.78-.67-1.04-.18-.27-.36-.31-.5-.31h-.31c-.15 0-.38.05-.56.27-.18.22-.68.67-.86 1.33s-.36 1.38-.05 2.18c.31.8 1.05 1.86 2.25 3.05 1.6 1.6 2.94 2.13 4.25 2.13.43 0 1.2-.18 1.58-.9.38-.72.38-1.33.27-1.48-.12-.15-.45-.23-.63-.41z"/></svg>
                                    WhatsApp Support
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ Section --}}
        <section class="container mx-auto px-6 max-w-4xl mt-20 sm:mt-28">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-slate-800">Frequently Asked Questions</h2>
            </div>
            <div class="space-y-4" x-data="{ open: 1 }">
                <div class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow">
                    <button @click="open = (open === 1 ? null : 1)" 
                            class="w-full flex justify-between items-center text-left p-6 font-semibold text-lg text-slate-800 hover:text-sky-600 transition-colors">
                        <span>How long does it take to become an independent pilot?</span>
                        <svg class="w-6 h-6 transform transition-transform text-slate-400" 
                             :class="{ 'rotate-180': open === 1 }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 1" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 pb-6 text-slate-600">
                        <p>This P1-P2 course is your first major step. Reaching a fully independent "Club Pilot" level typically takes another 15-20 days of training (P3 Course).</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow">
                    <button @click="open = (open === 2 ? null : 2)" 
                            class="w-full flex justify-between items-center text-left p-6 font-semibold text-lg text-slate-800 hover:text-sky-600 transition-colors">
                        <span>Is paragliding safe for beginners?</span>
                        <svg class="w-6 h-6 transform transition-transform text-slate-400" 
                             :class="{ 'rotate-180': open === 2 }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 2" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 pb-6 text-slate-600">
                        <p>Absolutely. Safety is our highest priority. We use modern, certified equipment, fly only in suitable weather, and our training is progressive to build your confidence securely.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow">
                    <button @click="open = (open === 3 ? null : 3)" 
                            class="w-full flex justify-between items-center text-left p-6 font-semibold text-lg text-slate-800 hover:text-sky-600 transition-colors">
                        <span>What if weather conditions are unfavorable?</span>
                        <svg class="w-6 h-6 transform transition-transform text-slate-400" 
                             :class="{ 'rotate-180': open === 3 }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 3" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="px-6 pb-6 text-slate-600">
                        <p>Safety dictates our schedule. The course duration might extend by a day or two to ensure you complete all flights safely. We never compromise on weather.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>

{{-- Alpine.js for FAQ Accordion --}}
{{-- Add this to your main layout if not already present --}}
{{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

@endsection