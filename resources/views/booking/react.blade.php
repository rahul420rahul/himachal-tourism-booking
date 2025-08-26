@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div id="react-booking-app" data-package-id="{{ $package_id }}"></div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script type="text/babel">
const { useState, useEffect } = React;

const BookingFlow = ({ packageId }) => {
    const [loading, setLoading] = useState(false);
    const [step, setStep] = useState(1);
    const [packageData, setPackageData] = useState(null);
    const [bookingData, setBookingData] = useState({
        package_id: packageId,
        date: '',
        time_slot: '',
        name: '',
        email: '',
        phone: '',
        participants: 1
    });

    useEffect(() => {
        fetchPackageDetails();
    }, [packageId]);

    const fetchPackageDetails = async () => {
        try {
            const response = await fetch(`/api/booking-api/packages/${packageId}`);
            const result = await response.json();
            if (result.success && result.data) {
                setPackageData(result.data);
            }
        } catch (error) {
            console.error('Failed to load package details');
        }
    };

    const handleInputChange = (e) => {
        setBookingData({
            ...bookingData,
            [e.target.name]: e.target.value
        });
    };

    const handlePayment = (bookingResponse) => {
        const options = {
            key: bookingResponse.razorpay_key,
            amount: bookingResponse.amount * 100,
            currency: "INR",
            name: "MyBirBilling",
            description: packageData.name + " Booking",
            order_id: bookingResponse.razorpay_order_id,
            handler: async function (response) {
                // Payment successful - verify it
                console.log('Payment response:', response);
                
                try {
                    const verifyResponse = await fetch('/api/booking-api/verify-payment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            booking_id: bookingResponse.booking_id,
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature
                        })
                    });

                    const verifyData = await verifyResponse.json();
                    console.log('Verification response:', verifyData);
                    
                    if (verifyData.success) {
                        // Show success message
                        alert('Payment successful! Booking confirmed.');
                        // Redirect to success page
                        window.location.href = `/bookings/${bookingResponse.booking_id}/success`;
                    } else {
                        alert('Payment verification failed. Please contact support.');
                        console.error('Verification failed:', verifyData);
                    }
                } catch (error) {
                    console.error('Verification error:', error);
                    // Even if verification fails, payment is done, so show partial success
                    alert('Payment received but verification pending. Your booking ID is: ' + bookingResponse.booking_id);
                }
            },
            prefill: {
                name: bookingData.name,
                email: bookingData.email,
                contact: bookingData.phone
            },
            theme: {
                color: "#3B82F6"
            },
            modal: {
                ondismiss: function(){
                    console.log('Payment cancelled by user');
                }
            }
        };
        
        const razorpay = new Razorpay(options);
        razorpay.on('payment.failed', function (response){
            alert('Payment failed: ' + response.error.description);
        });
        razorpay.open();
    };

    const handleSubmit = async () => {
        setLoading(true);
        try {
            const response = await fetch('/api/booking-api/create-booking', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(bookingData)
            });

            const data = await response.json();
            console.log('Booking response:', data);
            
            if (data.success) {
                // Directly open Razorpay
                handlePayment(data);
            } else {
                alert(data.message || 'Booking failed');
                console.error('Booking failed:', data);
            }
        } catch (error) {
            alert('Something went wrong!');
            console.error('Submit error:', error);
        } finally {
            setLoading(false);
        }
    };

    if (!packageData) {
        return (
            <div className="flex justify-center items-center min-h-[400px]">
                <div className="text-center">
                    <div className="animate-pulse">Loading package details...</div>
                </div>
            </div>
        );
    }

    return (
        <div className="max-w-4xl mx-auto p-6">
            {/* Progress Bar */}
            <div className="mb-8">
                <div className="flex items-center justify-between mb-4">
                    <div className={`flex items-center ${step >= 1 ? 'text-blue-600' : 'text-gray-400'}`}>
                        <div className={`w-10 h-10 rounded-full flex items-center justify-center ${step >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-200'}`}>
                            1
                        </div>
                        <span className="ml-2 hidden sm:inline">Select Date & Time</span>
                    </div>
                    <div className={`flex items-center ${step >= 2 ? 'text-blue-600' : 'text-gray-400'}`}>
                        <div className={`w-10 h-10 rounded-full flex items-center justify-center ${step >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-200'}`}>
                            2
                        </div>
                        <span className="ml-2 hidden sm:inline">Personal Details</span>
                    </div>
                    <div className={`flex items-center ${step >= 3 ? 'text-blue-600' : 'text-gray-400'}`}>
                        <div className={`w-10 h-10 rounded-full flex items-center justify-center ${step >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-200'}`}>
                            3
                        </div>
                        <span className="ml-2 hidden sm:inline">Confirmation</span>
                    </div>
                </div>
            </div>

            {/* Package Info */}
            <div className="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6 rounded-lg mb-6 shadow-xl">
                <h2 className="text-2xl font-bold mb-2">{packageData.name}</h2>
                <div className="flex items-center justify-between">
                    <span className="text-lg opacity-90">{packageData.description || 'Amazing Experience'}</span>
                    <span className="text-3xl font-bold">₹{packageData.price}</span>
                </div>
            </div>

            {/* Step 1: Date & Time Selection */}
            {step === 1 && (
                <div className="bg-white rounded-lg shadow-lg p-6">
                    <h3 className="text-xl font-semibold mb-6 flex items-center">
                        📅 Select Date & Time
                    </h3>
                    
                    <div className="space-y-4">
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
                            <input
                                type="date"
                                name="date"
                                value={bookingData.date}
                                onChange={handleInputChange}
                                min={new Date().toISOString().split('T')[0]}
                                className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required
                            />
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-2">Select Time Slot</label>
                            <select
                                name="time_slot"
                                value={bookingData.time_slot}
                                onChange={handleInputChange}
                                className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required
                            >
                                <option value="">Choose a time slot</option>
                                <option value="09:00 AM">09:00 AM</option>
                                <option value="10:00 AM">10:00 AM</option>
                                <option value="11:00 AM">11:00 AM</option>
                                <option value="02:00 PM">02:00 PM</option>
                                <option value="03:00 PM">03:00 PM</option>
                                <option value="04:00 PM">04:00 PM</option>
                            </select>
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-2">Number of Participants</label>
                            <input
                                type="number"
                                name="participants"
                                value={bookingData.participants}
                                onChange={handleInputChange}
                                min="1"
                                max={packageData.max_participants || 10}
                                className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <button
                            onClick={() => setStep(2)}
                            disabled={!bookingData.date || !bookingData.time_slot}
                            className="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition duration-200 font-semibold"
                        >
                            Continue to Details →
                        </button>
                    </div>
                </div>
            )}

            {/* Step 2: Personal Details */}
            {step === 2 && (
                <div className="bg-white rounded-lg shadow-lg p-6">
                    <h3 className="text-xl font-semibold mb-6 flex items-center">
                        👤 Personal Details
                    </h3>
                    
                    <div className="space-y-4">
                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input
                                type="text"
                                name="name"
                                value={bookingData.name}
                                onChange={handleInputChange}
                                className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter your full name"
                                required
                            />
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                value={bookingData.email}
                                onChange={handleInputChange}
                                className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="your@email.com"
                                required
                            />
                        </div>

                        <div>
                            <label className="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input
                                type="tel"
                                name="phone"
                                value={bookingData.phone}
                                onChange={handleInputChange}
                                className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="+91 98765 43210"
                                required
                            />
                        </div>

                        <div className="flex gap-4">
                            <button
                                onClick={() => setStep(1)}
                                className="w-full bg-gray-200 text-gray-700 py-3 rounded-lg hover:bg-gray-300 transition duration-200 font-semibold"
                            >
                                ← Back
                            </button>
                            <button
                                onClick={() => setStep(3)}
                                disabled={!bookingData.name || !bookingData.email || !bookingData.phone}
                                className="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition duration-200 font-semibold"
                            >
                                Review Booking →
                            </button>
                        </div>
                    </div>
                </div>
            )}

            {/* Step 3: Confirmation */}
            {step === 3 && (
                <div className="bg-white rounded-lg shadow-lg p-6">
                    <h3 className="text-xl font-semibold mb-6 flex items-center">
                        ✅ Booking Summary
                    </h3>
                    
                    <div className="bg-gray-50 p-6 rounded-lg mb-6">
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div className="border-b pb-2">
                                <p className="text-sm text-gray-600">Package</p>
                                <p className="font-semibold">{packageData.name}</p>
                            </div>
                            <div className="border-b pb-2">
                                <p className="text-sm text-gray-600">Price per person</p>
                                <p className="font-semibold">₹{packageData.price}</p>
                            </div>
                            <div className="border-b pb-2">
                                <p className="text-sm text-gray-600">Date</p>
                                <p className="font-semibold">{bookingData.date}</p>
                            </div>
                            <div className="border-b pb-2">
                                <p className="text-sm text-gray-600">Time</p>
                                <p className="font-semibold">{bookingData.time_slot}</p>
                            </div>
                            <div className="border-b pb-2">
                                <p className="text-sm text-gray-600">Name</p>
                                <p className="font-semibold">{bookingData.name}</p>
                            </div>
                            <div className="border-b pb-2">
                                <p className="text-sm text-gray-600">Email</p>
                                <p className="font-semibold">{bookingData.email}</p>
                            </div>
                            <div className="border-b pb-2">
                                <p className="text-sm text-gray-600">Phone</p>
                                <p className="font-semibold">{bookingData.phone}</p>
                            </div>
                            <div className="border-b pb-2">
                                <p className="text-sm text-gray-600">Participants</p>
                                <p className="font-semibold">{bookingData.participants}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-blue-50 border-2 border-blue-200 p-4 rounded-lg mb-6">
                        <div className="flex justify-between items-center">
                            <span className="text-lg font-semibold">Total Amount:</span>
                            <span className="text-3xl font-bold text-blue-600">₹{packageData.price * bookingData.participants}</span>
                        </div>
                    </div>

                    <div className="flex gap-4">
                        <button
                            onClick={() => setStep(2)}
                            className="w-full bg-gray-200 text-gray-700 py-3 rounded-lg hover:bg-gray-300 transition duration-200 font-semibold"
                        >
                            ← Back
                        </button>
                        <button
                            onClick={handleSubmit}
                            disabled={loading}
                            className="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition duration-200 font-semibold flex items-center justify-center"
                        >
                            {loading ? (
                                <span>Processing...</span>
                            ) : (
                                <span>💳 Proceed to Payment</span>
                            )}
                        </button>
                    </div>
                </div>
            )}
        </div>
    );
};

// Mount the app
const container = document.getElementById('react-booking-app');
const packageId = container.getAttribute('data-package-id');
const root = ReactDOM.createRoot(container);
root.render(<BookingFlow packageId={packageId} />);
</script>
@endpush
