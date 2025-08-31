<!-- Hero Section Component (Mobile Optimized) -->
<section class="relative w-full h-[50vh] sm:h-[60vh] md:h-[70vh] lg:h-[75vh] overflow-hidden hero-section" x-data="{ muted: true, showLine1: false, showLine2: false, showLine3: false, showDesc: false, showBtn: false }" 
x-init="
setTimeout(() => showLine1 = true, 800);
setTimeout(() => showLine2 = true, 1400); 
setTimeout(() => showLine3 = true, 2000);
setTimeout(() => showDesc = true, 2600);
setTimeout(() => showBtn = true, 3200);
">
    <!-- Video Background -->
    <video
        class="absolute inset-0 w-full h-full object-cover z-0 scale-105"
        autoplay
        loop
        playsinline
        :muted="muted"
        x-ref="video"
        style="filter: brightness(0.7) saturate(1.2);"
    >
        <source src="{{ asset('storage/WhatsApp Video 2025-08-16 at 14.28.02.mp4') }}" type="video/mp4">
        <source src="https://player.vimeo.com/external/370467553.sd.mp4?s=e90dcaba73c19342c5d25e37e2d2fe8c0f7a6c96&profile_id=164" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Floating particles effect - Hidden on mobile -->
    <div class="absolute inset-0 z-5 hidden sm:block">
        <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 30%; animation-delay: 1s;"></div>
        <div class="particle" style="left: 40%; animation-delay: 3s;"></div>
        <div class="particle" style="left: 50%; animation-delay: 0.5s;"></div>
        <div class="particle" style="left: 60%; animation-delay: 2.5s;"></div>
        <div class="particle" style="left: 70%; animation-delay: 1.5s;"></div>
        <div class="particle" style="left: 80%; animation-delay: 3.5s;"></div>
        <div class="particle" style="left: 90%; animation-delay: 4s;"></div>
    </div>

    <!-- Sound Toggle Button -->
    <button
        @click="muted = !muted; $refs.video.muted = muted"
        class="absolute top-2 right-2 sm:top-4 sm:right-4 z-30 w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-black/50 hover:bg-orange-600/80 backdrop-blur-sm text-white rounded-full transition-all transform hover:scale-110 flex items-center justify-center"
        aria-label="Toggle sound"
    >
        <svg x-show="muted" class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" clip-rule="evenodd"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path>
        </svg>
        <svg x-show="!muted" class="w-3 h-3 sm:w-4 sm:h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path>
        </svg>
    </button>

    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/30 via-transparent to-transparent z-10"></div>

    <!-- Content - Mobile Optimized -->
    <div class="relative z-20 flex items-center h-full px-3 sm:px-6 md:px-12 lg:px-16">
        <div class="text-left text-white max-w-3xl">
            <!-- Main Heading - First Line -->
            <div class="overflow-hidden mb-0 sm:mb-1">
                <span class="block text-2xl xs:text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-black text-white transition-all duration-700 ease-out"
                    style="text-shadow: 1px 1px 3px rgba(0,0,0,0.4);"
                    :class="showLine1 ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'">
                    READY TO
                </span>
            </div>

            <!-- Main Heading - Second Line (FLY) -->
            <div class="overflow-hidden mb-0 sm:mb-1">
                <span class="block text-3xl xs:text-4xl sm:text-5xl md:text-6xl lg:text-8xl font-black text-orange-400 bg-gradient-to-r from-orange-400 via-yellow-400 to-red-500 bg-clip-text text-transparent transition-all duration-700 ease-out animate-breathe"
                    style="filter: drop-shadow(1px 1px 2px rgba(0,0,0,0.3));"
                    :class="showLine2 ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'">
                    FLY
                </span>
            </div>

            <!-- Main Heading - Third Line -->
            <div class="overflow-hidden mb-2 sm:mb-4 md:mb-6 lg:mb-8">
                <span class="block text-xl xs:text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-light text-gray-100 transition-all duration-700 ease-out"
                    style="text-shadow: 1px 1px 3px rgba(0,0,0,0.4);"
                    :class="showLine3 ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'">
                    HIGHER?
                </span>
            </div>

            <!-- Subtitle - Hidden on very small screens -->
            <div class="mb-3 sm:mb-6 hidden xs:block">
                <p class="text-xs sm:text-sm md:text-base lg:text-xl text-white font-medium leading-relaxed max-w-2xl transition-all duration-700 ease-out"
                    style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);"
                    :class="showDesc ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    Break free from the ground and embrace the endless sky. Your ultimate paragliding adventure 
                    <span class="text-orange-300 font-bold">starts right here.</span>
                </p>
            </div>

            <!-- CTA Button - Smaller on mobile -->
            <div>
                <a href="{{ route('packages.index') }}" class="group modern-button hover-lift inline-flex px-4 py-2 xs:px-5 xs:py-2.5 sm:px-6 sm:py-3 md:px-8 md:py-4 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white text-sm xs:text-base sm:text-lg md:text-xl font-bold rounded-full transition-all duration-700 shadow-xl ease-out" 
                    style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);"
                    :class="showBtn ? 'translate-y-0 opacity-100 scale-100' : 'translate-y-4 opacity-0 scale-95'">
                    <span class="flex items-center justify-center space-x-1 sm:space-x-2 relative z-10">
                        <svg class="w-3 h-3 xs:w-4 xs:h-4 sm:w-5 sm:h-5 group-hover:text-yellow-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span>ready to fly?</span>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator - Hidden on mobile -->
    <div class="absolute bottom-4 sm:bottom-6 md:bottom-8 left-1/2 transform -translate-x-1/2 z-20 animate-bounce hidden sm:block">
        <div class="w-5 h-8 sm:w-6 sm:h-10 border-2 border-white/60 rounded-full flex justify-center">
            <div class="w-1 h-2 sm:h-3 bg-white rounded-full mt-1.5 sm:mt-2 animate-pulse"></div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Hero Section Animations */
