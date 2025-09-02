<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::check() ? Auth::id() : '' }}">
    <style>
        /* Optimized Preloader with Modern Gradient Background */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Modern sunset gradient - orange to pink */
            background: linear-gradient(135deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%);
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
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }
        
        /* Large centered logo */
        .preloader-logo {
            width: 250px;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .preloader-logo img {
            width: 230px;
            height: 230px;
            object-fit: contain;
            /* No animation - logo stays still */
        }
        
        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .preloader-logo {
                width: 200px;
                height: 200px;
            }
            
            .preloader-logo img {
                width: 180px;
                height: 180px;
            }
        }
        
        @media (max-width: 480px) {
            .preloader-logo {
                width: 170px;
                height: 170px;
            }
            
            .preloader-logo img {
                width: 150px;
                height: 150px;
            }
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
        .desktop-footer {
            display: none !important;
        }
        
        @media (min-width: 1024px) {
            .desktop-footer {
                display: block !important;
            }
        }
        
        .mobile-footer {
            display: block !important;
        }
        
        @media (min-width: 1024px) {
            .mobile-footer {
                display: none !important;
            }
        }
        
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
        
        @media (max-width: 1023px) {
            body {
                padding-bottom: 64px;
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
<style>
    [x-cloak] { display: none !important; }
    .nav-transition {
        transition: all 0.3s ease;
    }
</style>
@stack('styles')
</head>
<body class="font-sans antialiased bg-dark-50 loading">
    {{-- Optimized Preloader with only Logo --}}
    <div class="preloader" id="preloader">
        <div class="preloader-content">
            {{-- Only Logo - Centered and Large --}}
            <div class="preloader-logo">
                <img src="{{ asset('storage/image.png') }}" alt="MyBirBilling Logo" loading="eager">
            </div>
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
            const removeDelay = isMobile ? 500 : 800;
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
            
            // Remove on DOM ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(removePreloader, removeDelay);
                });
            } else {
                setTimeout(removePreloader, removeDelay);
            }
            
            // Fallback: remove after max time
            setTimeout(function() {
                const preloader = document.getElementById('preloader');
                if (preloader && !preloader.classList.contains('fade-out')) {
                    removePreloader();
                }
            }, isMobile ? 1000 : 2000);
        })();
    </script>
@include("components.whatsapp-button")
</body>
</html>