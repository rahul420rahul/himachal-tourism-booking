import React from 'react';
import ReactDOM from 'react-dom/client';
import BookingFlow from './components/BookingFlow';
import { Toaster } from 'react-hot-toast';
import '../css/app.css';

// Get package ID from URL
const pathSegments = window.location.pathname.split('/');
const packageId = pathSegments[pathSegments.length - 1];

const App = () => {
    return (
        <>
            <Toaster position="top-right" />
            <BookingFlow packageId={packageId} />
        </>
    );
};

// Mount React app
const container = document.getElementById('react-booking-app');
if (container) {
    const root = ReactDOM.createRoot(container);
    root.render(<App />);
}
