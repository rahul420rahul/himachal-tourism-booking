<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBirBilling Header</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
        }
        .nav-scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }
        body {
            -webkit-font-smoothing: subpixel-antialiased;
            -moz-osx-font-smoothing: auto;
        }
        .force-dark-text * {
            color: #000000 !important;
            -webkit-text-fill-color: #000000 !important;
        }
        @media (max-width: 1023px) {
            .desktop-header {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="desktop-header">
        <nav
            class="bg-white/95 backdrop-blur-2xl sticky top-0 z-50 transition-all duration-300 border-b border-gray-100/50 shadow-sm"
            x-data="{
                scrolled: false,
                searchOpen: false,
                servicesDropdown: false,
                notificationOpen: false,
                userOpen: false
            }"
            @scroll.window.debounce.100ms="scrolled = window.pageYOffset > 50"
            :class="{
                'shadow-lg bg-white/98 border-b-2 border-gradient-to-r from-blue-200 to-indigo-200': scrolled,
                'bg-gradient-to-r from-white via-blue-50/20 to-white': !scrolled
            }"
            role="navigation"
            aria-label="Main navigation">

            <div class="hidden lg:block bg-red-600 text-white py-3 px-6 lg:px-12 relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN...')] opacity-10"></div>
                <div class="flex justify-between items-center text-sm font-bold text-white relative z-10">
                    <div class="flex items-center space-x-8 lg:space-x-12">
                        <div class="flex items-center space-x-2 group">
                            <div class="w-5 h-5 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition-all duration-300">
                                <svg class="w-3.5 h-3.5 text-green-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                            </div>
                            <a href="https://wa.me/919736696260" class="hover:text-green-300 transition-colors duration-300">WhatsApp: +91 97366 96260</a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-5 h-5 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-white/20 transition-all duration-300">
                                <svg class="w-3.5 h-3.5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span>Open: 9:00 AM - 6:00 PM</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </span>
                            <span class="text-green-400 font-semibold">Flying Season Active</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <span class="text-sm font-bold text-white tracking-wide">चलें फिर उड़ने - Ready to Fly Higher?</span>
                    </div>
                    <div class="flex items-center space-x-8 lg:space-x-12">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:+919736696260" class="hover:text-orange-300 transition-colors duration-300">Emergency: +91 97366 96260</a>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="https://www.instagram.com" target="_blank" class="w-6 h-6 bg-white/10 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-500 transition-all duration-300 hover:scale-110" aria-label="Instagram">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
                                </svg>
                            </a>
                            <a href="https://www.facebook.com" target="_blank" class="w-6 h-6 bg-white/10 rounded-full flex items-center justify-center hover:bg-blue-600 transition-all duration-300 hover:scale-110" aria-label="Facebook">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://youtube.com" target="_blank" class="w-6 h-6 bg-white/10 rounded-full flex items-center justify-center hover:bg-red-600 transition-all duration-300 hover:scale-110" aria-label="YouTube">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 sm:px-6 lg:px-12">
                <div class="flex justify-between items-center h-16 lg:h-20">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3 group" aria-label="MyBirBilling Home">
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl blur-xl opacity-0 group-hover:opacity-30 transition-all duration-400"></div>
                                <img src="{{ asset('storage/image.png') }}" alt="MyBirBilling Logo" class="w-16 h-16 lg:w-20 lg:h-20 object-contain drop-shadow-xl group-hover:scale-110 transition-transform duration-400" loading="lazy">
                            </div>
                            <div class="hidden sm:block">
                                <h1 class="text-3xl lg:text-4xl font-black force-dark-text">
                                    <span class="text-red-600">My</span><span class="text-orange-500">Bir</span><span class="text-green-600">Billing</span>
                                </h1>
                            </div>
                        </a>
                    </div>
                    
                    <div class="hidden lg:flex items-center space-x-8 xl:space-x-12">
                        @php
                            $navLinks = [
                                ['route' => 'home', 'label' => 'Home', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                                ['route' => 'packages.index', 'label' => 'Packages', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                                ['route' => 'gallery', 'label' => 'Gallery', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                ['route' => 'contact', 'label' => 'Contact', 'icon' => 'M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                            ];
                        @endphp
                        
                        @foreach ($navLinks as $link)
                            <a href="{{ route($link['route']) }}"
                                class="relative text-gray-600 hover:text-blue-600 font-semibold text-sm transition-all duration-300 group {{ request()->routeIs($link['route'] . '*') ? 'text-blue-600' : '' }}">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/>
                                    </svg>
                                    <span>{{ $link['label'] }}</span>
                                </span>
                                <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-gradient-to-r from-blue-600 to-indigo-700 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 {{ request()->routeIs($link['route'] . '*') ? 'scale-x-100' : '' }}"></span>
                            </a>
                        @endforeach
                        
                        <div class="relative group" x-data="{ servicesOpen: false }" @mouseenter="servicesOpen = true" @mouseleave="servicesOpen = false">
                            </div>
                    </div>
                    
                    <div class="hidden lg:flex items-center space-x-4">
                        <button @click="searchOpen = !searchOpen" class="w-10 h-10 bg-gray-100 hover:bg-blue-100 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                        
                        @auth
                            <div class="flex items-center space-x-4">
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="relative w-10 h-10 bg-gray-100 hover:bg-yellow-100 rounded-full flex items-center justify-center transition-all duration-300">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                                    </button>
                                    <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50">
                                        <div class="px-4 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                                            <h3 class="font-semibold">Notifications</h3>
                                        </div>
                                        <div class="max-h-64 overflow-y-auto">
                                            <a href="#" class="block px-4 py-3 hover:bg-blue-50 transition border-b">
                                                <p class="text-sm font-medium text-gray-900">New booking confirmed!</p>
                                                <p class="text-xs text-gray-500">Your tandem flight is scheduled for tomorrow</p>
                                                <p class="text-xs text-blue-600 mt-1">2 hours ago</p>
                                            </a>
                                            <a href="#" class="block px-4 py-3 hover:bg-blue-50 transition">
                                                <p class="text-sm font-medium text-gray-900">Weather update</p>
                                                <p class="text-xs text-gray-500">Perfect conditions for flying tomorrow</p>
                                                <p class="text-xs text-blue-600 mt-1">5 hours ago</p>
                                            </a>
                                        </div>
                                        <a href="#" class="block px-4 py-2 text-center text-sm text-blue-600 hover:text-blue-700 border-t bg-gray-50">
                                            View all notifications
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center space-x-3 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl hover:shadow-lg transition-all duration-300">
                                        <div class="w-8 h-8 bg-white/20 backdrop-blur rounded-full flex items-center justify-center font-bold">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium">{{ Auth::user()->name }}</span>
                                        <svg class="w-4 h-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50">
                                        <div class="px-4 py-3 bg-gradient-to-r from-gray-50 to-gray-100 border-b">
                                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                        </div>
                                        <div class="py-2">
                                            @if(Auth::user()->role === 'admin')
                                                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                                                    <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                                                    Admin Dashboard
                                                </a>
                                                <a href="{{ route('admin') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                                    <i class="fas fa-cog w-5 mr-3"></i>
                                                    Admin Panel
                                                </a>
                                            @else
                                                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                                    <i class="fas fa-home w-5 mr-3"></i>
                                                    My Dashboard
                                                </a>
                                            @endif
                                            <a href="{{ route('bookings.my') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition">
                                                <i class="fas fa-ticket-alt w-5 mr-3"></i>
                                                My Bookings
                                            </a>
                                            <a href="{{ route('dashboard.flight-logs') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                                <i class="fas fa-plane w-5 mr-3"></i>
                                                Flight Logs
                                            </a>
                                            <a href="{{ route('dashboard.certificates') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                                <i class="fas fa-certificate w-5 mr-3"></i>
                                                My Certificates
                                            </a>
                                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                                                <i class="fas fa-user-cog w-5 mr-3"></i>
                                                Profile Settings
                                            </a>
                                        </div>
                                        <div class="border-t pt-2 pb-2">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                                                    <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-semibold text-base transition-colors duration-300">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                                <span>Sign Up</span>
                            </a>
                        @endauth
                    </div>

                    <div x-data="{ mobileMenuOpen: false }" class="lg:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2.5 rounded-xl bg-gray-100 hover:bg-blue-100 transition-all duration-300">
                            <svg x-show="!mobileMenuOpen" class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg x-show="mobileMenuOpen" class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            </nav>
    </div>
</body>
</html>