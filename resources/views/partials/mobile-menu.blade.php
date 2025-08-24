<!-- Fixed Mobile Menu Component -->
<div class="lg:hidden" 
     x-data="{ mobileMenuOpen: false }" 
     @toggle-mobile-menu.window="mobileMenuOpen = $event.detail.open"
     @keydown.escape.window="mobileMenuOpen = false">
  
  <!-- Overlay -->
  <div x-show="mobileMenuOpen" 
       x-cloak
       x-transition:enter="transition-opacity ease-linear duration-300" 
       x-transition:enter-start="opacity-0" 
       x-transition:enter-end="opacity-100" 
       x-transition:leave="transition-opacity ease-linear duration-300" 
       x-transition:leave-start="opacity-100" 
       x-transition:leave-end="opacity-0" 
       class="fixed inset-0 bg-black bg-opacity-50 z-40" 
       @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })"></div>

  <!-- Mobile Menu Panel -->
  <div x-show="mobileMenuOpen" 
       x-cloak
       x-transition:enter="transition ease-out duration-300" 
       x-transition:enter-start="transform translate-x-full" 
       x-transition:enter-end="transform translate-x-0" 
       x-transition:leave="transition ease-in duration-200" 
       x-transition:leave-start="transform translate-x-0" 
       x-transition:leave-end="transform translate-x-full" 
       class="fixed top-0 right-0 w-80 h-full bg-white shadow-2xl z-50 overflow-y-auto" 
       role="menu" 
       aria-label="Mobile navigation">
    
    <!-- Header -->
    <div class="flex items-center justify-between p-6 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('storage/image.png') }}" alt="MyBirBilling Logo" class="w-12 h-12 object-contain" onerror="this.style.display='none'">
        <div>
          <h2 class="text-lg font-bold">MyBirBilling</h2>
          <p class="text-xs opacity-90">India's #1 Paragliding</p>
        </div>
      </div>
      <button @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })" 
              class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all duration-300" 
              aria-label="Close mobile menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Navigation Links -->
    <div class="p-6 space-y-4">
      <!-- Home -->
      <a href="{{ route('home') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : '' }}" 
         role="menuitem" 
         @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span>Home</span>
      </a>

      <!-- Packages -->
      <a href="{{ route('packages.index') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 {{ request()->routeIs('packages.*') ? 'text-blue-600 bg-blue-50' : '' }}" 
         role="menuitem" 
         @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
        <span>Packages</span>
      </a>

      <!-- Services Accordion -->
      <div x-data="{ servicesOpen: false }" class="relative">
        <button @click="servicesOpen = !servicesOpen" 
                class="w-full flex items-center justify-between px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300" 
                :class="{ 'text-blue-600 bg-blue-50': servicesOpen }" 
                aria-expanded="servicesOpen">
          <div class="flex items-center space-x-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
            </svg>
            <span>Services</span>
          </div>
          <svg class="w-5 h-5 transition-transform duration-300" 
               :class="{ 'rotate-180': servicesOpen }" 
               fill="none" 
               stroke="currentColor" 
               viewBox="0 0 24 24" 
               aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        
        <!-- Services Submenu -->
        <div x-show="servicesOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 transform -translate-y-2" 
             x-transition:enter-end="opacity-100 transform translate-y-0" 
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100 transform translate-y-0" 
             x-transition:leave-end="opacity-0 transform -translate-y-2" 
             class="mt-2 space-y-2 pl-6">
          <a href="{{ route('services.tandem') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             role="menuitem" 
             @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
              </svg>
            </div>
            <span>Tandem Flights</span>
          </a>
          <a href="#" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             role="menuitem" 
             @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <span>Acro Flights</span>
          </a>
          <a href="{{ route('services.training') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             role="menuitem" 
             @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
              </svg>
            </div>
            <span>Basic Course</span>
          </a>
          <a href="#" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             role="menuitem" 
             @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
            <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
              </svg>
            </div>
            <span>Advanced Course</span>
          </a>
          <a href="{{ route('services.rental') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             role="menuitem" 
             @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
            </div>
            <span>Equipment Rental</span>
          </a>
          <a href="{{ route('safety') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             role="menuitem" 
             @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
            <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
              </svg>
            </div>
            <span>Safety Guidelines</span>
          </a>
        </div>
      </div>

      <!-- Gallery -->
      <a href="{{ route('gallery') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 {{ request()->routeIs('gallery') ? 'text-blue-600 bg-blue-50' : '' }}" 
         role="menuitem" 
         @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>Gallery</span>
      </a>

      <!-- Contact -->
      <a href="{{ route('contact') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 {{ request()->routeIs('contact') ? 'text-blue-600 bg-blue-50' : '' }}" 
         role="menuitem" 
         @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        <span>Contact</span>
      </a>

      <!-- Divider -->
      <hr class="border-gray-200">

      <!-- Auth Section -->
      @auth
      <!-- My Bookings -->
      <a href="{{ route('bookings.my') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 rounded-lg hover:shadow-lg transition-all duration-300" 
         role="menuitem" 
         @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <span>My Bookings</span>
      </a>

      <!-- User Account Section -->
      <div x-data="{ userOpen: false }" class="relative">
        <button @click="userOpen = !userOpen" 
                class="w-full flex items-center justify-between px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300" 
                :class="{ 'text-blue-600 bg-blue-50': userOpen }" 
                aria-expanded="userOpen">
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center ring-2 ring-white shadow-lg">
              <span class="text-white text-base font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
            </div>
            <div class="text-left">
              <p class="font-semibold">{{ auth()->user()->name }}</p>
              <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
            </div>
          </div>
          <svg class="w-5 h-5 transition-transform duration-300" 
               :class="{ 'rotate-180': userOpen }" 
               fill="none" 
               stroke="currentColor" 
               viewBox="0 0 24 24" 
               aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        
        <!-- User Submenu -->
        <div x-show="userOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 transform -translate-y-2" 
             x-transition:enter-end="opacity-100 transform translate-y-0" 
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100 transform translate-y-0" 
             x-transition:leave-end="opacity-0 transform -translate-y-2" 
             class="mt-2 space-y-2 pl-6">
          <a href="{{ route('profile.edit') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             role="menuitem" 
             @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span>My Profile</span>
          </a>
          <a href="{{ route('dashboard') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             role="menuitem" 
             @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            <span>Dashboard</span>
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center space-x-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-all duration-300" 
                    role="menuitem">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
              </svg>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>
      @else
      <!-- Login -->
      <a href="{{ route('login') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300" 
         role="menuitem" 
         @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
        </svg>
        <span>Login</span>
      </a>

      <!-- Book Now -->
      <a href="{{ route('register') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg hover:shadow-lg transition-all duration-300" 
         role="menuitem" 
         @click="mobileMenuOpen = false; $dispatch('toggle-mobile-menu', { open: false })">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
        </svg>
        <span>Book Now</span>
      </a>
      @endauth
    </div>

    <!-- Footer Info -->
    <div class="p-6 bg-gray-50 border-t border-gray-200 mt-8">
      <div class="space-y-4">
        <!-- Contact Info -->
        <div class="space-y-3">
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
              </svg>
            </div>
            <a href="https://wa.me/919736696260" class="text-sm font-semibold text-gray-700">WhatsApp: +91 97366 96260</a>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
            </div>
            <a href="tel:+919736696260" class="text-sm font-semibold text-gray-700">Emergency: +91 97366 96260</a>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <span class="text-sm font-semibold text-gray-700">Open: 9:00 AM - 6:00 PM</span>
          </div>
        </div>

        <!-- Social Links -->
        <div class="flex items-center space-x-4 pt-4 border-t border-gray-200">
          <span class="text-sm font-semibold text-gray-500">Follow Us:</span>
          <a href="https://www.instagram.com" target="_blank" class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300" aria-label="Instagram">
            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
            </svg>
          </a>
          <a href="https://www.facebook.com" target="_blank" class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300" aria-label="Facebook">
            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
          </a>
          <a href="https://youtube.com" target="_blank" class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300" aria-label="YouTube">
            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z"/>
            </svg>
          </a>
        </div>

        <!-- Flying Status -->
        <div class="flex items-center space-x-2 pt-4 border-t border-gray-200">
          <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
          </span>
          <span class="text-sm font-semibold text-green-600">Flying Season Active</span>
        </div>

        <!-- Quick Actions -->
        <div class="pt-4 border-t border-gray-200">
          <div class="grid grid-cols-2 gap-3">
            <a href="tel:+919736696260" class="flex items-center justify-center space-x-2 px-3 py-2 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-lg text-sm font-semibold transition-all duration-300">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
              <span>Call Now</span>
            </a>
            <a href="https://wa.me/919736696260" class="flex items-center justify-center space-x-2 px-3 py-2 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg text-sm font-semibold transition-all duration-300">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
              </svg>
              <span>WhatsApp</span>
            </a>
          </div>
        </div>

        <!-- App Info -->
        <div class="pt-4 border-t border-gray-200 text-center">
          <p class="text-xs text-gray-500">© 2024 MyBirBilling</p>
          <p class="text-xs text-gray-400 mt-1">India's Premier Paragliding Experience</p>
        </div>
      </div>
    </div>
  </div>
</div>