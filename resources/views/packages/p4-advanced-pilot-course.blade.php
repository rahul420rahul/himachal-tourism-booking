@extends('layouts.app')

@section('content')

{{-- 
    ======================================================================
    P4 ADVANCED COURSE - WITH 4 VIDEO GRID
    ======================================================================
    - Mobile-first design approach
    - 4 video grid in hero section (same as P1-P3)
    - Full width sections
    - Proper responsive breakpoints
--}}

<div class="bg-white text-slate-800 antialiased">

    <header>
        <div class="w-full">
            {{-- Responsive hero section with 4 videos grid --}}
            <section class="grid grid-cols-1 lg:grid-cols-3">
                
                {{-- 4 Videos Grid Section - Responsive height --}}
                <div class="col-span-1 lg:col-span-2 relative h-[300px] sm:h-[400px] md:h-[450px] lg:h-[500px] xl:h-[550px] bg-black">
                    {{-- 2x2 Grid with 4 Different Videos --}}
                    <div class="grid grid-cols-2 grid-rows-2 h-full">
                        {{-- Top Left - First Video --}}
                        <div class="relative overflow-hidden group">
                            <video class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                   autoplay 
                                   loop 
                                   muted 
                                   playsinline>
                                <source src="{{ asset('storage/p4hero.mp4') }}" type="video/mp4">
                                <source src="{{ asset('storage/p4hero1.mp4') }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        {{-- Top Right - Second Video --}}
                        <div class="relative overflow-hidden group">
                            <video class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                   autoplay 
                                   loop 
                                   muted 
                                   playsinline>
                                <source src="{{ asset('storage/p3hero.mp4') }}" type="video/mp4">
                                <source src="{{ asset('storage/hero-mobile.mp4') }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        {{-- Bottom Left - Third Video --}}
                        <div class="relative overflow-hidden group">
                            <video class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                   autoplay 
                                   loop 
                                   muted 
                                   playsinline>
                                <source src="{{ asset('storage/hero-final.mp4') }}" type="video/mp4">
                                <source src="{{ asset('storage/p2hero.mp4') }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        {{-- Bottom Right - Fourth Video --}}
                        <div class="relative overflow-hidden group">
                            <video class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                   autoplay 
                                   loop 
                                   muted 
                                   playsinline>
                                <source src="{{ asset('storage/p1hero.mp4') }}" type="video/mp4">
                                <source src="{{ asset('storage/p1p2hero.mp4') }}" type="video/mp4">
                            </video>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </div>
                    {{-- Mobile overlay for better text visibility --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent lg:hidden"></div>
                </div>
    
                {{-- Content Section - Responsive padding and text sizes --}}
                <div class="col-span-1 bg-slate-900 flex flex-col justify-center px-6 py-8 sm:px-8 sm:py-10 md:p-12 lg:p-8 xl:p-12 min-h-[350px] lg:min-h-[500px] xl:min-h-[550px]">
                    
                    <span class="font-semibold text-amber-400 tracking-widest uppercase text-xs sm:text-sm mb-2">
                        Advanced Pilot Certification
                    </span>
                    
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-4xl xl:text-5xl 2xl:text-6xl font-extrabold leading-tight text-white drop-shadow-md mb-4 lg:mb-6">
                        P4 Advanced Course
                    </h1>
                    
                    <div class="my-4 sm:my-6">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-emerald-400 drop-shadow-sm">
                            ₹60,000
                        </div>
                        <div class="text-base sm:text-lg text-slate-300 mt-2">
                            Cross-Country (XC) Mastery
                            <span class="block text-slate-400 font-light text-sm sm:text-base">
                                Become a Competition-Ready Pilot
                            </span>
                        </div>
                    </div>
    
                    {{-- Responsive buttons --}}
                    <div class="flex flex-col sm:flex-row gap-3 mt-4">
                        <a href="/booking-new/{{ $package->id }}"
                           class="flex-1 text-center bg-red-600 text-white px-4 py-2.5 sm:px-6 sm:py-3 rounded-lg font-bold text-base sm:text-lg hover:bg-red-700 transition-all transform hover:scale-105 shadow-lg">
                            Enroll Now
                        </a>
                        
                        <a href="https://wa.me/910000000000"
                           target="_blank"
                           class="flex-1 text-center bg-green-500 text-white px-4 py-2.5 sm:px-6 sm:py-3 rounded-lg font-bold text-base sm:text-lg hover:bg-green-600 transition-all flex items-center justify-center gap-2 shadow-lg">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.04 2C6.58 2 2.13 6.45 2.13 12c0 1.75.45 3.49 1.32 5l-1.4 5.09 5.23-1.37c1.44.81 3.08 1.24 4.76 1.24h.01c5.46 0 9.91-4.45 9.91-9.91s-4.45-9.9-9.91-9.9zm4.33 11.94c-.19.53-.94 1-1.33 1.05-.33.04-.84.05-1.28-.12-1.33-.52-2.2-1.16-3.08-2.03-.6-1.55.1-1.46.36-1.9.08-.13.12-.22.2-.36.1-.15.05-.28 0-.43-.05-.15-.49-.78-.67-1.04-.18-.27-.36-.31-.5-.31h-.31c-.15 0-.38.05-.56.27-.18.22-.68.67-.86 1.33s-.36 1.38-.05 2.18c.31.8 1.05 1.86 2.25 3.05 1.6 1.6 2.94 2.13 4.25 2.13.43 0 1.2-.18 1.58-.9.38-.72.38-1.33.27-1.48-.12-.15-.45-.23-.63-.41z"/>
                            </svg>
                            <span class="hidden xs:inline">WhatsApp</span>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </header>

    {{-- Stats Bar Section --}}
    <div class="bg-gray-50 border-y border-gray-200 py-8 sm:py-10">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 text-center">
                <div class="border-r border-gray-200 last:border-r-0 md:border-r">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-orange-500">15+</div>
                    <div class="text-slate-500 mt-1 uppercase tracking-wider text-xs sm:text-sm">Years Experience</div>
                </div>
                <div class="border-r border-gray-200 last:border-r-0">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-emerald-500">50KM+</div>
                    <div class="text-slate-500 mt-1 uppercase tracking-wider text-xs sm:text-sm">XC Flights</div>
                </div>
                <div class="border-r border-gray-200 last:border-r-0 md:border-r">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-sky-500">Competition</div>
                    <div class="text-slate-500 mt-1 uppercase tracking-wider text-xs sm:text-sm">Training</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-rose-500">100%</div>
                    <div class="text-slate-500 mt-1 uppercase tracking-wider text-xs sm:text-sm">Safety Record</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main id="course-details">

        {{-- Full Width Skills Section --}}
        <section class="w-full py-16 sm:py-20 lg:py-24 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4 text-slate-800">
                        Master the Art of 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-600 to-emerald-600 block sm:inline">
                            Cross-Country Flying
                        </span>
                    </h2>
                    <p class="text-base sm:text-lg text-slate-600 max-w-3xl mx-auto px-4 sm:px-0">
                        The P4 Advanced Course is the pinnacle of pilot training. Designed for certified P3 pilots, this course delves deep into advanced cross-country (XC) strategies, competition flying, and SIV (safety) maneuvers, transforming you into an expert pilot.
                    </p>
                </div>
                
                {{-- Two column layout - stack on mobile --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center max-w-7xl mx-auto">
                    <div class="order-2 lg:order-1">
                        <img src="{{ asset('storage/p5.jpg') }}" 
                             alt="A skilled paraglider flying a cross-country route" 
                             class="w-full rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl">
                    </div>
                    
                    <div class="order-1 lg:order-2 bg-white p-6 sm:p-8 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border border-gray-100">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8 text-slate-800">Advanced Skills You'll Acquire</h3>
                        <div class="space-y-3 sm:space-y-4">
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg flex items-start gap-3 sm:gap-4">
                                <span class="text-emerald-500 font-bold text-lg sm:text-xl mt-0.5">✓</span>
                                <div class="text-sm sm:text-base">
                                    <span class="font-semibold text-slate-700">Advanced Thermal & Convergence:</span> 
                                    <span class="text-slate-600">Master flying in complex lift conditions to maximize altitude gain.</span>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg flex items-start gap-3 sm:gap-4">
                                <span class="text-emerald-500 font-bold text-lg sm:text-xl mt-0.5">✓</span>
                                <div class="text-sm sm:text-base">
                                    <span class="font-semibold text-slate-700">XC Route Optimization:</span> 
                                    <span class="text-slate-600">In-depth training on map reading, GPS use, and airspace regulations.</span>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg flex items-start gap-3 sm:gap-4">
                                <span class="text-emerald-500 font-bold text-lg sm:text-xl mt-0.5">✓</span>
                                <div class="text-sm sm:text-base">
                                    <span class="font-semibold text-slate-700">SIV & Advanced Descents:</span> 
                                    <span class="text-slate-600">Practice incident simulation and recovery maneuvers over water for maximum safety.</span>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-3 sm:p-4 rounded-lg flex items-start gap-3 sm:gap-4">
                                <span class="text-emerald-500 font-bold text-lg sm:text-xl mt-0.5">✓</span>
                                <div class="text-sm sm:text-base">
                                    <span class="font-semibold text-slate-700">Competition Strategy:</span> 
                                    <span class="text-slate-600">Learn the fundamentals of task flying, speed-to-fly theory, and competitive strategy.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Full Width Gallery Section --}}
        <section class="w-full py-16 sm:py-20 lg:py-24 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4 text-slate-800">
                        Join the Elite Flyers
                    </h2>
                    <p class="text-base sm:text-lg text-slate-600">
                        See the incredible flights and adventures that await a P4 pilot.
                    </p>
                </div>
            </div>
            
            {{-- Full width image grid --}}
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 sm:gap-3 md:gap-4">
                    @for ($i = 1; $i <= 12; $i++)
                        <div class="aspect-square overflow-hidden rounded-lg">
                            <img class="w-full h-full object-cover hover:scale-110 transition-transform duration-300 shadow-md" 
                                 src="{{ asset('storage/p' . $i . '.jpg') }}" 
                                 alt="Paragliding moment {{ $i }}"
                                 loading="lazy">
                        </div>
                    @endfor
                </div>
            </div>
        </section>
        
        {{-- Full Width CTA Section with Video --}}
        <section id="booking" class="w-full bg-gradient-to-br from-sky-600 to-emerald-600">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                {{-- Video Section --}}
                <div class="relative h-[300px] sm:h-[400px] lg:h-[450px] bg-black">
                    <video class="w-full h-full object-cover" 
                           autoplay 
                           loop 
                           muted 
                           playsinline>
                        <source src="{{ asset('storage/p4hero.mp4') }}" type="video/mp4">
                        <source src="{{ asset('storage/hero-final.mp4') }}" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                </div>
                
                {{-- Content Section --}}
                <div class="flex items-center justify-center p-8 sm:p-12 lg:p-16 text-white h-[300px] sm:h-[400px] lg:h-[450px]">
                    <div class="text-center lg:text-left max-w-xl">
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-4">
                            Ready to Join the Elite?
                        </h3>
                        <p class="mb-4 sm:mb-6 text-sm sm:text-base text-sky-100">
                            This course is your final step towards becoming a true expert in the sport. Elevate your skills, knowledge, and confidence to the highest level.
                        </p>
                        <div class="mb-4 sm:mb-6">
                            <p class="text-lg sm:text-xl mb-2">Course Duration: 10-14 Days</p>
                            <p class="text-2xl sm:text-3xl font-bold">₹60,000</p>
                        </div>
                        <div class="space-y-3 sm:space-y-0 sm:space-x-4">
                            <a href="/booking-new/{{ $package->id }}" class="block w-full sm:inline-block sm:w-auto bg-white text-gray-800 px-6 py-2.5 sm:px-8 sm:py-3 rounded-lg font-bold text-base sm:text-lg hover:bg-gray-100 shadow-lg transition-all transform hover:scale-105">
                                Book Now
                            </a>
                            <a href="https://wa.me/910000000000" 
                               target="_blank"
                               class="block w-full sm:inline-block sm:w-auto bg-green-500 text-white px-6 py-2.5 sm:px-8 sm:py-3 rounded-lg font-bold text-base sm:text-lg hover:bg-green-600 shadow-lg transition-all transform hover:scale-105">
                                Contact on WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ Section --}}
        <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-8 sm:mb-12">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4 text-slate-800">
                        Your Questions Answered
                    </h2>
                </div>
                
                <div class="space-y-3 sm:space-y-4" x-data="{ open: 1 }">
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                        <button @click="open = (open === 1 ? null : 1)" 
                                class="w-full flex justify-between items-center text-left p-4 sm:p-5 font-semibold text-base sm:text-lg text-slate-800">
                            <span class="pr-2">What are the prerequisites for the P4 course?</span>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 transform transition-transform text-slate-400" 
                                 :class="{ 'rotate-180': open === 1 }" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open === 1" x-transition class="px-4 pb-4 sm:px-5 sm:pb-5 text-sm sm:text-base text-slate-600">
                            <p>A valid P3 certification from a recognized paragliding association is mandatory. Pilots are also expected to have a significant number of flight hours (typically 40+ hours) and be proficient in thermalling and soaring.</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                        <button @click="open = (open === 2 ? null : 2)" 
                                class="w-full flex justify-between items-center text-left p-4 sm:p-5 font-semibold text-base sm:text-lg text-slate-800">
                            <span class="pr-2">Is my own equipment mandatory for P4?</span>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 transform transition-transform text-slate-400" 
                                 :class="{ 'rotate-180': open === 2 }" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open === 2" x-transition class="px-4 pb-4 sm:px-5 sm:pb-5 text-sm sm:text-base text-slate-600">
                            <p>Yes. At the P4 level, it is essential that you own and are intimately familiar with your own equipment. This includes a certified wing appropriate for your skill level, a harness with a reserve parachute, a helmet, and a GPS vario.</p>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                        <button @click="open = (open === 3 ? null : 3)" 
                                class="w-full flex justify-between items-center text-left p-4 sm:p-5 font-semibold text-base sm:text-lg text-slate-800">
                            <span class="pr-2">What does a P4 certification allow me to do?</span>
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 transform transition-transform text-slate-400" 
                                 :class="{ 'rotate-180': open === 3 }" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open === 3" x-transition class="px-4 pb-4 sm:px-5 sm:pb-5 text-sm sm:text-base text-slate-600">
                            <p>A P4 certification recognizes you as an advanced pilot. It allows you to fly in more challenging conditions, undertake long cross-country flights, and participate in national and international paragliding competitions. It is the highest non-professional pilot rating.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>

{{-- Alpine.js for FAQ accordion --}}
{{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

@endsection