import React from 'react';
import ReactDOM from 'react-dom/client';
import BookingApp from './react/BookingApp';

const container = document.getElementById('react-booking-app');
if (container) {
    const root = ReactDOM.createRoot(container);
    root.render(<BookingApp />);
}
