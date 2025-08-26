{{-- Exact Mobile Menu Component Based on Your Document --}}
{{-- Place this EXACT code in your mobile-menu-content.blade.php --}}

<!-- Fixed Mobile Menu Component -->
<div class="lg:hidden" 
     x-data="{ mobileMenuOpen: false }" 
     @toggle-mobile-menu.window="mobileMenuOpen = $event.detail.open"
     @keydown.escape.window="mobileMenuOpen = false">
  
  <!-- Mobile Header with Toggle Button -->
  <div class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur shadow-md z-40">
    <div class="flex items-center justify-between px-4 py-3">
      <!-- Logo Section -->
      <a href="{{ route('home') }}" class="flex items-center space-x-2">
        <img src="{{ asset('storage/image.png') }}" alt="MyBirBilling Logo" class="w-8 h-8 object-contain">
        <div>
          <div class="text-sm font-bold text-gray-900">MyBirBilling</div>
          <div class="text-[10px] text-gray-500">India's #1 Paragliding</div>
        </div>
      </a>
      
      <!-- HAMBURGER MENU BUTTON -->
      <button @click="mobileMenuOpen = !mobileMenuOpen" 
              class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
        <svg x-show="!mobileMenuOpen" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
  </div>
  
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
       @click="mobileMenuOpen = false"></div>

  <!-- Mobile Menu Panel -->
  <div x-show="mobileMenuOpen" 
       x-cloak
       x-transition:enter="transition ease-out duration-300" 
       x-transition:enter-start="transform translate-x-full" 
       x-transition:enter-end="transform translate-x-0" 
       x-transition:leave="transition ease-in duration-200" 
       x-transition:leave-start="transform translate-x-0" 
       x-transition:leave-end="transform translate-x-full" 
       class="fixed top-0 right-0 w-80 h-full bg-white shadow-2xl z-50 overflow-y-auto">
    
    <!-- Header -->
    <div class="flex items-center justify-between p-6 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('storage/image.png') }}" alt="MyBirBilling Logo" class="w-12 h-12 object-contain" onerror="this.style.display='none'">
        <div>
          <h2 class="text-lg font-bold">MyBirBilling</h2>
          <p class="text-xs opacity-90">India's #1 Paragliding</p>
        </div>
      </div>
      <button @click="mobileMenuOpen = false" 
              class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all duration-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <!-- Navigation Links -->
    <div class="p-6 space-y-4">
      <!-- Home -->
      <a href="{{ route('home') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : '' }}" 
         @click="mobileMenuOpen = false">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span>Home</span>
      </a>

      <!-- Packages -->
      <a href="{{ route('packages.index') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 {{ request()->routeIs('packages.*') ? 'text-blue-600 bg-blue-50' : '' }}" 
         @click="mobileMenuOpen = false">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
        <span>Packages</span>
      </a>

      <!-- Services Accordion -->
      <div x-data="{ servicesOpen: false }" class="relative">
        <button @click="servicesOpen = !servicesOpen" 
                class="w-full flex items-center justify-between px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300" 
                :class="{ 'text-blue-600 bg-blue-50': servicesOpen }">
          <div class="flex items-center space-x-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
            </svg>
            <span>Services</span>
          </div>
          <svg class="w-5 h-5 transition-transform duration-300" 
               :class="{ 'rotate-180': servicesOpen }" 
               fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        
        <!-- Services Submenu -->
        <div x-show="servicesOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 transform -translate-y-2" 
             x-transition:enter-end="opacity-100 transform translate-y-0" 
             class="mt-2 space-y-2 pl-6">
          <a href="{{ route('services.tandem') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             @click="mobileMenuOpen = false">
            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
              </svg>
            </div>
            <span>Tandem Flights</span>
          </a>
          <a href="{{ route('services.training') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             @click="mobileMenuOpen = false">
            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
              </svg>
            </div>
            <span>Basic Course</span>
          </a>
          <a href="{{ route('services.rental') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             @click="mobileMenuOpen = false">
            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
              </svg>
            </div>
            <span>Equipment Rental</span>
          </a>
          <a href="{{ route('safety') }}" 
             class="flex items-center space-x-3 px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-gray-50 rounded-lg transition-all duration-300" 
             @click="mobileMenuOpen = false">
            <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
         @click="mobileMenuOpen = false">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span>Gallery</span>
      </a>

      <!-- Contact -->
      <a href="{{ route('contact') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 {{ request()->routeIs('contact') ? 'text-blue-600 bg-blue-50' : '' }}" 
         @click="mobileMenuOpen = false">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
         @click="mobileMenuOpen = false">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <span>My Bookings</span>
      </a>

      <!-- Login/Register -->
      @else
      <a href="{{ route('login') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300" 
         @click="mobileMenuOpen = false">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
        </svg>
        <span>Login</span>
      </a>

      <a href="{{ route('register') }}" 
         class="flex items-center space-x-3 px-4 py-3 text-base font-semibold text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg hover:shadow-lg transition-all duration-300" 
         @click="mobileMenuOpen = false">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
        </svg>
        <span>Book Now</span>
      </a>
      @endauth
    </div>

    <!-- Footer Contact Info -->
    <div class="p-6 bg-gray-50 border-t border-gray-200">
      <div class="space-y-4">
        <div class="space-y-3">
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
              </svg>
            </div>
            <a href="https://wa.me/919736696260" class="text-sm font-semibold text-gray-700">WhatsApp: +91 97366 96260</a>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
            </div>
            <a href="tel:+919736696260" class="text-sm font-semibold text-gray-700">Emergency: +91 97366 96260</a>
          </div>
        </div>

        <div class="flex items-center space-x-2 pt-3 border-t border-gray-200">
          <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
          </span>
          <span class="text-sm font-semibold text-green-600">Flying Season Active</span>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bottom Navigation -->
  <div class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-2xl z-40">
    <div class="grid grid-cols-3 h-16">
      <a href="tel:+919736696260" class="flex flex-col items-center justify-center hover:bg-gray-50 transition-colors group">
        <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
        </svg>
        <span class="text-xs text-gray-600 group-hover:text-blue-600">Call</span>
      </a>
      
      <a href="https://wa.me/919736696260" class="flex flex-col items-center justify-center hover:bg-green-50 transition-colors group">
        <svg class="w-6 h-6 text-green-500 mb-1" fill="currentColor" viewBox="0 0 24 24">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.149-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        <span class="text-xs text-gray-600 group-hover:text-green-600">WhatsApp</span>
      </a>
      
      <a href="{{ route('packages.index') }}" class="flex flex-col items-center justify-center hover:bg-orange-50 transition-colors group">
        <svg class="w-5 h-5 text-orange-500 group-hover:text-orange-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <span class="text-xs text-gray-600 group-hover:text-orange-600">Book Now</span>
      </a>
    </div>
  </div>
</div>

<!-- Mobile specific styles -->
<style>
@media (max-width: 1024px) {
  body {
    padding-top: 64px; /* Mobile header height */
    padding-bottom: 64px; /* Mobile bottom nav height */
  }
}
</style>