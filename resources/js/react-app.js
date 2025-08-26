import React from 'react';
import { createRoot } from 'react-dom/client';
import BookingComponent from './components/BookingComponent.js';

const container = document.getElementById('booking-widget');
if (container) {
    const root = createRoot(container);
    root.render(React.createElement(BookingComponent));
    console.log('Booking component mounted!');
}
