import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

const BookingModal = ({ packageInfo, onClose }) => {
    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div className="bg-white rounded-lg p-8 max-w-md w-full shadow-xl">
                <h2 className="text-2xl font-bold mb-4">Confirm Booking</h2>
                <p className="mb-2"><strong>Package:</strong> {packageInfo.name}</p>
                <p className="mb-4"><strong>Price:</strong> ₹{packageInfo.price}</p>
                
                <div className="flex space-x-4">
                    <a 
                        href={`/booking-new/${packageInfo.id}`}
                        className="flex-1 bg-green-500 text-white px-4 py-2 rounded text-center hover:bg-green-600"
                    >
                        Continue to Booking
                    </a>
                    <button 
                        onClick={onClose}
                        className="flex-1 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    );
};

// Global state for modal
let modalRoot = null;
let modalContainer = null;

// Initialize on page load
if (typeof window !== 'undefined') {
    window.addEventListener('DOMContentLoaded', () => {
        modalContainer = document.getElementById('booking-modal-container');
        if (modalContainer) {
            modalRoot = ReactDOM.createRoot(modalContainer);
            
            // Global function to open modal
            window.openBookingModal = (packageInfo) => {
                console.log('Opening modal for:', packageInfo);
                modalRoot.render(
                    <BookingModal 
                        packageInfo={packageInfo}
                        onClose={() => modalRoot.render(null)}
                    />
                );
            };
            
            console.log('✅ Booking modal initialized successfully');
        } else {
            console.error('❌ Modal container not found');
        }
    });
}
