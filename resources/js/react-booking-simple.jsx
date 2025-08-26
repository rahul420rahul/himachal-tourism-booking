import React from 'react';
import { createRoot } from 'react-dom/client';

function BookingApp() {
    return (
        <div style={{ padding: '20px', textAlign: 'center' }}>
            <h1 style={{ color: 'blue' }}>React Booking Working! 🚀</h1>
            <p>If you can see this, React is loaded successfully!</p>
        </div>
    );
}

// Mount immediately
const container = document.getElementById('react-booking-root');
if (container) {
    const root = createRoot(container);
    root.render(<BookingApp />);
    console.log('React app mounted!');
}
