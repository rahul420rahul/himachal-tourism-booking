import React, { useState } from 'react';

const BookingApp = () => {
    return React.createElement('div', {
        className: 'min-h-screen bg-gray-50 flex items-center justify-center'
    }, 
        React.createElement('div', {
            className: 'max-w-md mx-auto bg-white rounded-lg shadow-md p-6 text-center'
        },
            React.createElement('h2', {
                className: 'text-2xl font-bold text-green-600 mb-4'
            }, '🎉 React Working!'),
            React.createElement('p', {
                className: 'text-gray-600'
            }, 'Your React booking system is now ready!'),
            React.createElement('button', {
                className: 'mt-4 px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600'
            }, 'Start Booking')
        )
    );
};

export default BookingApp;
