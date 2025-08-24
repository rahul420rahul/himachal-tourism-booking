{{-- Mobile Navigation Bar (Sky Trekkers Style) --}}
<div class="lg:hidden">
    <!-- Top Mobile Header (Absolute on hero pages) -->
    <div class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur shadow-md z-40">
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Logo Section -->
            <a href="/" class="flex items-center space-x-2">
                <img src="/favicon.ico" alt="Logo" class="w-8 h-8">
                <div>
                    <div class="text-sm font-bold text-gray-900">MyBirBilling</div>
                    <div class="text-[10px] text-gray-500">Let the adventure start</div>
                </div>
            </a>
            
            <!-- Menu Toggle Button -->
            <button onclick="window.dispatchEvent(new CustomEvent('toggle-mobile-menu', { detail: { open: true } }))" 
                    class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Bottom Fixed Navigation (Sky Trekkers Style) -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-2xl z-40">
        <div class="grid grid-cols-3 h-16">
            <!-- Call Button -->
            <a href="tel:+919318077071" class="flex flex-col items-center justify-center hover:bg-gray-50 transition-colors group">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <span class="text-xs text-gray-600 group-hover:text-blue-600">Call</span>
            </a>
            
            <!-- WhatsApp Button -->
            <a href="https://wa.me/919318077071" class="flex flex-col items-center justify-center hover:bg-green-50 transition-colors group">
                <svg class="w-6 h-6 text-green-500 mb-1" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.149-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                <span class="text-xs text-gray-600 group-hover:text-green-600">WhatsApp</span>
            </a>
            
            <!-- Book a Tour Button -->
            <a href="/bookings/create" class="flex flex-col items-center justify-center hover:bg-orange-50 transition-colors group">
                <svg class="w-5 h-5 text-orange-500 group-hover:text-orange-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="text-xs text-gray-600 group-hover:text-orange-600">Book a Tour</span>
            </a>
        </div>
    </div>
</div>

<!-- Hero section specific styles -->
<style>
@media (max-width: 1024px) {
    /* Make header transparent on hero section */
    .hero-section ~ * .fixed.top-0 {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }
}
</style>
