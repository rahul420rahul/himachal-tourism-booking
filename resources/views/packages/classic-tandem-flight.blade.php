@extends('layouts.app')

@section('content')

{{-- 
    ======================================================================
    CLASSIC TANDEM FLIGHT - FULLY RESPONSIVE VERSION
    ======================================================================
    - Standard 20-30 minute flight experience
    - Mobile-first responsive design
    - Optimized for all devices
--}}

<div class="bg-white text-slate-800 antialiased">

    <header>
        <div class="w-full">
            {{-- Responsive hero section --}}
            <section class="grid grid-cols-1 lg:grid-cols-3">
                
                {{-- Video Section - Progressive heights --}}
                <div class="col-span-1 lg:col-span-2 relative h-[300px] sm:h-[400px] md:h-[450px] lg:h-[500px] xl:h-[550px]">
                    <video class="absolute inset-0 w-full h-full object-cover" 
                           autoplay 
                           loop 
                           muted 
                           playsinline>
                        <source src="{{ asset('storage/p1p2hero.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    {{-- Mobile gradient overlay for readability --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent lg:hidden"></div>
                </div>
    
                {{-- Content Section - Responsive padding and sizing --}}
                <div class="col-span-1 bg-slate-900 flex flex-col justify-center px-6 py-8 sm:px-8 sm:py-10 md:p-12 lg:p-8 xl:p-12 min-h-[350px] lg:min-h-[500px] xl:min-h-[550px]">
                    
                    <span class="font-semibold text-amber-400 tracking-widest uppercase text-xs sm:text-sm mb-2">
                        The Essential Bir Experience
                    </span>
                    
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-4xl xl:text-5xl 2xl:text-6xl font-extrabold leading-tight text-white drop-shadow-md mb-4 lg:mb-6">
                        Classic Tandem Flight
                    </h1>
                    
                    <div class="my-4 sm:my-6">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-emerald-400 drop-shadow-sm">
                            ₹4,000
                        </div>
                        <div class="text-base sm:text-lg text-slate-300 mt-2">
                            20-30 Minute Scenic Flight
                            <span class="block text-slate-400 font-light text-sm sm:text-base">
                                Includes GoPro Video & Photos
                            </span>
                        </div>
                    </div>
    
                    {{-- Responsive CTA buttons --}}
                    <div class="flex flex-col sm:flex-row gap-3 mt-4">
                        <a href="/booking-new/{{ $package->id }}"
                           class="flex-1 text-center bg-red-600 text-white px-4 py-2.5 sm:px-6 sm:py-3 rounded-lg font-bold text-base sm:text-lg hover:bg-red-700 transition-all transform hover:scale-105 shadow-lg">
                            Book Your Flight
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

    {{-- Stats Bar - Responsive grid --}}
    <div class="bg-gray-50 border-y border-gray-200 py-8 sm:py-10">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8 text-center">
                <div class="border-r border-gray-200 last:border-r-0 md:border-r px-2">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-orange-500">15+</div>
                    <div class="text-slate-500 mt-1 uppercase tracking-wider text-xs sm:text-sm">Years Experience</div>
                </div>
                <div class="border-r-0 md:border-r border-gray-200 px-2">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-emerald-500">5000+</div>
                    <div class="text-slate-500 mt-1 uppercase tracking-wider text-xs sm:text-sm">Happy Flyers</div>
                </div>
                <div class="border-r border-gray-200 last:border-r-0 md:border-r px-2">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-sky-500">30</div>
                    <div class="text-slate-500 mt-1 uppercase tracking-wider text-xs sm:text-sm">Mins Flight</div>
                </div>
                <div class="px-2">
                    <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-rose-500">100%</div>
                    <div class="text-slate-500 mt-1 uppercase tracking-wider text-xs sm:text-sm">Safety Record</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content - Responsive padding --}}
    <main id="course-details" class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 md:py-20 lg:py-24">

        {{-- Features Section --}}
        <section class="max-w-6xl mx-auto mb-16 sm:mb-20 lg:mb-24">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4 text-slate-800">
                    Soar Over the 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-600 to-emerald-600 block sm:inline">
                        Paragliding Capital
                    </span>
                </h2>
                <p class="text-base sm:text-lg text-slate-600 max-w-3xl mx-auto px-4 sm:px-0">
                    Our Classic Tandem Flight is the perfect way to experience Bir Billing. In 20-30 minutes, witness stunning Himalayan views 
                    and feel the incredible sensation of free flight with our expert pilots.
                </p>
            </div>
            
            {{-- Two column layout - Mobile responsive --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <img src="{{ asset('storage/p2.jpg') }}" 
                         alt="Paraglider preparing for classic tandem flight" 
                         class="w-full rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl">
                </div>
                
                <div class="order-1 lg:order-2 bg-white p-6 sm:p-8 rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl border border-gray-100">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8 text-slate-800">
                        Your Flight Includes
                    </h3>
                    <div class="space-y-3 sm:space-y-4">
                        <div class="bg-gray-50 p-3 sm:p-4 rounded-lg flex items-start gap-3 sm:gap-4">
                            <span class="text-emerald-500 font-bold text-lg sm:text-xl mt-0.5 flex-shrink-0">✓</span>
                            <div class="text-sm sm:text-base">
                                <span class="font-semibold text-slate-700">Standard Flight:</span>
                                <span class="text-slate-600"> 20-30 minutes of scenic paragliding.</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-3 sm:p-4 rounded-lg flex items-start gap-3 sm:gap-4">
                            <span class="text-emerald-500 font-bold text-lg sm:text-xl mt-0.5 flex-shrink-0">✓</span>
                            <div class="text-sm sm:text-base">
                                <span class="font-semibold text-slate-700">Expert Pilot:</span>
                                <span class="text-slate-600"> Certified pilot with years of experience.</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-3 sm:p-4 rounded-lg flex items-start gap-3 sm:gap-4">
                            <span class="text-emerald-500 font-bold text-lg sm:text-xl mt-0.5 flex-shrink-0">✓</span>
                            <div class="text-sm sm:text-base">
                                <span class="font-semibold text-slate-700">Media Package:</span>
                                <span class="text-slate-600"> HD GoPro video & photos included.</span>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-3 sm:p-4 rounded-lg flex items-start gap-3 sm:gap-4">
                            <span class="text-emerald-500 font-bold text-lg sm:text-xl mt-0.5 flex-shrink-0">✓</span>
                            <div class="text-sm sm:text-base">
                                <span class="font-semibold text-slate-700">Full Safety:</span>
                                <span class="text-slate-600"> All equipment and briefing provided.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Gallery Section - Responsive grid --}}
        <section class="max-w-6xl mx-auto mb-16 sm:mb-20 lg:mb-24">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4 text-slate-800">
                    Glimpses of Your Adventure
                </h2>
                <p class="text-base sm:text-lg text-slate-600">
                    See the moments that await you in the skies of Bir Billing.
                </p>
            </div>
            
            {{-- Responsive image grid with aspect ratio --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 sm:gap-3 md:gap-4">
                @for ($i = 1; $i <= 16; $i++)
                    <div class="aspect-square overflow-hidden rounded-lg">
                        <img class="w-full h-full object-cover hover:scale-110 transition-transform duration-300 shadow-md" 
                             src="{{ asset('storage/p' . $i . '.jpg') }}" 
                             alt="Paragliding moment {{ $i }}"
                             loading="lazy">
                    </div>
                @endfor
            </div>
        </section>
        
        {{-- CTA Section - Responsive design --}}
        <section id="booking" class="max-w-5xl mx-auto text-center bg-gradient-to-br from-sky-600 to-emerald-600 text-white p-8 sm:p-12 md:p-16 rounded-2xl sm:rounded-3xl shadow-xl sm:shadow-2xl">
            <h3 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4">
                Ready to Take Flight?
            </h3>
            <p class="mb-6 sm:mb-8 text-base sm:text-lg text-sky-100 max-w-2xl mx-auto px-4 sm:px-0">
                Experience the thrill of paragliding in one of the world's best locations. Book your Classic Tandem Flight today!
            </p>
            <p class="text-2xl sm:text-3xl font-bold mb-5 sm:mb-6">
                Flight Price: ₹4,000
            </p>
            <a href="/booking-new/{{ $package->id }}" class="inline-block bg-white text-gray-800 px-8 py-3 sm:px-10 sm:py-4 rounded-lg font-bold text-lg sm:text-xl hover:bg-gray-100 shadow-lg transition-all transform hover:scale-105">
                Book Your Flight Now
            </a>
        </section>

        {{-- FAQ Section - Touch optimized --}}
        <section class="max-w-4xl mx-auto mt-16 sm:mt-20 lg:mt-24">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4 text-slate-800">
                    Your Questions Answered
                </h2>
            </div>
            
            <div class="space-y-3 sm:space-y-4" x-data="{ open: 1 }">
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <button @click="open = (open === 1 ? null : 1)" 
                            class="w-full flex justify-between items-center text-left p-4 sm:p-5 font-semibold text-base sm:text-lg text-slate-800">
                        <span class="pr-2 text-sm sm:text-base lg:text-lg">
                            Do I need any previous experience?
                        </span>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 transform transition-transform text-slate-400" 
                             :class="{ 'rotate-180': open === 1 }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 1" x-transition class="px-4 pb-4 sm:px-5 sm:pb-5 text-sm sm:text-base text-slate-600">
                        <p>Not at all! This tandem flight is for everyone. Your certified pilot handles all controls while you enjoy the breathtaking views.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <button @click="open = (open === 2 ? null : 2)" 
                            class="w-full flex justify-between items-center text-left p-4 sm:p-5 font-semibold text-base sm:text-lg text-slate-800">
                        <span class="pr-2 text-sm sm:text-base lg:text-lg">
                            Is this flight safe?
                        </span>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 transform transition-transform text-slate-400" 
                             :class="{ 'rotate-180': open === 2 }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 2" x-transition class="px-4 pb-4 sm:px-5 sm:pb-5 text-sm sm:text-base text-slate-600">
                        <p>Absolutely! We use certified equipment, experienced pilots with thousands of flight hours, and only fly in safe weather conditions.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <button @click="open = (open === 3 ? null : 3)" 
                            class="w-full flex justify-between items-center text-left p-4 sm:p-5 font-semibold text-base sm:text-lg text-slate-800">
                        <span class="pr-2 text-sm sm:text-base lg:text-lg">
                            What should I wear for the flight?
                        </span>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 transform transition-transform text-slate-400" 
                             :class="{ 'rotate-180': open === 3 }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 3" x-transition class="px-4 pb-4 sm:px-5 sm:pb-5 text-sm sm:text-base text-slate-600">
                        <p>Wear comfortable layered clothing and a windproof jacket. Sturdy closed-toe shoes are essential, and don't forget sunglasses!</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <button @click="open = (open === 4 ? null : 4)" 
                            class="w-full flex justify-between items-center text-left p-4 sm:p-5 font-semibold text-base sm:text-lg text-slate-800">
                        <span class="pr-2 text-sm sm:text-base lg:text-lg">
                            What's the difference from other flight options?
                        </span>
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 flex-shrink-0 transform transition-transform text-slate-400" 
                             :class="{ 'rotate-180': open === 4 }" 
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open === 4" x-transition class="px-4 pb-4 sm:px-5 sm:pb-5 text-sm sm:text-base text-slate-600">
                        <p>The Classic flight offers the perfect balance - longer than Joy Ride (15-20 mins) for a fuller experience, but more affordable than Cross Country (45-60 mins). It's ideal for those wanting a complete paragliding experience without the premium price.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>

{{-- Alpine.js for FAQ accordion --}}
{{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

@endsection 