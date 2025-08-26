import React, { useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';
import toast from 'react-hot-toast';

function BookingForm() {
    const { packageId } = useParams();
    const navigate = useNavigate();
    const [loading, setLoading] = useState(false);
    const [formData, setFormData] = useState({
        package_id: packageId,
        booking_date: '',
        adults: 1,
        children: 0,
        guest_name: '',
        guest_email: '',
        guest_phone: '',
        special_requests: ''
    });
    
    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        
        try {
            const response = await axios.post('/api/react/booking', formData);
            
            if (response.data.success && response.data.payment_data) {
                // Initialize Razorpay
                const options = {
                    key: response.data.payment_data.key,
                    amount: response.data.payment_data.amount,
                    currency: response.data.payment_data.currency,
                    name: response.data.payment_data.name,
                    description: response.data.payment_data.description,
                    order_id: response.data.payment_data.order_id,
                    handler: function (razorpayResponse) {
                        // Handle payment success
                        handlePaymentSuccess(razorpayResponse, response.data.booking_id);
                    },
                    prefill: response.data.payment_data.prefill,
                    theme: {
                        color: '#3399cc'
                    }
                };
                
                const rzp = new window.Razorpay(options);
                rzp.open();
            }
        } catch (error) {
            toast.error('Booking failed. Please try again.');
            console.error('Booking error:', error);
        } finally {
            setLoading(false);
        }
    };
    
    const handlePaymentSuccess = async (razorpayResponse, bookingId) => {
        try {
            const verifyResponse = await axios.post('/payments/callback', {
                razorpay_payment_id: razorpayResponse.razorpay_payment_id,
                razorpay_order_id: razorpayResponse.razorpay_order_id,
                razorpay_signature: razorpayResponse.razorpay_signature,
                booking_id: bookingId
            });
            
            toast.success('Payment successful! Booking confirmed.');
            navigate(`/booking/success/${bookingId}`);
        } catch (error) {
            toast.error('Payment verification failed.');
        }
    };
    
    return (
        <div className="max-w-2xl mx-auto p-6">
            <h1 className="text-3xl font-bold mb-6">Complete Your Booking</h1>
            
            <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                    <label className="block text-sm font-medium mb-2">Booking Date</label>
                    <input
                        type="date"
                        required
                        min={new Date().toISOString().split('T')[0]}
                        value={formData.booking_date}
                        onChange={(e) => setFormData({...formData, booking_date: e.target.value})}
                        className="w-full p-2 border rounded"
                    />
                </div>
                
                <div className="grid grid-cols-2 gap-4">
                    <div>
                        <label className="block text-sm font-medium mb-2">Adults</label>
                        <input
                            type="number"
                            min="1"
                            required
                            value={formData.adults}
                            onChange={(e) => setFormData({...formData, adults: parseInt(e.target.value)})}
                            className="w-full p-2 border rounded"
                        />
                    </div>
                    <div>
                        <label className="block text-sm font-medium mb-2">Children</label>
                        <input
                            type="number"
                            min="0"
                            value={formData.children}
                            onChange={(e) => setFormData({...formData, children: parseInt(e.target.value)})}
                            className="w-full p-2 border rounded"
                        />
                    </div>
                </div>
                
                <div>
                    <label className="block text-sm font-medium mb-2">Full Name</label>
                    <input
                        type="text"
                        required
                        value={formData.guest_name}
                        onChange={(e) => setFormData({...formData, guest_name: e.target.value})}
                        className="w-full p-2 border rounded"
                    />
                </div>
                
                <div>
                    <label className="block text-sm font-medium mb-2">Email</label>
                    <input
                        type="email"
                        required
                        value={formData.guest_email}
                        onChange={(e) => setFormData({...formData, guest_email: e.target.value})}
                        className="w-full p-2 border rounded"
                    />
                </div>
                
                <div>
                    <label className="block text-sm font-medium mb-2">Phone</label>
                    <input
                        type="tel"
                        required
                        value={formData.guest_phone}
                        onChange={(e) => setFormData({...formData, guest_phone: e.target.value})}
                        className="w-full p-2 border rounded"
                    />
                </div>
                
                <div>
                    <label className="block text-sm font-medium mb-2">Special Requests</label>
                    <textarea
                        rows="3"
                        value={formData.special_requests}
                        onChange={(e) => setFormData({...formData, special_requests: e.target.value})}
                        className="w-full p-2 border rounded"
                    />
                </div>
                
                <button
                    type="submit"
                    disabled={loading}
                    className="w-full bg-blue-500 text-white py-3 rounded hover:bg-blue-600 disabled:opacity-50"
                >
                    {loading ? 'Processing...' : 'Proceed to Payment'}
                </button>
            </form>
        </div>
    );
}

export default BookingForm;
