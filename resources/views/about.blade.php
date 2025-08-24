<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 overflow-hidden perspective-1000" x-data="{ contentVisible: false }" x-init="setTimeout(() => contentVisible = true, 500)">
        <!-- Hero Section with 3D Depth -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-24 transition-all duration-1000" :class="contentVisible ? 'translate-z-20' : 'translate-z-0'" style="transform-style: preserve-3d;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center transform transition-all duration-700" :class="contentVisible ? 'rotate-x-5 opacity-100' : 'rotate-x-0 opacity-0'" style="transform-style: preserve-3d;">
                    <h1 class="text-6xl font-bold mb-6 drop-shadow-2xl">About Us</h1>
                    <p class="text-3xl opacity-90">Your trusted travel partner since our inception</p>
                </div>
            </div>
        </div>
        <!-- Content Section with 3D Cards -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-12">
                    <h2 class="text-5xl font-bold text-gray-900 mb-8 drop-shadow-lg transform transition-all duration-700 delay-300 hover:translate-z-10" style="transform-style: preserve-3d;">Our Story</h2>
                    <p class="text-xl text-gray-600 leading-relaxed transform transition-all duration-700 delay-500 hover:rotate-y-5" style="transform-style: preserve-3d;">
                        MyBirBilling began with a passion for making travel accessible, affordable, and unforgettable. We turn every trip into an epic adventure.
                    </p>
                    <p class="text-xl text-gray-600 leading-relaxed transform transition-all duration-700 delay-700 hover:rotate-y-5" style="transform-style: preserve-3d;">
                        With extensive industry experience, we design bespoke experiences for all travelers – adventurers, relaxers, solo explorers, and families alike.
                    </p>
                    <div class="grid grid-cols-2 gap-8 transform transition-all duration-700 delay-900 hover:scale-105" style="transform-style: preserve-3d;">
                        <div class="text-center bg-white rounded-2xl shadow-xl p-6 transform hover:rotate-x-10 transition-transform duration-500" style="transform-style: preserve-3d;">
                            <div class="text-4xl font-bold text-blue-600">500+</div>
                            <div class="text-xl text-gray-600">Happy Customers</div>
                        </div>
                        <div class="text-center bg-white rounded-2xl shadow-xl p-6 transform hover:rotate-x-10 transition-transform duration-500" style="transform-style: preserve-3d;">
                            <div class="text-4xl font-bold text-blue-600">50+</div>
                            <div class="text-xl text-gray-600">Destinations</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-3xl shadow-2xl p-12 transform transition-all duration-1000 hover:rotate-y-10" style="transform-style: preserve-3d;">
                    <h3 class="text-4xl font-bold text-gray-900 mb-10 drop-shadow-lg">Why Choose Us?</h3>
                    <div class="space-y-8">
                        <div class="flex items-start space-x-5 transform transition-all duration-500 hover:translate-z-5" style="transform-style: preserve-3d;">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1 shadow-md">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-gray-900">Best Price Guarantee</h4>
                                <p class="text-lg text-gray-600">Competitive pricing with price matching assurance</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-5 transform transition-all duration-500 hover:translate-z-5" style="transform-style: preserve-3d;">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1 shadow-md">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-gray-900">24/7 Support</h4>
                                <p class="text-lg text-gray-600">Always-available customer assistance</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-5 transform transition-all duration-500 hover:translate-z-5" style="transform-style: preserve-3d;">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1 shadow-md">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-gray-900">Customizable Packages</h4>
                                <p class="text-lg text-gray-600">Personalized travel experiences tailored to you</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .perspective-1000 {
        perspective: 1000px;
    }
    .translate-z-20 {
        transform: translateZ(20px);
    }
    .rotate-x-5 {
        transform: rotateX(5deg);
    }
    .rotate-y-5 {
        transform: rotateY(5deg);
    }
    .rotate-x-10 {
        transform: rotateX(10deg);
    }
    .rotate-y-10 {
        transform: rotateY(10deg);
    }
    .translate-z-5 {
        transform: translateZ(5px);
    }
    .translate-z-10 {
        transform: translateZ(10px);
    }
</style>