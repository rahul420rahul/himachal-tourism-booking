<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyBirBilling') }} - @yield('title', 'Paragliding Adventures')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/booking-app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        @media (max-width: 1024px) {
            body {
                padding-top: 64px;
                padding-bottom: 70px;
            }
        }
    </style>
    @stack('styles')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ mobileMenuOpen: false }">
    
    <!-- Navigation -->
    </div>
    @include('partials.header')
    
    <!-- Hero Section -->
    @hasSection('hero')
        <section class="hero-section">
            @yield('hero')
        </section>
    @endif
    
    <!-- Main Content -->
    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>
    
    <!-- Footer Desktop -->
    <footer class="hidden lg:block">
        @include('partials.footer')
    </footer>
    
    <!-- Mobile Bottom Navigation -->
    
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
    
    @stack('scripts')
    <!-- React Booking Container -->
    <div id="react-booking-container"></div>
    <div id="booking-modal-container"></div>
    @vite(["resources/js/booking-modal.js"])
</body>
</html>
