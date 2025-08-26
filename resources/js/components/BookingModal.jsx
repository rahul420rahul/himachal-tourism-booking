import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

const BookingModal = ({ packageId, onClose }) => {
    const [step, setStep] = useState(1);
    const [loading, setLoading] = useState(false);
    const [packageData, setPackageData] = useState(null);
    const [bookingData, setBookingData] = useState({
        package_id: packageId,
        booking_date: '',
        time_slot: '',
        guest_name: '',
        guest_email: '',
        guest_phone: '',
        adults: 1,
        children: 0
    });

    useEffect(() => {
        fetchPackage();
    }, [packageId]);

    const fetchPackage = async () => {
        try {
            const response = await fetch(`/api/packages/${packageId}`);
            const data = await response.json();
            setPackageData(data.data);
        } catch (error) {
            console.error('Failed to fetch package');
        }
    };

    const handleNext = () => setStep(step + 1);
    const handleBack = () => setStep(step - 1);

    const handleSubmit = async () => {
        setLoading(true);
        try {
            const response = await fetch('/api/react/booking', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(bookingData)
            });
            const result = await response.json();
            if (result.success) {
                initiateRazorpay(result);
            }
        } catch (error) {
            console.error('Booking failed:', error);
            setLoading(false);
        }
    };

    const initiateRazorpay = (bookingResponse) => {
        const options = {
            key: bookingResponse.razorpay_key,
            amount: bookingResponse.amount * 100,
            currency: "INR",
            name: "MyBirBilling",
            description: packageData?.name || "Adventure Package",
            order_id: bookingResponse.razorpay_order_id,
            handler: function (response) {
                verifyPayment(bookingResponse.booking_id, response);
            }
        };
        const rzp = new window.Razorpay(options);
        rzp.open();
    };

    const verifyPayment = async (bookingId, paymentResponse) => {
        try {
            const response = await fetch('/api/react/verify-payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    booking_id: bookingId,
                    ...paymentResponse
                })
            });
            const result = await response.json();
            if (result.success) {
                window.location.href = `/bookings/${bookingId}/success`;
            }
        } catch (error) {
            console.error('Payment verification failed');
        }
    };

    return (
        <div className="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div className="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div className="p-6">
                    <button onClick={onClose} className="float-right text-gray-500 hover:text-gray-700">✕</button>
                    
                    {step === 1 && packageData && (
                        <div>
                            <h2 className="text-2xl font-bold mb-4">Confirm Package</h2>
                            <div className="bg-gray-50 p-4 rounded-lg mb-4">
                                <h3 className="font-bold text-lg">{packageData.name}</h3>
                                <p className="text-gray-600">{packageData.description}</p>
                                <p className="text-2xl font-bold mt-2">₹{packageData.price}</p>
                            </div>
                            <button onClick={handleNext} className="w-full bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600">
                                Continue
                            </button>
                        </div>
                    )}

                    {step === 2 && (
                        <div>
                            <h2 className="text-2xl font-bold mb-4">Select Date & Time</h2>
                            <input
                                type="date"
                                className="w-full p-3 border rounded-lg mb-4"
                                value={bookingData.booking_date}
                                min={new Date().toISOString().split('T')[0]}
                                onChange={(e) => setBookingData({...bookingData, booking_date: e.target.value})}
                            />
                            <select
                                className="w-full p-3 border rounded-lg mb-4"
                                value={bookingData.time_slot}
                                onChange={(e) => setBookingData({...bookingData, time_slot: e.target.value})}
                            >
                                <option value="">Select Time Slot</option>
                                <option value="09:00">9:00 AM</option>
                                <option value="10:00">10:00 AM</option>
                                <option value="11:00">11:00 AM</option>
                                <option value="14:00">2:00 PM</option>
                                <option value="15:00">3:00 PM</option>
                            </select>
                            <div className="flex gap-4">
                                <button onClick={handleBack} className="flex-1 bg-gray-200 py-3 rounded-lg font-bold">Back</button>
                                <button onClick={handleNext} className="flex-1 bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600">Next</button>
                            </div>
                        </div>
                    )}

                    {step === 3 && (
                        <div>
                            <h2 className="text-2xl font-bold mb-4">Personal Details</h2>
                            <input
                                type="text"
                                placeholder="Full Name"
                                className="w-full p-3 border rounded-lg mb-4"
                                value={bookingData.guest_name}
                                onChange={(e) => setBookingData({...bookingData, guest_name: e.target.value})}
                            />
                            <input
                                type="email"
                                placeholder="Email"
                                className="w-full p-3 border rounded-lg mb-4"
                                value={bookingData.guest_email}
                                onChange={(e) => setBookingData({...bookingData, guest_email: e.target.value})}
                            />
                            <input
                                type="tel"
                                placeholder="Phone"
                                className="w-full p-3 border rounded-lg mb-4"
                                value={bookingData.guest_phone}
                                onChange={(e) => setBookingData({...bookingData, guest_phone: e.target.value})}
                            />
                            <div className="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label className="block mb-2">Adults</label>
                                    <input
                                        type="number"
                                        min="1"
                                        className="w-full p-3 border rounded-lg"
                                        value={bookingData.adults}
                                        onChange={(e) => setBookingData({...bookingData, adults: parseInt(e.target.value)})}
                                    />
                                </div>
                                <div>
                                    <label className="block mb-2">Children</label>
                                    <input
                                        type="number"
                                        min="0"
                                        className="w-full p-3 border rounded-lg"
                                        value={bookingData.children}
                                        onChange={(e) => setBookingData({...bookingData, children: parseInt(e.target.value)})}
                                    />
                                </div>
                            </div>
                            <div className="flex gap-4">
                                <button onClick={handleBack} className="flex-1 bg-gray-200 py-3 rounded-lg font-bold">Back</button>
                                <button onClick={handleSubmit} disabled={loading} className="flex-1 bg-orange-500 text-white py-3 rounded-lg font-bold hover:bg-orange-600">
                                    {loading ? 'Processing...' : 'Proceed to Payment'}
                                </button>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};

// Global function to start booking
window.startReactBooking = (packageId) => {
    const container = document.getElementById('react-booking-container');
    const root = ReactDOM.createRoot(container);
    root.render(<BookingModal packageId={packageId} onClose={() => root.unmount()} />);
};

export default BookingModal;
