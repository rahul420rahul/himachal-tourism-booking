
{{-- Clean Testimonials Slider --}}
<div class="testimonials-wrapper">
    <div class="testimonial-slider" id="testimonialSlider">
        <div class="slides-container" id="slidesContainer">
            <!-- Slides will be injected -->
        </div>
    </div>
    
    <!-- Simple Navigation -->
    <button class="nav-btn prev" id="prevBtn">‹</button>
    <button class="nav-btn next" id="nextBtn">›</button>
    
    <!-- Dots -->
    <div class="dots" id="dotsNav"></div>
</div>

<style>
.testimonials-wrapper {
    position: relative;
    max-width: 700px;
    margin: 0 auto;
}

.testimonial-slider {
    overflow: hidden;
    border-radius: 16px;
}

.slides-container {
    display: flex;
    transition: transform 0.5s ease;
}

.testimonial-slide {
    min-width: 100%;
    padding: 40px 20px;
    text-align: center;
}

.testimonial-text {
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 1.5rem;
    color: #4a5568;
    font-style: italic;
}

.testimonial-author {
    font-weight: 600;
    font-size: 1rem;
    color: #2d3748;
    margin-bottom: 0.25rem;
}

.testimonial-location {
    color: #718096;
    font-size: 0.9rem;
}

.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    background: #f7fafc;
    color: #4a5568;
    cursor: pointer;
    font-size: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s;
}

.nav-btn:hover {
    background: #edf2f7;
    color: #2d3748;
}

.prev { left: -20px; }
.next { right: -20px; }

.dots {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
}

.dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #cbd5e0;
    cursor: pointer;
    transition: all 0.3s;
}

.dot.active {
    background: #ed8936;
    transform: scale(1.2);
}

@media (max-width: 640px) {
    .testimonial-slide {
        padding: 30px 15px;
    }
    
    .nav-btn {
        width: 35px;
        height: 35px;
    }
    
    .prev { left: -17px; }
    .next { right: -17px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const testimonials = [
        {
            text: "Very safe and pleasant experience with Bir Billing paragliding. My pilot was well experienced and explained well whole process. Would recommend to go with them if you want to try paragliding in Bir.",
            author: "Rahul Thakur",
            location: "Delhi"
        },
        {
            text: "Amazing experience! The views from up there are breathtaking. Professional team and great safety measures.",
            author: "Priya Sharma", 
            location: "Mumbai"
        },
        {
            text: "Best paragliding experience ever! The instructors are highly skilled and made me feel completely safe.",
            author: "Amit Kumar",
            location: "Bangalore"
        },
        {
            text: "Incredible adventure! From takeoff to landing, everything was perfect. Highly recommended!",
            author: "Sarah Johnson",
            location: "London"
        }
    ];

    let currentSlide = 0;
    const container = document.getElementById('slidesContainer');
    const dotsNav = document.getElementById('dotsNav');

    // Create slides and dots
    testimonials.forEach((testimonial, index) => {
        const slide = document.createElement('div');
        slide.className = 'testimonial-slide';
        slide.innerHTML = `
            <div class="testimonial-text">"${testimonial.text}"</div>
            <div class="testimonial-author">${testimonial.author}</div>
            <div class="testimonial-location">${testimonial.location}</div>
        `;
        container.appendChild(slide);

        const dot = document.createElement('button');
        dot.className = `dot ${index === 0 ? 'active' : ''}`;
        dot.addEventListener('click', () => goToSlide(index));
        dotsNav.appendChild(dot);
    });

    function updateSlider() {
        container.style.transform = `translateX(-${currentSlide * 100}%)`;
        document.querySelectorAll('.dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }

    function goToSlide(index) {
        currentSlide = index;
        updateSlider();
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % testimonials.length;
        updateSlider();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + testimonials.length) % testimonials.length;
        updateSlider();
    }

    document.getElementById('nextBtn').addEventListener('click', nextSlide);
    document.getElementById('prevBtn').addEventListener('click', prevSlide);

    // Auto-rotate every 4 seconds
    setInterval(nextSlide, 4000);
});
</script>