<!-- Enhanced Footer with Black Background -->
<footer class="bg-black text-white py-16 relative overflow-hidden">
  <!-- Background Pattern -->
  <div class="absolute inset-0 bg-[url('/images/footer-bg-pattern.png')] opacity-10 bg-cover bg-center"></div>
  
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
      <!-- About Section -->
      <div class="space-y-6">
        <div class="flex items-center space-x-4">
          <div class="relative flex-shrink-0">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-700 rounded-full opacity-40 blur-lg"></div>
            <div class="relative bg-gradient-to-br from-blue-600 to-purple-700 p-3 rounded-2xl shadow-2xl">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-6m0 0l5 6m-5-6v18"></path>
              </svg>
            </div>
          </div>
          <div>
            <h3 class="text-3xl font-extrabold bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">MyBirBilling</h3>
            <p class="text-sm text-gray-300 font-medium">India's Paragliding Capital</p>
          </div>
        </div>
        <p class="text-gray-300 leading-relaxed text-sm max-w-xs">
          Soar above Bir Billing’s breathtaking valleys with professional tandem flights, expert training, and premium adventure packages. Fly safely with DGCA-certified instructors.
        </p>
        <div class="grid grid-cols-2 gap-4">
          <div class="flex items-center space-x-2">
            <div class="w-6 h-6 bg-green-500/30 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            <span class="text-xs text-gray-300">DGCA Certified</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-6 h-6 bg-green-500/30 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            <span class="text-xs text-gray-300">24/7 Support</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-6 h-6 bg-green-500/30 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            <span class="text-xs text-gray-300">5000+ Flyers</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-6 h-6 bg-green-500/30 rounded-full flex items-center justify-center">
              <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
            </div>
            <span class="text-xs text-gray-300">Safe Equipment</span>
          </div>
        </div>
      </div>

      <!-- Quick Links -->
      <div>
        <h4 class="text-lg font-semibold mb-4 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent flex items-center">
          <svg class="w-5 h-5 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
          Quick Links
        </h4>
        <div class="space-y-3">
          <a href="{{ route('packages.index') }}" class="flex items-center space-x-2 text-gray-300 hover:text-blue-400 transition-all duration-300 group">
            <div class="w-2 h-2 bg-blue-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <span class="text-sm">Flight Packages</span>
          </a>
          <a href="{{ route('contact') }}" class="flex items-center space-x-2 text-gray-300 hover:text-blue-400 transition-all duration-300 group">
            <div class="w-2 h-2 bg-blue-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <span class="text-sm">Contact Us</span>
          </a>
          <a href="{{ route('gallery') }}" class="flex items-center space-x-2 text-gray-300 hover:text-blue-400 transition-all duration-300 group">
            <div class="w-2 h-2 bg-blue-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <span class="text-sm">Training Courses</span>
          </a>
          <a href="#" class="flex items-center space-x-2 text-gray-300 hover:text-blue-400 transition-all duration-300 group">
            <div class="w-2 h-2 bg-blue-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <span class="text-sm">Weather Updates</span>
          </a>
          <a href="{{ route('safety') }}" class="flex items-center space-x-2 text-gray-300 hover:text-blue-400 transition-all duration-300 group">
            <div class="w-2 h-2 bg-blue-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <span class="text-sm">Safety Professional Gear</span>
          </a>
        </div>
      </div>

      <!-- Contact Info -->
      <div>
        <h4 class="text-lg font-semibold mb-4 bg-gradient-to-r from-green-400 to-blue-400 bg-clip-text text-transparent flex items-center">
          <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
          </svg>
          Get In Touch
        </h4>
        <div class="space-y-4">
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-blue-500/30 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-white">Bir Billing, Himachal Pradesh</p>
              <p class="text-xs text-gray-300">PIN: 176077, India</p>
            </div>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-green-500/30 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
            </div>
            <div>
              <a href="tel:+919736696260" class="text-sm font-medium text-white hover:text-green-400 transition-colors">+91 97366 96260</a>
              <p class="text-xs text-gray-300">24/7 Support</p>
            </div>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-purple-500/30 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
            <div>
              <a href="mailto:chamelthakur280@gmail.com" class="text-sm font-medium text-white hover:text-purple-400 transition-colors">chamelthakur280@gmail.com</a>
              <p class="text-xs text-gray-300">Quick Response</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Social Media & Season -->
      <div>
        <h4 class="text-lg font-semibold mb-4 bg-gradient-to-r from-pink-400 to-purple-400 bg-clip-text text-transparent flex items-center">
          <svg class="w-5 h-5 mr-2 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
          Follow Us
        </h4>
        <div class="flex space-x-4 mb-6">
          <a href="https://www.instagram.com/reel/DLOhue4zzwx/?igsh=MWl1cGR1NW9sbHE0NA==" target="_blank"
            class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
          </a>
          <a href="https://www.facebook.com/share/r/1JcWrm9cYn/" target="_blank"
            class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
          </a>
          <a href="https://youtube.com/shorts/8Qz8MQXP4Fs?si=KAx3VgBO3_dNcLYt" target="_blank"
            class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
            </svg>
          </a>
          <a href="https://wa.me/919736696260" target="_blank"
            class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center hover:scale-110 transition-all duration-300">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
            </svg>
          </a>
        </div>
        <div class="p-4 bg-gray-900/50 rounded-xl border border-gray-700/50">
          <h5 class="text-sm font-semibold text-orange-300 mb-2 flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
            </svg>
            Flying Season
          </h5>
          <div class="space-y-2 text-xs text-gray-300">
            <div class="flex justify-between">
              <span>Best Months:</span>
              <span class="font-medium">Oct - June</span>
            </div>
            <div class="flex justify-between">
              <span>Daily Hours:</span>
              <span class="font-medium">9 AM - 6 PM</span>
            </div>
            <div class="flex justify-between">
              <span>Peak Season:</span>
              <span class="font-medium">Oct - Dec</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Section -->
    <div class="mt-12 pt-8 border-t border-gray-700/50">
      <div class="flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">
        <div class="text-center md:text-left">
          <p class="text-sm text-gray-300">
            © {{ date('Y') }} MyBirBilling. All rights reserved.
          </p>
          <p class="text-xs text-gray-400 mt-1">
            <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent font-medium">
              🏔️ India's Premier Paragliding Destination
            </span>
          </p>
        </div>
        <div class="flex flex-wrap justify-center md:justify-end space-x-6 text-sm">
          <a href="{{ route('privacy') }}" class="text-gray-300 hover:text-blue-400 transition-colors">Privacy Policy</a>
          <a href="{{ route('terms') }}" class="text-gray-300 hover:text-blue-400 transition-colors">Terms & Conditions</a>
          <a href="{{ route('safety') }}" class="text-gray-300 hover:text-blue-400 transition-colors">Safety Professional Gear</a>
          <a href="#" class="text-gray-300 hover:text-blue-400 transition-colors">Cancellation Policy</a>
        </div>
      </div>
      <div class="mt-8 p-4 bg-gray-900/50 rounded-xl border border-gray-700/50 text-center">
        <div class="flex flex-col sm:flex-row items-center justify-center space-y-3 sm:space-y-0 sm:space-x-4">
          <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-red-500/30 rounded-full flex items-center justify-center">
              <svg class="w-5 h-5 text-red-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
              </svg>
            </div>
            <p class="text-sm font-semibold text-red-300">Emergency Helpline (24/7)</p>
          </div>
          <a href="tel:+919736696260" class="text-lg font-bold text-white hover:text-red-300 transition-colors">+91 97366 96260</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Floating Action Buttons -->
<div class="fixed bottom-6 right-6 z-50 flex flex-col space-y-4">
  <!-- WhatsApp Button -->
  <a href="https://wa.me/919736696260" target="_blank"
    class="w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center shadow-2xl transition-all duration-300 animate-pulse hover:animate-none group relative">
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
      <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
    </svg>
    <span class="absolute right-full mr-3 px-3 py-1 bg-gray-900 text-white text-xs rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap shadow-lg">
      Chat on WhatsApp
    </span>
  </a>
  <!-- Back to Top Button -->
  <button x-show="scrolled"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    class="w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center shadow-2xl transition-all duration-300">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
  </button>
</div>