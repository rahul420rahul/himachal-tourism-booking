<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyBirBilling') }} - @yield('title', 'Paragliding Adventures')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <style>
        [x-cloak] { display: none !important; }
        
        /* Mobile specific styles - FIXED */
        @media (max-width: 1024px) {
            body {
                padding-top: 0 !important; /* Remove top padding */
                padding-bottom: 64px !important; /* Keep bottom padding for bottom nav */
            }
            
            /* Add padding only to content sections, not hero */
            main > section:not(.hero-section) {
                padding-top: 56px;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50">
    
    <!-- Desktop Navigation (Hidden on mobile) -->
    @include('partials.header')
    
    <!-- Mobile Top Bar with Menu Button (Sky Trekkers Style) -->
    @include('partials.mobile-nav')
    
    <!-- Mobile Slide Menu (Your existing menu) -->
    @include('partials.mobile-menu')
    
    <!-- Hero Section (No padding on mobile) -->
    @hasSection('hero')
        <section class="hero-section">
            @yield('hero')
        </section>
    @endif
    
    <!-- Main Content -->
    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    @stack('scripts')
</body>
</html>
