@extends('layouts.app')
@section('title', 'Contact Us - Get in Touch')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="relative h-[40vh] min-h-[350px] bg-gradient-to-br from-sky-600 via-sky-500 to-emerald-500 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" xmlns="http://www.w3.org/2000/svg"%3E%3Cdefs%3E%3Cpattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse"%3E%3Cpath d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="1"/%3E%3C/pattern%3E%3C/defs%3E%3Crect width="100%25" height="100%25" fill="url(%23grid)"/%3E%3C/svg%3E')"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="relative h-full flex items-center justify-center text-center px-4">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 animate-fade-in-down">
                    Get in Touch
                </h1>
                <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto animate-fade-in-up">
                    Ready to experience the thrill of paragliding? Contact us today and let's plan your adventure in the skies of Bir Billing!
                </p>
            </div>
        </div>
        
        <!-- Decorative Wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-12 md:h-20 text-gray-50" preserveAspectRatio="none" viewBox="0 0 1440 74" fill="currentColor">
                <path d="M0,32L60,37.3C120,43,240,53,360,58.7C480,64,600,64,720,56C840,48,960,32,1080,26.7C1200,21,1320,27,1380,29.3L1440,32L1440,74L1380,74C1320,74,1200,74,1080,74C960,74,840,74,720,74C600,74,480,74,360,74C240,74,120,74,60,74L0,74Z"></path>
            </svg>
        </div>
    </section>

    <!-- Quick Contact Bar -->
    <section class="bg-white shadow-lg -mt-20 relative z-10 mx-4 md:mx-8 lg:mx-auto max-w-6xl rounded-2xl">
        <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-200">
            <!-- Phone -->
            <a href="tel:+919736696260" class="group p-6 flex items-center space-x-4 hover:bg-sky-50 transition-colors duration-300 rounded-t-2xl md:rounded-tr-none md:rounded-l-2xl">
                <div class="flex-shrink-0 w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                    <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Call Us</p>
                    <p class="font-semibold text-gray-900">+91 97366 96260</p>
                </div>
            </a>
            
            <!-- WhatsApp -->
            <a href="https://wa.me/919736696260" class="group p-6 flex items-center space-x-4 hover:bg-emerald-50 transition-colors duration-300">
                <div class="flex-shrink-0 w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                    <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.149-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">WhatsApp</p>
                    <p class="font-semibold text-gray-900">Quick Response</p>
                </div>
            </a>
            
            <!-- Email -->
            <a href="mailto:info@mybirbilling.com" class="group p-6 flex items-center space-x-4 hover:bg-purple-50 transition-colors duration-300 rounded-b-2xl md:rounded-bl-none md:rounded-r-2xl">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email Us</p>
                    <p class="font-semibold text-gray-900">info@mybirbilling.com</p>
                </div>
            </a>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 px-4 md:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-5 gap-8 lg:gap-12">
                
                <!-- Contact Form - Left Side -->
                <div class="lg:col-span-3" x-data="{ 
                    formSubmitted: false,
                    showSuccess: false,
                    isSubmitting: false,
                    async submitForm(event) {
                        this.isSubmitting = true;
                        
                        try {
                            // Simulate form submission
                            await new Promise(resolve => setTimeout(resolve, 1000));
                            
                            this.showSuccess = true;
                            this.formSubmitted = true;
                            event.target.reset();
                            
                            setTimeout(() => {
                                this.showSuccess = false;
                            }, 5000);
                        } catch (error) {
                            console.error('Form submission error:', error);
                        } finally {
                            this.isSubmitting = false;
                        }
                    }
                }">
                    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 transform hover:shadow-2xl transition-all duration-300">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Send us a Message</h2>
                        <p class="text-gray-600 mb-8">Fill out the form below and we'll get back to you within 24 hours.</p>
                        
                        <!-- Success Message -->
                        <div x-show="showSuccess" 
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Message sent successfully! We'll contact you soon.</span>
                        </div>

                        <form method="POST" action="{{ route('contact.store') }}" @submit.prevent="submitForm" class="space-y-6">
                            @csrf
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Name -->
                                <div class="group">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2 group-focus-within:text-sky-600 transition-colors">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 hover:border-gray-400 placeholder-gray-400"
                                        placeholder="John Doe">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Phone -->
                                <div class="group">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2 group-focus-within:text-sky-600 transition-colors">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="phone" name="phone" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 hover:border-gray-400 placeholder-gray-400"
                                        placeholder="+91 98765 43210">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="group">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2 group-focus-within:text-sky-600 transition-colors">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 hover:border-gray-400 placeholder-gray-400"
                                    placeholder="john@example.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Subject -->
                            <div class="group">
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2 group-focus-within:text-sky-600 transition-colors">
                                    Subject <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="subject" name="subject" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 hover:border-gray-400 placeholder-gray-400"
                                    placeholder="Inquiry about paragliding packages">
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Message -->
                            <div class="group">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2 group-focus-within:text-sky-600 transition-colors">
                                    Message <span class="text-red-500">*</span>
                                </label>
                                <textarea id="message" name="message" rows="5" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent transition-all duration-200 hover:border-gray-400 resize-none placeholder-gray-400"
                                    placeholder="Tell us about your requirements, preferred dates, group size, and any special requests..."></textarea>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" :disabled="isSubmitting"
                                class="w-full bg-gradient-to-r from-sky-500 to-emerald-500 text-white py-3 px-6 rounded-lg font-semibold hover:from-sky-600 hover:to-emerald-600 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                :class="{ 'animate-pulse': isSubmitting }">
                                <span x-show="!isSubmitting" class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Send Message
                                </span>
                                <span x-show="isSubmitting" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Sending...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Contact Info - Right Side -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Contact Information Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:shadow-2xl transition-all duration-300">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h3>
                        
                        <div class="space-y-6">
                            <!-- Address -->
                            <div class="flex items-start space-x-4 group hover:bg-gray-50 p-3 rounded-lg transition-colors duration-200">
                                <div class="flex-shrink-0 w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Office Address</h4>
                                    <p class="text-gray-600 mt-1">Landing Site, Near Charlie's Cafe<br>Bir, Himachal Pradesh 176077</p>
                                </div>
                            </div>
                            
                            <!-- Phone -->
                            <a href="tel:+919736696260" class="flex items-start space-x-4 group hover:bg-gray-50 p-3 rounded-lg transition-colors duration-200">
                                <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Phone</h4>
                                    <p class="text-emerald-600 mt-1 font-medium hover:text-emerald-700">+91 97366 96260</p>
                                </div>
                            </a>
                            
                            <!-- Email -->
                            <a href="mailto:info@mybirbilling.com" class="flex items-start space-x-4 group hover:bg-gray-50 p-3 rounded-lg transition-colors duration-200">
                                <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Email</h4>
                                    <p class="text-purple-600 mt-1 font-medium hover:text-purple-700">info@mybirbilling.com</p>
                                </div>
                            </a>
                            
                            <!-- Working Hours -->
                            <div class="flex items-start space-x-4 group hover:bg-gray-50 p-3 rounded-lg transition-colors duration-200">
                                <div class="flex-shrink-0 w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center group-hover:bg-amber-200 transition-colors">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Working Hours</h4>
                                    <p class="text-gray-600 mt-1">Mon - Sun: 9:00 AM - 6:00 PM<br>
                                    <span class="text-emerald-600 font-medium">Flying Season Active</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media Card -->
                    <div class="bg-gradient-to-br from-sky-50 to-emerald-50 rounded-2xl p-8 transform hover:shadow-xl transition-all duration-300">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Follow Us</h3>
                        <p class="text-gray-600 mb-6 text-sm">Stay updated with our latest adventures and offers</p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-12 h-12 bg-white rounded-lg flex items-center justify-center hover:bg-blue-500 hover:text-white transition-all duration-200 shadow hover:shadow-lg transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-white rounded-lg flex items-center justify-center hover:bg-gradient-to-br hover:from-purple-500 hover:to-pink-500 hover:text-white transition-all duration-200 shadow hover:shadow-lg transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
                                    <path d="m12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-white rounded-lg flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-200 shadow hover:shadow-lg transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z"/>
                                    <path d="m9.545 15.568 6.248-3.568-6.248-3.568v7.136z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me/919736696260" class="w-12 h-12 bg-white rounded-lg flex items-center justify-center hover:bg-green-500 hover:text-white transition-all duration-200 shadow hover:shadow-lg transform hover:scale-110">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.149-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414-.075-.124-.273-.198-.57-.347z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Find Us on Map</h2>
                <p class="text-gray-600">Visit us at the paragliding landing site in Bir</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:shadow-2xl transition-all duration-300">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3380.8!2d76.7223!3d32.1368!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391b4f4b6b4c1b1b%3A0x5e5e5e5e5e5e5e5e!2sBir%2C%20Himachal%20Pradesh!5e0!3m2!1sen!2sin!4v1234567890"
                    width="100%"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full">
                </iframe>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-sky-500 to-emerald-500">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Ready for Your Adventure?
            </h2>
            <p class="text-lg text-white/90 mb-8">
                Book your paragliding experience today and soar through the skies!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:+919736696260" class="inline-flex items-center justify-center px-8 py-3 bg-white text-sky-600 font-semibold rounded-lg hover:bg-gray-100 hover:shadow-lg transform hover:scale-105 transition-all duration-200 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call Now
                </a>
                <a href="https://wa.me/919736696260" class="inline-flex items-center justify-center px-8 py-3 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 hover:shadow-lg transform hover:scale-105 transition-all duration-200 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.149-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes fade-in-down {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
    
    .animate-fade-in-down {
        animation: fade-in-down 0.8s ease-out;
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out 0.2s both;
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Custom scrollbar for webkit browsers */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Form focus states */
    .group:focus-within label {
        color: #0284c7;
    }
    
    /* Custom gradient text */
    .gradient-text {
        background: linear-gradient(135deg, #0ea5e9, #10b981);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Floating animation */
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    /* Custom box shadow */
    .shadow-custom {
        box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    /* Responsive design adjustments */
    @media (max-width: 640px) {
        .hero-pattern {
            opacity: 0.05;
        }
    }
    
    /* Loading spinner */
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
    
    /* Success message animation */
    @keyframes slideInFromTop {
        0% {
            transform: translateY(-100%);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .slide-in-top {
        animation: slideInFromTop 0.5s ease-out;
    }
    
    /* Hover effects */
    .hover-lift:hover {
        transform: translateY(-2px);
        transition: transform 0.2s ease;
    }
    
    /* Card stacking effect on mobile */
    @media (max-width: 1024px) {
        .card-stack > * + * {
            margin-top: 1rem;
        }
    }
</style>

<!-- Alpine.js CDN (if not already included in your layout) -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection