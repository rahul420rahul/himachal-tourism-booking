<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBirBilling Mobile Header</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            background: white;
        }
    </style>
</head>
<body x-data="{ mobileMenuOpen: false, searchOpen: false }">

    <div class="bg-red-600 text-white px-4 py-3 text-center">
        <span class="text-sm font-bold">चलें फिर उड़ने - Ready to Fly Higher?</span>
    </div>

    <nav class="bg-white sticky top-0 z-50 border-b border-gray-100" role="navigation" aria-label="Mobile navigation">
        <div class="px-4 py-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3" aria-label="MyBirBilling Home">
                        <img src="{{ asset('storage/image.png') }}" alt="MyBirBilling Logo" class="w-14 h-14 object-contain">
                        <div>
                            <h1 class="text-xl font-bold" style="color: #000;">
                                <span style="color: #dc2626;">My</span><span style="color: #ea580c;">Bir</span><span style="color: #16a34a;">Billing</span>
                            </h1>
                            <p class="text-sm text-gray-600">Ready to Fly</p>
                        </div>
                    </a>
                </div>
                
                <div class="flex items-center space-x-2">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="relative w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center" aria-label="Notifications">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50">
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
                    @else
                        <a href="{{ route('login') }}" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center" aria-label="Login">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </a>
                    @endauth
                    
                    <button @click="searchOpen = !searchOpen" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center" aria-label="Search">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center" aria-label="Menu" :aria-expanded="mobileMenuOpen">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="searchOpen" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="border-t border-gray-100 bg-white p-4" @click.outside="searchOpen = false">
            <div class="relative">
                <input type="search" placeholder="Search packages, services..." class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none">
                <button class="absolute right-3 top-1/2 transform -translate-y-1/2 w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
            <div class="mt-3 flex flex-wrap gap-2">
                <span class="text-sm text-gray-500">Popular:</span>
                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">Tandem</span>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Training</span>
                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-sm">Weekend</span>
            </div>
        </div>
    </nav>

    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform translate-x-full"
         x-transition:enter-end="transform translate-x-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="transform translate-x-0"
         x-transition:leave-end="transform translate-x-full"
         class="fixed top-0 right-0 z-50 w-80 h-full bg-white shadow-xl flex flex-col"
         x-data="{ servicesOpen: false, userOpen: false }"
         @click.outside="mobileMenuOpen = false">

        <div class="p-4 bg-blue-900 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('storage/image.png') }}" alt="MyBirBilling Logo" class="w-10 h-10 object-contain rounded-lg bg-white/10">
                    <div>
                        <h2 class="text-lg font-bold text-white">MyBirBilling</h2>
                        <p class="text-sm text-white/80">Ready to Fly</p>
                    </div>
                </div>
                <button @click="mobileMenuOpen = false" class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="p-4 bg-blue-50 border-b">
            <div class="space-y-2 text-sm">
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <span class="text-green-600 font-semibold">Flying Season Active</span>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-slate-600">Open: 9:00 AM - 6:00 PM</span>
                </div>
            </div>
        </div>

        <div class="p-4 space-y-2 overflow-y-auto flex-grow">
            @auth
                <div x-data="{ userOpen: false }">
                    <button @click="userOpen = !userOpen" class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-circle text-blue-600"></i>
                            </div>
                            <div class="text-left">
                                <p class="font-semibold text-slate-900">My Account</p>
                                <p class="text-sm text-slate-500">Dashboard & Settings</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': userOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="userOpen" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="ml-4 mt-2 space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-home w-5 text-gray-600"></i>
                            <span class="text-slate-700">My Dashboard</span>
                        </a>
                        <a href="{{ route('bookings.my') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-ticket-alt w-5 text-gray-600"></i>
                            <span class="text-slate-700">My Bookings</span>
                        </a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-cog w-5 text-gray-600"></i>
                                <span class="text-slate-700">Admin Panel</span>
                            </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-user-cog w-5 text-gray-600"></i>
                            <span class="text-slate-700">Profile Settings</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center space-x-3 p-2 w-full text-left rounded-lg hover:bg-red-50 text-red-600">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="border-t my-4"></div>
            @else
                <a href="{{ route('login') }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50">
                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-sign-in-alt text-gray-600"></i>
                    </div>
                    <p class="font-semibold text-slate-900">Login</p>
                </a>
                <a href="{{ route('register') }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-plus text-blue-600"></i>
                    </div>
                    <p class="font-semibold text-slate-900">Sign Up</p>
                </a>
                <div class="border-t my-4"></div>
            @endauth
            
            <a href="{{ route('home') }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <p class="font-semibold text-slate-900">Home</p>
            </a>
            
            <a href="{{ route('packages.index') }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50">
                <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <p class="font-semibold text-slate-900">Packages</p>
            </a>
            
            <div>
                <button @click="servicesOpen = !servicesOpen" class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-50">
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                        <p class="font-semibold text-slate-900">Services</p>
                    </div>
                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': servicesOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="servicesOpen" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="ml-4 mt-2 space-y-1">
                    <a href="{{ route('services.tandem') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <span class="text-slate-700">Tandem Flights</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                        <span class="text-slate-700">Acro Flights</span>
                    </a>
                    <a href="{{ route('services.training') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-slate-700">Training</span>
                    </a>
                    <a href="{{ route('services.rental') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50">
                        <div class="w-2 h-2 bg-slate-500 rounded-full"></div>
                        <span class="text-slate-700">Equipment</span>
                    </a>
                </div>
            </div>
            
            <a href="{{ route('gallery') }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50">
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="font-semibold text-slate-900">Gallery</p>
            </a>
            
            <a href="{{ route('contact') }}" class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50">
                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <p class="font-semibold text-slate-900">Contact</p>
            </a>
        </div>
    </div>
</body>
</html>