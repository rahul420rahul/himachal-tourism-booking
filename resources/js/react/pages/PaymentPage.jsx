import React from 'react';
import { useParams } from 'react-router-dom';

function PaymentPage() {
    const { bookingId } = useParams();
    
    return (
        <div className="container mx-auto px-4 py-8">
            <h1 className="text-3xl font-bold mb-4">Payment Processing</h1>
            <p>Booking ID: {bookingId}</p>
        </div>
    );
}

export default PaymentPage;
