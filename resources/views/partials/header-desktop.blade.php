<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBirBilling Header - Wheat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
/* Wheat color styles */
.bg-wheat {
    background-color: #F5DEB3;
}
.bg-wheat-light {
    background-color: #FDF5E6;
}
.bg-wheat-dark {
    background-color: #DEB887;
}
</style>
</head>
<body>
    <div class="desktop-header">
        <nav class="bg-wheat sticky top-0 z-50 transition-all duration-300 border-b border-amber-300 shadow-md"
            x-data="{
                scrolled: false,
                searchOpen: false,
                servicesDropdown: false,
                notificationOpen: false,
                userOpen: false
            }">

            <!-- Top Bar -->
            <div class="hidden lg:block bg-red-600 text-white py-3 px-6 lg:px-12">
                <div class="flex justify-between items-center text-sm font-bold text-white">
                    <div class="flex items-center space-x-8">
                        <a href="https://wa.me/919736696260" class="hover:text-green-300">
                            <i class="fab fa-whatsapp mr-2"></i>WhatsApp: +91 97366 96260
                        </a>
                        <span><i class="far fa-clock mr-2"></i>Open: 9:00 AM - 6:00 PM</span>
                        <span class="text-green-400"><i class="fas fa-circle text-green-500 mr-2"></i>Flying Season Active</span>
                    </div>
                    <div class="text-center">
                        <span>चलें फिर उड़ने - Ready to Fly Higher?</span>
                    </div>
                    <div class="flex items-center space-x-8">
                        <a href="tel:+919736696260" class="hover:text-orange-300">
                            <i class="fas fa-phone mr-2"></i>Emergency: +91 97366 96260
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Navigation -->
            <div class="px-4 sm:px-6 lg:px-12 bg-wheat-light">
                <div class="flex justify-between items-center h-20 lg:h-24">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center group">
                            <img src="{{ asset('storage/image.png') }}" 
                                 alt="MyBirBilling Logo" 
                                 class="w-24 h-24 lg:w-32 lg:h-32 object-contain drop-shadow-lg group-hover:scale-110 transition-transform duration-400">
                        </a>
                    </div>
                    
                    <!-- Nav Links -->
                    <div class="hidden lg:flex items-center space-x-8 xl:space-x-12">
                        <a href="{{ route('home') }}" class="text-black hover:text-gray-900 font-semibold">
                            <i class="fas fa-home mr-2"></i>Home
                        </a>
                        <a href="{{ route('packages.index') }}" class="text-black hover:text-gray-900 font-semibold">
                            <i class="fas fa-box mr-2"></i>Packages
                        </a>
                        
                        <!-- Services Dropdown -->
                        <div class="relative" x-data="{ servicesOpen: false }" @mouseenter="servicesOpen = true" @mouseleave="servicesOpen = false">
                            <button class="text-black hover:text-gray-900 font-semibold flex items-center">
                                <i class="fas fa-concierge-bell mr-2"></i>Services
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="servicesOpen" x-transition class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl z-50">
                                <a href="{{ route('services.tandem') }}" class="block px-4 py-3 hover:bg-wheat-light">
                                    <i class="fas fa-parachute-box mr-2"></i>Tandem Flights
                                </a>
                                <a href="{{ route('services.training') }}" class="block px-4 py-3 hover:bg-wheat-light">
                                    <i class="fas fa-graduation-cap mr-2"></i>Training Courses
                                </a>
                                <a href="{{ route('services.rental') }}" class="block px-4 py-3 hover:bg-wheat-light">
                                    <i class="fas fa-toolbox mr-2"></i>Equipment Rental
                                </a>
                            </div>
                        </div>
                        
                        <a href="{{ route('gallery') }}" class="text-black hover:text-gray-900 font-semibold">
                            <i class="fas fa-images mr-2"></i>Gallery
                        </a>
                        <a href="{{ route('contact') }}" class="text-black hover:text-gray-900 font-semibold">
                            <i class="fas fa-envelope mr-2"></i>Contact
                        </a>
                    </div>
                    
                    <!-- Right Side Actions -->
                    <div class="hidden lg:flex items-center space-x-4">
                        <!-- Search Button -->
                        <button @click="searchOpen = !searchOpen" class="w-10 h-10 bg-wheat hover:bg-wheat-dark rounded-full flex items-center justify-center">
                            <i class="fas fa-search text-black"></i>
                        </button>
                        
                        @auth
                            <!-- Notifications -->
                            <div class="relative" x-data="{ notificationOpen: false }">
                                <button @click="notificationOpen = !notificationOpen" class="w-10 h-10 bg-wheat hover:bg-wheat-dark rounded-full flex items-center justify-center relative">
                                    <i class="fas fa-bell text-black"></i>
                                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                                </button>
                                <div x-show="notificationOpen" @click.outside="notificationOpen = false" x-transition 
                                     class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50">
                                    <div class="p-4 bg-gradient-to-r from-gray-800 to-black text-white rounded-t-lg">
                                        <h3 class="font-bold">Notifications</h3>
                                    </div>
                                    <div class="max-h-64 overflow-y-auto">
                                        <a href="#" class="block p-4 hover:bg-wheat-light border-b">
                                            <p class="font-semibold">New booking confirmed!</p>
                                            <p class="text-sm text-gray-600">Your tandem flight is scheduled</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ userOpen: false }">
                                <button @click="userOpen = !userOpen" class="flex items-center space-x-2 px-4 py-2 bg-wheat hover:bg-wheat-dark rounded-lg">
                                    <i class="fas fa-user-circle text-xl text-black"></i>
                                    <span class="text-black font-semibold">{{ Auth::user()->name ?? 'User' }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                
                                <div x-show="userOpen" @click.outside="userOpen = false" x-transition
                                     class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl z-50">
                                    <div class="p-4 bg-gradient-to-r from-wheat to-wheat-dark rounded-t-lg">
                                        <p class="font-bold text-black">{{ Auth::user()->name ?? 'User' }}</p>
                                        <p class="text-sm text-gray-700">{{ Auth::user()->email ?? '' }}</p>
                                    </div>
                                    
                                    <div class="py-2">
                                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-wheat-light">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </a>
                                        <a href="{{ route('bookings.my') }}" class="block px-4 py-2 hover:bg-wheat-light">
                                            <i class="fas fa-ticket-alt mr-2"></i>My Bookings
                                        </a>
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-wheat-light">
                                            <i class="fas fa-user-cog mr-2"></i>Profile Settings
                                        </a>
                                        
                                        @if(Auth::user()->role === 'admin')
                                        <a href="/admin" class="block px-4 py-2 hover:bg-wheat-light">
                                            <i class="fas fa-cogs mr-2"></i>Admin Panel
                                        </a>
                                        @endif
                                        
                                        <div class="border-t my-2"></div>
                                        
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-red-50 text-red-600">
                                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-black hover:text-gray-900 font-semibold">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-gray-800 to-black text-white font-semibold rounded-xl">
                                <i class="fas fa-user-plus mr-2"></i>Sign Up
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            
            <!-- Search Bar -->
            <div x-show="searchOpen" x-transition class="border-t border-wheat-dark bg-wheat-light p-4">
                <div class="max-w-3xl mx-auto">
                    <input type="search" placeholder="Search packages, services..." 
                           class="w-full px-4 py-3 bg-white rounded-lg border border-wheat-dark focus:outline-none focus:border-black">
                </div>
            </div>
        </nav>
    </div>
</body>
</html>
