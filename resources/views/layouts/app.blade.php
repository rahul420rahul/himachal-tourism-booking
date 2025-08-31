<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
        /* Optimized Preloader for Mobile */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 50%, #2c3e50 100%);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
            transition: opacity 0.3s ease;
            pointer-events: all;
        }
        
        .preloader.fade-out {
            opacity: 0;
            pointer-events: none;
        }
        
        .preloader-content {
            text-align: center;
            padding: 20px;
        }
        
        /* Simplified logo without heavy animations */
        .preloader-logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .preloader-logo img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            /* Remove heavy filters for mobile */
            filter: brightness(1.1);
        }
        
        .preloader-brand {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }
        
        .brand-my {
            color: #ff4757;
        }
        
        .brand-bir {
            color: #ffa502;
        }
        
        .brand-billing {
            color: #7bed9f;
        }
        
        .preloader-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            font-weight: 300;
            margin-bottom: 1.5rem;
        }
        
        /* Simple spinner without complex animations */
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Remove heavy animations on mobile */
        @media (max-width: 768px) {
            .preloader-logo {
                width: 100px;
                height: 100px;
                margin-bottom: 1rem;
                /* No animations on mobile */
                animation: none !important;
            }
            
            .preloader-logo img {
                width: 80px;
                height: 80px;
                /* Simpler filter for mobile */
                filter: none;
            }
            
            .preloader-brand {
                font-size: 2rem;
                /* No glow animation on mobile */
                animation: none !important;
            }
            
            .brand-my,
            .brand-bir,
            .brand-billing {
                /* Remove text shadows on mobile */
                text-shadow: none !important;
            }
            
            .preloader-subtitle {
                font-size: 0.85rem;
                /* No fade animation on mobile */
                animation: none !important;
            }
            
            .loading-spinner {
                width: 35px;
                height: 35px;
                border-width: 2px;
            }
        }
        
        @media (max-width: 480px) {
            .preloader-brand {
                font-size: 1.8rem;
            }
            
            .preloader-logo {
                width: 80px;
                height: 80px;
            }
            
            .preloader-logo img {
                width: 60px;
                height: 60px;
            }
        }
        
        /* Desktop animations - only for larger screens */
        @media (min-width: 769px) {
            .preloader-logo {
                animation: logoFloat 2s ease-in-out infinite;
            }
            
            .preloader-brand {
                animation: textGlow 2s ease-in-out infinite alternate;
            }
            
            .brand-my {
                text-shadow: 0 0 30px rgba(255, 71, 87, 0.6);
            }
            
            .brand-bir {
                text-shadow: 0 0 30px rgba(255, 165, 2, 0.6);
            }
            
            .brand-billing {
                text-shadow: 0 0 30px rgba(123, 237, 159, 0.6);
            }
            
            .preloader-subtitle {
                animation: fadeInOut 3s ease-in-out infinite;
            }
            
            @keyframes logoFloat {
                0%, 100% { transform: translateY(0px) scale(1); }
                50% { transform: translateY(-10px) scale(1.05); }
            }
            
            @keyframes textGlow {
                0% { transform: scale(1); }
                100% { transform: scale(1.05); }
            }
            
            @keyframes fadeInOut {
                0%, 100% { opacity: 0.7; }
                50% { opacity: 1; }
            }
        }
        
        /* Performance optimization */
        .preloader * {
            will-change: auto !important;
        }
        
        /* Hide content until loaded */
        body.loading main,
        body.loading footer,
        body.loading nav:not(.preloader) {
            display: none;
        }
        
        body.loaded main,
        body.loaded footer,
        body.loaded nav {
            display: block;
        }
        
        /* FIXED: Footer visibility classes */
        /* Desktop Footer - Only visible on large screens */
        .desktop-footer {
            display: none !important;
        }
        
        @media (min-width: 1024px) {
            .desktop-footer {
                display: block !important;
            }
        }
        
        /* Mobile Footer - Only visible on small/medium screens */
        .mobile-footer {
            display: block !important;
        }
        
        @media (min-width: 1024px) {
            .mobile-footer {
                display: none !important;
            }
        }
        
        /* Mobile Bottom Navigation - Only visible on small/medium screens */
        .mobile-bottom-nav {
            display: block !important;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 50;
            background: white;
            border-top: 1px solid #e5e7eb;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }
        
        @media (min-width: 1024px) {
            .mobile-bottom-nav {
                display: none !important;
            }
        }
        
        /* Body padding for mobile bottom nav */
        @media (max-width: 1023px) {
            body {
                padding-bottom: 64px; /* Space for fixed bottom nav */
            }
        }
    </style>
<title>{{ config('app.name', 'MyBirBilling') }} - @yield('title', 'Paragliding Adventures')</title>
{{-- Favicon --}}
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
{{-- Vite Assets --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
{{-- Alpine.js for dropdown functionality --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
{{-- Styles --}}
<style>
    [x-cloak] { display: none !important; }
    /* Smooth transitions */
    .nav-transition {
        transition: all 0.3s ease;
    }
</style>
@stack('styles')
</head>
<body class="font-sans antialiased bg-dark-50 loading">
    {{-- Optimized Preloader --}}
    <div class="preloader" id="preloader">
        <div class="preloader-content">
            {{-- Logo Container --}}
            <div class="preloader-logo">
                <img src="{{ asset('storage/image.png') }}" alt="MyBirBilling Logo" loading="eager">
            </div>
            
            {{-- Brand Name --}}
            <h1 class="preloader-brand">
                <span class="brand-my">My</span><span class="brand-bir">Bir</span><span class="brand-billing">Billing</span>
            </h1>
            
            {{-- Subtitle --}}
            <p class="preloader-subtitle">Paragliding Adventures Await</p>
            
            {{-- Loading Spinner --}}
            <div class="loading-spinner"></div>
        </div>
    </div>

    {{-- Main Header --}}
    @include('partials.header')
    
    {{-- Hero Section (if defined) --}}
    @hasSection('hero')
    <section class="hero-section">
        @yield('hero')
    </section>
    @endif
    
    {{-- Main Content Area --}}
    <main id="main-content" class="flex-grow">
        {{-- Flash Messages --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif
            
            @if(session('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif
        </div>
        
        {{-- Page Content --}}
        @yield('content')
    </main>
    
    {{-- Desktop Footer (visible only on desktop - lg and above) --}}
    <footer class="desktop-footer bg-gray-800 text-white">
        @include('partials.footer')
    </footer>
    
    {{-- Mobile Footer (visible only on mobile/tablet - below lg) --}}
    <div class="mobile-footer">
        @include('partials.mobile-footer')
    </div>
    
    {{-- Mobile Bottom Navigation (visible only on mobile/tablet - below lg) --}}
    <nav class="mobile-bottom-nav">
        @include('partials.mobile-bottom-nav-simple')
    </nav>
    
    @stack('scripts')
    
    <script>
        // Mobile-optimized preloader script
        (function() {
            // Check if mobile
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            
            // Faster removal for mobile
            const removeDelay = isMobile ? 100 : 300;
            const fadeDelay = isMobile ? 200 : 300;
            
            // Function to remove preloader
            function removePreloader() {
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    preloader.classList.add('fade-out');
                    
                    setTimeout(function() {
                        document.body.classList.remove('loading');
                        document.body.classList.add('loaded');
                        preloader.style.display = 'none';
                    }, fadeDelay);
                }
            }
            
            // Remove on DOM ready for mobile
            if (isMobile) {
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', function() {
                        setTimeout(removePreloader, removeDelay);
                    });
                } else {
                    setTimeout(removePreloader, removeDelay);
                }
            } else {
                // Desktop: wait for full load
                window.addEventListener('load', function() {
                    setTimeout(removePreloader, removeDelay);
                });
            }
            
            // Fallback: remove after 800ms max for mobile, 1.5s for desktop
            setTimeout(function() {
                const preloader = document.getElementById('preloader');
                if (preloader && !preloader.classList.contains('fade-out')) {
                    removePreloader();
                }
            }, isMobile ? 800 : 1500);
        })();
    </script>
@include("components.whatsapp-button")
</body>
</html>