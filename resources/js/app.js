import './bootstrap';
import Alpine from 'alpinejs';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Fix all undefined variables that might cause errors
window.scrolled = false;

console.log('App.js loaded - Alpine initialized');