@keyframes breathe {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
    25% { transform: translateY(-30px) rotate(5deg) scale(1.1); }
    50% { transform: translateY(-15px) rotate(-3deg) scale(0.9); }
    75% { transform: translateY(-25px) rotate(2deg) scale(1.05); }
}

.particle {
    position: absolute;
    width: 3px;
    height: 3px;
    background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.2) 100%);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite;
    top: 100%;
    filter: blur(0.5px);
}

.animate-breathe {
    animation: breathe 3s ease-in-out infinite;
}

.hover-lift {
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.hover-lift:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 20px 40px rgba(255, 140, 0, 0.4);
}

.modern-button {
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.modern-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.modern-button:hover::before {
    left: 100%;
}

/* Extra small devices (phones < 480px) */
@media (max-width: 479px) {
    .hero-section {
        height: 50vh !important;
        min-height: 350px;
        max-height: 450px;
    }
}

/* Small devices (landscape phones) */
@media (min-width: 480px) and (max-width: 639px) {
    .hero-section {
        height: 55vh !important;
        min-height: 400px;
        max-height: 500px;
    }
}

/* Tablets */
@media (min-width: 640px) and (max-width: 767px) {
    .hero-section {
        height: 60vh !important;
    }
}

/* Custom breakpoint for xs */
@media (min-width: 380px) {
    .xs\:text-3xl { font-size: 1.875rem; }
    .xs\:text-4xl { font-size: 2.25rem; }
    .xs\:text-2xl { font-size: 1.5rem; }
    .xs\:text-base { font-size: 1rem; }
    .xs\:block { display: block; }
    .xs\:px-5 { padding-left: 1.25rem; padding-right: 1.25rem; }
    .xs\:py-2\.5 { padding-top: 0.625rem; padding-bottom: 0.625rem; }
    .xs\:w-4 { width: 1rem; }
    .xs\:h-4 { height: 1rem; }
}

/* Landscape mode adjustments */
@media (max-height: 500px) and (orientation: landscape) {
    .hero-section {
        height: 80vh !important;
        min-height: 300px;
    }
    
    /* Hide subtitle in landscape mobile */
    .hero-section p {
        display: none !important;
    }
    
    /* Reduce text sizes in landscape */
    .hero-section span {
        line-height: 1 !important;
    }
}

/* Disable animations on mobile for performance */
@media (max-width: 640px) {
    .particle { 
        display: none !important; 
    }
    
    .animate-breathe {
        animation: breathe 3s ease-in-out 1;
        animation-fill-mode: forwards;
    }
}

/* Reduce motion for accessibility */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.3s !important;
        animation-iteration-count: 1 !important;
    }
    .particle { animation: none; }
    .animate-bounce { animation: none; }
    .animate-pulse { animation: none; }
}
</style>
@endpush