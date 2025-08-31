<div class="flex justify-around items-center h-16">
    {{-- Home --}}
    <a href="{{ route('home') }}" 
       class="flex flex-col items-center justify-center flex-1 py-2 px-1 nav-transition
              {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span class="text-xs mt-1">Home</span>
    </a>
    
    {{-- Packages --}}
    <a href="{{ route('packages.index') }}" 
       class="flex flex-col items-center justify-center flex-1 py-2 px-1 nav-transition
              {{ request()->routeIs('packages.*') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
        </svg>
        <span class="text-xs mt-1">Packages</span>
    </a>
    
    {{-- Book Now (Center - Prominent) --}}
    <a href="{{ route('booking.react') }}" 
       class="flex flex-col items-center justify-center flex-1 relative">
        <div class="absolute -top-4 bg-blue-600 text-white rounded-full p-3 shadow-lg nav-transition hover:bg-blue-700 hover:scale-110">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <span class="text-xs mt-8 font-semibold text-blue-600">Book</span>
    </a>
    
    @auth
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" 
           class="flex flex-col items-center justify-center flex-1 py-2 px-1 nav-transition
                  {{ request()->routeIs('dashboard*') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
            </svg>
            <span class="text-xs mt-1">Dashboard</span>
        </a>
    @else
        {{-- Login --}}
        <a href="{{ route('login') }}" 
           class="flex flex-col items-center justify-center flex-1 py-2 px-1 nav-transition
                  {{ request()->routeIs('login') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            <span class="text-xs mt-1">Login</span>
        </a>
    @endauth
    
    {{-- Menu with Dropdown --}}
    <div x-data="{ open: false }" class="flex-1 relative">
        <button @click="open = !open" 
                class="flex flex-col items-center justify-center w-full py-2 px-1 nav-transition
                       {{ request()->routeIs('services.*', 'about', 'contact', 'gallery') ? 'text-blue-600' : 'text-gray-500 hover:text-blue-600' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <span class="text-xs mt-1">Menu</span>
        </button>
        
        {{-- Dropdown Menu --}}
        <div x-show="open" 
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="absolute bottom-full right-0 mb-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden"
             x-cloak>
            
            <div class="py-2">
                {{-- Services Section --}}
                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase">Services</div>
                <a href="{{ route('services.tandem') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Tandem Flights
                </a>
                <a href="{{ route('services.training') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Training Courses
                </a>
                <a href="{{ route('services.rental') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Equipment Rental
                </a>
                <a href="{{ route('services.photography') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Photography
                </a>
                
                <hr class="my-2 border-gray-200">
                
                {{-- Info Section --}}
                <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    About Us
                </a>
                <a href="{{ route('gallery') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Gallery
                </a>
                <a href="{{ route('contact') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Contact
                </a>
                <a href="{{ route('safety') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Safety Info
                </a>
                
                @auth
                    <hr class="my-2 border-gray-200">
                    
                    {{-- User Section --}}
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        My Profile
                    </a>
                    <a href="{{ route('bookings.my') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        My Bookings
                    </a>
                    <a href="{{ route('invoices.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Invoices
                    </a>
                    
                    {{-- Logout --}}
                    <form method="POST" action="{{ route('logout') }}" class="px-4 py-2">
                        @csrf
                        <button type="submit" class="w-full text-left text-sm text-red-600 hover:text-red-800">
                            Logout
                        </button>
                    </form>
                @else
                    <hr class="my-2 border-gray-200">
                    
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-blue-600 hover:bg-gray-100 font-semibold">
                        Sign Up
                    </a>
                @endauth
            </div>
        </div>
    </div>
</div>