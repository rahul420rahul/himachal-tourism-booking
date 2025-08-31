<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Responsive About Section</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- About Us Section -->
    <section class="py-20 bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Features Grid - Mobile mein horizontal scroll -->
            <div class="mb-16">
                <!-- Desktop Grid -->
                <div class="hidden md:grid grid-cols-5 gap-8">
                    <!-- Professional Guides -->
                    <div class="text-center transform hover:scale-105 transition-all duration-300">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-blue-100 to-blue-200 rounded-xl flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Professional Guides</h3>
                    </div>

                    <!-- Family Friendly -->
                    <div class="text-center transform hover:scale-105 transition-all duration-300">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Family Friendly</h3>
                    </div>

                    <!-- Scenic Adventures -->
                    <div class="text-center transform hover:scale-105 transition-all duration-300">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-purple-100 to-purple-200 rounded-xl flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Scenic Adventures</h3>
                    </div>

                    <!-- Safe Accommodation -->
                    <div class="text-center transform hover:scale-105 transition-all duration-300">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-amber-100 to-amber-200 rounded-xl flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Accommodation</h3>
                    </div>

                    <!-- Lifelong Memories -->
                    <div class="text-center transform hover:scale-105 transition-all duration-300">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-red-100 to-red-200 rounded-xl flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Lifelong Memories</h3>
                    </div>
                </div>

                <!-- Mobile Horizontal Scroll -->
                <div class="md:hidden">
                    <div class="flex overflow-x-auto space-x-4 pb-4 scrollbar-hide">
                        <!-- Professional Guides -->
                        <div class="flex-shrink-0 text-center w-20">
                            <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xs font-semibold text-gray-800">Professional Guides</h3>
                        </div>

                        <!-- Family Friendly -->
                        <div class="flex-shrink-0 text-center w-20">
                            <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xs font-semibold text-gray-800">Family Friendly</h3>
                        </div>

                        <!-- Scenic Adventures -->
                        <div class="flex-shrink-0 text-center w-20">
                            <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-purple-100 to-purple-200 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xs font-semibold text-gray-800">Scenic Adventures</h3>
                        </div>

                        <!-- Safe Accommodation -->
                        <div class="flex-shrink-0 text-center w-20">
                            <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <h3 class="text-xs font-semibold text-gray-800">Accommodation</h3>
                        </div>

                        <!-- Lifelong Memories -->
                        <div class="flex-shrink-0 text-center w-20">
                            <div class="w-12 h-12 mx-auto mb-2 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xs font-semibold text-gray-800">Lifelong Memories</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Text Content -->
                <div>
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-5xl font-bold text-gray-800 mb-4">
                            WE ARE
                        </h2>
                        <h3 class="text-3xl md:text-5xl font-bold bg-gradient-to-r from-red-600 via-orange-500 to-green-600 bg-clip-text text-transparent mb-6">
                            MYBIRBILLING
                        </h3>
                    </div>
                </div>

                <!-- Right Side - Description -->
                <div class="bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 rounded-2xl p-6 md:p-8 text-white relative shadow-2xl">
                    <!-- Decorative Pattern -->
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-10">
                        <svg viewBox="0 0 100 100" class="w-full h-full">
                            <path d="M20,20 Q50,5 80,20 Q95,50 80,80 Q50,95 20,80 Q5,50 20,20 Z" 
                                  fill="none" stroke="currentColor" stroke-width="1"/>
                            <path d="M30,30 Q50,20 70,30 Q80,50 70,70 Q50,80 30,70 Q20,50 30,30 Z" 
                                  fill="none" stroke="currentColor" stroke-width="1"/>
                        </svg>
                    </div>
                    
                    <p class="text-base md:text-lg leading-relaxed relative z-10 mb-6">
                        MyBirBilling is an adventure travel company in Himachal Pradesh that is 
                        working to promote tourism and help people with some great tour 
                        packages available in Himachal Pradesh of India.
                    </p>
                    
                    <!-- Learn More Button -->
                    <div class="mt-6 md:mt-8">
                        <a href="#" 
                           class="inline-flex items-center px-6 md:px-8 py-3 md:py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold rounded-xl hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <span class="text-base md:text-lg">Learn More</span>
                            <svg class="w-5 h-5 md:w-6 md:h-6 ml-2 md:ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Hide scrollbar */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</body>
</html>