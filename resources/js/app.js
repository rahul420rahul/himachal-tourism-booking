import './bootstrap';
import Alpine from 'alpinejs';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Fix all undefined variables that might cause errors
window.scrolled = false;

console.log('App.js loaded - Alpine initialized');

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.querySelector('[aria-label="Toggle menu"]');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (toggleBtn && mobileMenu) {
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            mobileMenu.classList.toggle('hidden');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && !toggleBtn.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    }
});

// Simple mobile menu toggle
window.toggleMobileMenu = function() {
    const menu = document.getElementById('mobileMenu');
    const openIcon = document.getElementById('openIcon');
    const closeIcon = document.getElementById('closeIcon');
    
    if (menu) {
        menu.classList.toggle('hidden');
        openIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    }
}// Prevent FOUC
document.addEventListener('DOMContentLoaded', function() {
    document.documentElement.classList.add('loaded');
    document.body.classList.add('loaded');
});