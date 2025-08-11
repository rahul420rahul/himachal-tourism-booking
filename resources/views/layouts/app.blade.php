

	<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Security Headers for Razorpay (Fixed) -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://checkout.razorpay.com https://cdn.jsdelivr.net https://unpkg.com; style-src 'self' 'unsafe-inline' https://checkout.razorpay.com https://fonts.bunny.net https://unpkg.com; img-src 'self' data: https: blob:; connect-src 'self' https://api.razorpay.com https://checkout.razorpay.com; frame-src 'self' https://api.razorpay.com https://checkout.razorpay.com; font-src 'self' https://fonts.bunny.net data:; media-src 'self' data: blob:;">
    
    <!-- Permissions Policy for Razorpay features (Fixed) -->
    <meta http-equiv="Permissions-Policy" content="payment=*, clipboard-write=*, camera=*, microphone=*, geolocation=*">
    
    <title>{{ config('app.name', 'MyBirBilling') }} - {{ $title ?? 'Himachal Pradesh Tourism' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Vite Assets (Load First) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    
    <!-- Razorpay Script (Fixed - NO integrity hash) -->
    <script 
        src="https://checkout.razorpay.com/v1/checkout.js"
        crossorigin="anonymous"
        referrerpolicy="origin"
        onload="console.log('Razorpay loaded successfully')"
        onerror="console.error('Razorpay failed to load')"
    ></script>
    
    <!-- Razorpay Configuration -->
    <script>
        window.razorpayConfig = {
            key: '{{ config("services.razorpay.key") }}',
            currency: 'INR',
            name: 'MyBirBilling',
            description: 'Himachal Pradesh Tourism Package',
            image: '/images/logo.png', // Add your logo path
        };
    </script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <span class="text-2xl font-bold text-blue-600">MyBirBilling</span>
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition">Home</a>
                        <a href="{{ route('packages.index') }}" class="text-gray-700 hover:text-blue-600 transition">Packages</a>
                        
                        @auth
                            <a href="{{ route('bookings.my') }}" class="text-gray-700 hover:text-blue-600 transition">My Bookings</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-blue-600 transition">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Main Content -->
        <main>
            {{ $slot ?? '' }}
            @yield('content')
        </main>
        
        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold mb-4">MyBirBilling</h3>
                        <p class="text-gray-300">Discover the beauty of Himachal Pradesh with our expertly crafted tour packages.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-gray-300">
                            <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                            <li><a href="{{ route('packages.index') }}" class="hover:text-white transition">Packages</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Contact Info</h4>
                        <ul class="space-y-2 text-gray-300">
                            <li>📞 +91 98765 43210</li>
                            <li>✉️ info@mybirbilling.com</li>
                            <li>📍 Billing, Himachal Pradesh</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-4">Weather Widget</h4>
                        <div id="weather-widget" class="text-sm"></div>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                    <p>&copy; 2025 MyBirBilling. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Custom Scripts -->
    <script>
        // Set global error handler for Razorpay
        window.addEventListener('error', function(e) {
            if (e.message.includes('razorpay') || e.message.includes('checkout')) {
                console.log('Razorpay error handled:', e.message);
                e.preventDefault(); // Prevent console spam
            }
        });
        
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });
        
        // Weather Widget
        fetch('/weather/Billing')
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    document.getElementById('weather-widget').innerHTML = `
                        <div class="bg-blue-600 rounded-lg p-3">
                            <div class="text-white text-center">
                                <div class="text-lg font-semibold">${data.city}</div>
                                <div class="text-2xl">${Math.round(data.temperature)}°C</div>
                                <div class="text-sm capitalize">${data.description}</div>
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => console.log('Weather data unavailable'));
            
        // Razorpay error suppression
        const originalConsoleError = console.error;
        console.error = function(...args) {
            const message = args.join(' ');
            if (message.includes('Feature Policy') || 
                message.includes('otp-credentials') || 
                message.includes('clipboard-write') ||
                message.includes('payment') ||
                message.includes('onComplete')) {
                // Suppress these specific Razorpay warnings
                return;
            }
            originalConsoleError.apply(console, args);
        };
        
        const originalConsoleWarn = console.warn;
        console.warn = function(...args) {
            const message = args.join(' ');
            if (message.includes('Feature Policy') || 
                message.includes('third party context')) {
                return;
            }
            originalConsoleWarn.apply(console, args);
        };
    </script>
</body>
</html>