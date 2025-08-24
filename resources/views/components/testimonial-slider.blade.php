@props(['testimonials' => collect()])

@if($testimonials && $testimonials->count() > 0)
    <div class="testimonial-slider-container relative">
        <!-- Testimonials Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <!-- Rating Stars -->
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-500 mr-3">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < ($testimonial->rating ?? 5))
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500">{{ $testimonial->rating ?? 5 }}/5</span>
                    </div>
                    
                    <!-- Review Text -->
                    <p class="text-gray-600 italic mb-6 leading-relaxed">
                        "{{ $testimonial->review ?? 'Great experience!' }}"
                    </p>
                    
                    <!-- Customer Info -->
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ substr($testimonial->customer_name ?? 'Guest', 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900">{{ $testimonial->customer_name ?? 'Anonymous Guest' }}</h4>
                            <p class="text-sm text-gray-500">
                                @if(isset($testimonial->package_name))
                                    {{ $testimonial->package_name }}
                                @elseif(isset($testimonial->location))
                                    {{ $testimonial->location }}
                                @else
                                    Verified Customer
                                @endif
                            </p>
                            @if(isset($testimonial->created_at))
                                <p class="text-xs text-gray-400">{{ $testimonial->created_at->format('M Y') }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Verified Badge -->
                    <div class="mt-4 flex items-center justify-between">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Verified Review
                        </span>
                        
                        @if(isset($testimonial->experience_type))
                            <span class="text-xs text-gray-500 px-2 py-1 bg-gray-100 rounded-full">
                                {{ $testimonial->experience_type }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- View More Button (if more than 6 testimonials) -->
        @if($testimonials->count() > 6)
            <div class="text-center mt-12">
                <button id="loadMoreTestimonials" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-full font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    View More Reviews
                </button>
            </div>
        @endif
    </div>
@else
    <!-- No Testimonials State -->
    <div class="col-span-full text-center py-16" data-aos="fade-up">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full mb-6">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-3">No Reviews Yet</h3>
        <p class="text-gray-600 mb-6 max-w-md mx-auto">
            Be the first to share your amazing experience with us! Your feedback helps others discover the magic of Himachal.
        </p>
        <div class="space-x-4">
            <a href="{{ route('packages.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Book Your Adventure
            </a>
            <a href="{{ route('contact') }}" 
               class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                Contact Us
            </a>
        </div>
    </div>
@endif

@if($testimonials && $testimonials->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth hover effects
    const testimonialCards = document.querySelectorAll('.testimonial-slider-container .bg-gradient-to-br');
    
    testimonialCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Load more functionality (if needed)
    const loadMoreBtn = document.getElementById('loadMoreTestimonials');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Add your load more logic here
            console.log('Load more testimonials');
        });
    }
});
</script>
@endif