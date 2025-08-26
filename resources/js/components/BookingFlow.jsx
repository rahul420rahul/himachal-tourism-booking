import React, { useState, useEffect } from 'react';
import { Calendar, Clock, User, Mail, Phone, CreditCard } from 'lucide-react';
import toast from 'react-hot-toast';

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
            const data = await response.json();
            setPackageData(data);
        } catch (error) {
            toast.error('Failed to load package details');
        }
    };

    const handleInputChange = (e) => {
        setBookingData({
            ...bookingData,
            [e.target.name]: e.target.value
        });
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
            
            if (data.success) {
                toast.success('Booking created successfully!');
                // Redirect to payment
                if (data.payment_url) {
                    window.location.href = data.payment_url;
                }
            } else {
                toast.error(data.message || 'Booking failed');
            }
        } catch (error) {
            toast.error('Something went wrong!');
        } finally {
            setLoading(false);
        }
    };

    if (!packageData) {
        return (
            <div className="flex justify-center items-center min-h-[400px]">
                <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            </div>
        );
    }

    return (
        <div className="max-w-4xl mx-auto p-6">
            {/* Progress Bar */}
            <div className="mb-8">
                <div className="flex items-center justify-between mb-2">
                    <div className={`flex items-center ${step >= 1 ? 'text-blue-600' : 'text-gray-400'}`}>
                        <div className={`w-10 h-10 rounded-full flex items-center justify-center ${step >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-200'}`}>
                            1
                        </div>
                        <span className="ml-2">Select Date & Time</span>
                    </div>
                    <div className={`flex items-center ${step >= 2 ? 'text-blue-600' : 'text-gray-400'}`}>
                        <div className={`w-10 h-10 rounded-full flex items-center justify-center ${step >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-200'}`}>
                            2
                        </div>
                        <span className="ml-2">Personal Details</span>
                    </div>
                    <div className={`flex items-center ${step >= 3 ? 'text-blue-600' : 'text-gray-400'}`}>
                        <div className={`w-10 h-10 rounded-full flex items-center justify-center ${step >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-200'}`}>
                            3
                        </div>
                        <span className="ml-2">Confirmation</span>
                    </div>
                </div>
                <div className="w-full bg-gray-200 h-2 rounded-full">
                    <div className={`bg-blue-600 h-2 rounded-full transition-all duration-300`} style={{ width: `${(step / 3) * 100}%` }}></div>
                </div>
            </div>

            {/* Package Info */}
            <div className="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-6 rounded-lg mb-6">
                <h2 className="text-2xl font-bold mb-2">{packageData.name}</h2>
                <div className="flex items-center justify-between">
                    <span className="text-lg">{packageData.description}</span>
                    <span className="text-3xl font-bold">₹{packageData.price}</span>
                </div>
            </div>

            {/* Step 1: Date & Time Selection */}
            {step === 1 && (
                <div className="bg-white rounded-lg shadow-lg p-6">
                    <h3 className="text-xl font-semibold mb-4 flex items-center">
                        <Calendar className="mr-2" /> Select Date & Time
                    </h3>
                    
                    <div className="mb-4">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Select Date</label>
                        <input
                            type="date"
                            name="date"
                            value={bookingData.date}
                            onChange={handleInputChange}
                            min={new Date().toISOString().split('T')[0]}
                            className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            required
                        />
                    </div>

                    <div className="mb-4">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Select Time Slot</label>
                        <select
                            name="time_slot"
                            value={bookingData.time_slot}
                            onChange={handleInputChange}
                            className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
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

                    <div className="mb-6">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Number of Participants</label>
                        <input
                            type="number"
                            name="participants"
                            value={bookingData.participants}
                            onChange={handleInputChange}
                            min="1"
                            max="10"
                            className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        />
                    </div>

                    <button
                        onClick={() => setStep(2)}
                        disabled={!bookingData.date || !bookingData.time_slot}
                        className="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 disabled:bg-gray-400 transition duration-200"
                    >
                        Continue
                    </button>
                </div>
            )}

            {/* Step 2: Personal Details */}
            {step === 2 && (
                <div className="bg-white rounded-lg shadow-lg p-6">
                    <h3 className="text-xl font-semibold mb-4 flex items-center">
                        <User className="mr-2" /> Personal Details
                    </h3>
                    
                    <div className="mb-4">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input
                            type="text"
                            name="name"
                            value={bookingData.name}
                            onChange={handleInputChange}
                            className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your full name"
                            required
                        />
                    </div>

                    <div className="mb-4">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input
                            type="email"
                            name="email"
                            value={bookingData.email}
                            onChange={handleInputChange}
                            className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="your@email.com"
                            required
                        />
                    </div>

                    <div className="mb-6">
                        <label className="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input
                            type="tel"
                            name="phone"
                            value={bookingData.phone}
                            onChange={handleInputChange}
                            className="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="+91 98765 43210"
                            required
                        />
                    </div>

                    <div className="flex gap-4">
                        <button
                            onClick={() => setStep(1)}
                            className="w-full bg-gray-200 text-gray-700 py-3 rounded-lg hover:bg-gray-300 transition duration-200"
                        >
                            Back
                        </button>
                        <button
                            onClick={() => setStep(3)}
                            disabled={!bookingData.name || !bookingData.email || !bookingData.phone}
                            className="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 disabled:bg-gray-400 transition duration-200"
                        >
                            Continue
                        </button>
                    </div>
                </div>
            )}

            {/* Step 3: Confirmation */}
            {step === 3 && (
                <div className="bg-white rounded-lg shadow-lg p-6">
                    <h3 className="text-xl font-semibold mb-4 flex items-center">
                        <CreditCard className="mr-2" /> Booking Summary
                    </h3>
                    
                    <div className="bg-gray-50 p-4 rounded-lg mb-6">
                        <div className="grid grid-cols-2 gap-4">
                            <div>
                                <p className="text-sm text-gray-600">Package</p>
                                <p className="font-semibold">{packageData.name}</p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Price</p>
                                <p className="font-semibold">₹{packageData.price}</p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Date</p>
                                <p className="font-semibold">{bookingData.date}</p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Time</p>
                                <p className="font-semibold">{bookingData.time_slot}</p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Name</p>
                                <p className="font-semibold">{bookingData.name}</p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Email</p>
                                <p className="font-semibold">{bookingData.email}</p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Phone</p>
                                <p className="font-semibold">{bookingData.phone}</p>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Participants</p>
                                <p className="font-semibold">{bookingData.participants}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-blue-50 border border-blue-200 p-4 rounded-lg mb-6">
                        <div className="flex justify-between items-center">
                            <span className="text-lg font-semibold">Total Amount:</span>
                            <span className="text-2xl font-bold text-blue-600">₹{packageData.price * bookingData.participants}</span>
                        </div>
                    </div>

                    <div className="flex gap-4">
                        <button
                            onClick={() => setStep(2)}
                            className="w-full bg-gray-200 text-gray-700 py-3 rounded-lg hover:bg-gray-300 transition duration-200"
                        >
                            Back
                        </button>
                        <button
                            onClick={handleSubmit}
                            disabled={loading}
                            className="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 disabled:bg-gray-400 transition duration-200 flex items-center justify-center"
                        >
                            {loading ? (
                                <div className="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                            ) : (
                                <>
                                    <CreditCard className="mr-2" />
                                    Proceed to Payment
                                </>
                            )}
                        </button>
                    </div>
                </div>
            )}
        </div>
    );
};

export default BookingFlow;
