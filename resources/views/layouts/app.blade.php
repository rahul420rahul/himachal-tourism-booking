<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'MyBirBilling') }} - {{ $title ?? 'Himachal Pradesh Tourism' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
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
 <!-- Footer -->
<footer class="bg-gray-900  from-green-900 to-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            
            <!-- Company Info -->
            <div class="lg:col-span-2">
                <h3 class="text-3xl font-bold mb-6 text-yellow-400 drop-shadow-md">MyBirBilling</h3>
                <p class="text-gray-300 mb-6 leading-relaxed text-lg">
                    Soar high in Bir Billing—the Paragliding Capital of India! We offer thrilling tandem flights, 
                    expert training, and curated adventure packages amidst the stunning Himachal valleys.
                </p>
                <div class="space-y-3">
                    <p class="text-gray-300 text-lg">
                        <span class="font-semibold text-yellow-300">✈️ "Chalo milte h hawa mein!"</span> 
                        - Join us for an epic flying adventure!
                    </p>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-xl font-semibold mb-6 text-yellow-400 border-b-2 border-yellow-400 pb-2">Quick Links</h4>
                <ul class="space-y-4">
                    <li>
                        <a href="/" class="text-gray-300 hover:text-yellow-300 transition-colors flex items-center group">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-yellow-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/services" class="text-gray-300 hover:text-yellow-300 transition-colors flex items-center group">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-yellow-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-6m0 0l5 6m-5-6v18"></path>
                            </svg>
                            Our Services
                        </a>
                    </li>
                    <li>
                        <a href="/packages" class="text-gray-300 hover:text-yellow-300 transition-colors flex items-center group">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-yellow-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Packages
                        </a>
                    </li>
                    <li>
                        <a href="/gallery" class="text-gray-300 hover:text-yellow-300 transition-colors flex items-center group">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-yellow-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Gallery
                        </a>
                    </li>
                    <li>
                        <a href="/contact" class="text-gray-300 hover:text-yellow-300 transition-colors flex items-center group">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-yellow-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Contact Us
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-xl font-semibold mb-6 text-yellow-400 border-b-2 border-yellow-400 pb-2">Contact Info</h4>
                <div class="space-y-5">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-yellow-400 mr-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="text-gray-300">Bir Billing</p>
                            <p class="text-gray-400 text-base">Himachal Pradesh, India</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-yellow-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <a href="tel:+919736696260" class="text-gray-300 hover:text-yellow-300 transition-colors text-base">
                            +91 97366 96260
                        </a>
                    </div>

                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-400 mr-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <a href="https://wa.me/919736696260" target="_blank" class="text-gray-300 hover:text-green-400 transition-colors text-base">
                            WhatsApp: +91 97366 96260
                        </a>
                    </div>

                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-yellow-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <a href="mailto:chamelthakur280@gmail.com" class="text-gray-300 hover:text-yellow-300 transition-colors text-base">
                            chamelthakur280@gmail.com
                        </a>
                    </div>

                    <!-- Social Media -->
                    <div class="mt-6">
                        <h5 class="text-lg font-semibold mb-4 text-yellow-400">Follow Us</h5>
                        <div class="flex space-x-5">
                            <a href="https://www.instagram.com/reel/DLOhue4zzwx/?igsh=MWl1cGR1NW9sbHE0NA==" 
                               target="_blank" 
                               class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center hover:shadow-xl transition-all duration-300 hover:scale-110">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/share/r/1JcWrm9cYn/" 
                               target="_blank" 
                               class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 hover:shadow-xl transition-all duration-300 hover:scale-110">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://youtube.com/shorts/8Qz8MQXP4Fs?si=KAx3VgBO3_dNcLYt" 
                               target="_blank" 
                               class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 hover:shadow-xl transition-all duration-300 hover:scale-110">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="mt-10 pt-8 border-t border-gray-700/50 flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-400 text-base mb-4 md:mb-0">
                © 2025 MyBirBilling. All rights reserved. | 
                <span class="text-yellow-400">Paragliding Capital of India</span>
            </div>
            
            <div class="flex space-x-6 text-base text-gray-400">
                <a href="/privacy" class="hover:text-yellow-400 transition-colors">Privacy Policy</a>
                <a href="/terms" class="hover:text-yellow-400 transition-colors">Terms & Conditions</a>
                <a href="/safety" class="hover:text-yellow-400 transition-colors">Safety Guidelines</a>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div class="mt-6 p-5 bg-red-900/30 border border-red-500/50 rounded-lg shadow-md">
            <div class="flex items-center justify-center text-center">
                <svg class="w-6 h-6 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div>
                    <p class="text-red-400 font-semibold text-lg">Emergency Contact: +91 97366 96260</p>
                    <p class="text-gray-400 text-base">24/7 Support for Safety & Assistance</p>
                </div>
            </div>
        </div>
    </div>
</footer>
    
    <!-- Load Scripts at Bottom -->
    <!-- jQuery (Required for AJAX calls) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Initialize AOS
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 1000,
                    once: true
                });
            }
        });
        
        // Weather Widget
        function loadWeatherWidget() {
            fetch('/weather/Billing')
                .then(response => response.json())
                .then(data => {
                    if (!data.error) {
                        const weatherElement = document.getElementById('weather-widget');
                        if (weatherElement) {
                            weatherElement.innerHTML = `
                                <div class="bg-blue-600 rounded-lg p-3">
                                    <div class="text-white text-center">
                                        <div class="text-lg font-semibold">${data.city}</div>
                                        <div class="text-2xl">${Math.round(data.temperature)}°C</div>
                                        <div class="text-sm capitalize">${data.description}</div>
                                    </div>
                                </div>
                            `;
                        }
                    }
                })
                .catch(error => {
                    console.log('Weather data unavailable');
                    const weatherElement = document.getElementById('weather-widget');
                    if (weatherElement) {
                        weatherElement.innerHTML = '<div class="text-gray-400 text-sm">Weather unavailable</div>';
                    }
                });
        }
        
        // Load weather when DOM is ready
        document.addEventListener('DOMContentLoaded', loadWeatherWidget);
        
        // Global Razorpay configuration
        window.razorpayConfig = {
            key: '{{ config("services.razorpay.key") }}',
            currency: 'INR',
            name: 'MyBirBilling',
            description: 'Himachal Pradesh Tourism Package',
            theme: {
                color: '#3B82F6'
            }
        };
        
        // Console error filtering for cleaner development experience
        (function() {
            const originalError = console.error;
            const originalWarn = console.warn;
            
            console.error = function(...args) {
                const message = args.join(' ');
                // Filter out known Razorpay/browser feature warnings
                if (message.includes('Feature Policy') || 
                    message.includes('otp-credentials') || 
                    message.includes('clipboard-write') ||
                    message.includes('Permissions Policy') ||
                    message.includes('payment') && message.includes('third-party')) {
                    return; // Suppress these warnings
                }
                originalError.apply(console, args);
            };
            
            console.warn = function(...args) {
                const message = args.join(' ');
                if (message.includes('Feature Policy') || 
                    message.includes('third party context') ||
                    message.includes('Permissions Policy')) {
                    return; // Suppress these warnings
                }
                originalWarn.apply(console, args);
            };
        })();
        
        // Global CSRF setup for jQuery AJAX
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    
    <!-- Page-specific scripts -->
    @stack('scripts')
</body>
</html>
