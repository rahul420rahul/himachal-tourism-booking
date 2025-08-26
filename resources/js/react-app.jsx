import React from 'react';
import { createRoot } from 'react-dom/client';
import BookingWidget from './components/BookingWidget';

// Import future components here
// import Dashboard from './components/Dashboard';
// import Gallery from './components/Gallery';

const components = {
    BookingWidget,
    // Dashboard,
    // Gallery,
};

// Mount all React components
document.addEventListener('DOMContentLoaded', () => {
    // Method 1: ID based mounting
    const bookingContainer = document.getElementById('booking-widget');
    if (bookingContainer) {
        const root = createRoot(bookingContainer);
        root.render(<BookingWidget />);
    }
    
    // Method 2: Data attribute based
    document.querySelectorAll('[data-react-component]').forEach(element => {
        const componentName = element.dataset.reactComponent;
        const Component = components[componentName];
        
        if (Component) {
            const props = element.dataset.props ? JSON.parse(element.dataset.props) : {};
            const root = createRoot(element);
            root.render(<Component {...props} />);
        }
    });
});
