console.log('Test React file loading...');

// Simple test without imports to check if file loads
document.addEventListener('DOMContentLoaded', function() {
    const rootEl = document.getElementById('react-booking-root');
    if (rootEl) {
        rootEl.innerHTML = '<div style="text-align: center; padding: 40px; background: linear-gradient(45deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px; margin: 20px;"><h1 style="font-size: 2rem;">✅ React is Working!</h1><p>Booking system loading...</p></div>';
        console.log('Test React content injected');
    }
});
