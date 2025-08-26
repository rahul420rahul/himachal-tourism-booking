@extends('layouts.app')

@section('content')
<div id="react-booking-root" 
     data-package-id="{{ request()->route('id') ?? '' }}"
     data-package-name=""
     data-package-price="">
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    window.RAZORPAY_KEY = "{{ env('RAZORPAY_KEY_ID') }}";
</script>

<script type="text/babel">
    const { useState, useEffect, useCallback } = React;
    
    function BookingApp() {
        const rootEl = document.getElementById('react-booking-root');
        const initialPackageId = rootEl.dataset.packageId;
        
        const [currentStep, setCurrentStep] = useState('packages');
        const [packages, setPackages] = useState([]);
        const [selectedPackage, setSelectedPackage] = useState(null);
        const [selectedDate, setSelectedDate] = useState('');
        const [selectedTime, setSelectedTime] = useState('');
        const [formData, setFormData] = useState({
            userName: '',
            userEmail: '',
            userPhone: '',
            participants: 1,
            specialRequests: ''
        });
        const [processing, setProcessing] = useState(false);
        
        useEffect(() => {
            fetch('/api/packages')
                .then(res => res.json())
                .then(data => {
                    setPackages(data);
                    if (initialPackageId) {
                        const pkg = data.find(p => p.id == initialPackageId);
                        if (pkg) {
                            setSelectedPackage(pkg);
                            setCurrentStep('calendar');
                        }
                    }
                })
                .catch(err => console.error('Error fetching packages:', err));
        }, []);
        
        const handleInputChange = useCallback((e) => {
            const { name, value } = e.target;
            setFormData(prev => ({
                ...prev,
                [name]: value
            }));
        }, []);
        
        const handlePackageSelect = (pkg) => {
            setSelectedPackage(pkg);
            setCurrentStep('calendar');
        };
        
        const handleDateSelect = (date) => {
            setSelectedDate(date);
            setCurrentStep('time');
        };
        
        const handleTimeSelect = (time) => {
            setSelectedTime(time);
            setCurrentStep('details');
        };
        
        const generateCalendarDays = () => {
            const days = [];
            const today = new Date();
            for (let i = 0; i < 30; i++) {
                const date = new Date(today);
                date.setDate(today.getDate() + i);
                days.push(date.toISOString().split('T')[0]);
            }
            return days;
        };
        
        const timeSlots = ['06:00 AM', '09:00 AM', '12:00 PM', '03:00 PM', '06:00 PM'];
        
        const totalAmount = selectedPackage ? selectedPackage.price * formData.participants : 0;
        const advanceAmount = totalAmount * 0.2;
        const balanceAmount = totalAmount - advanceAmount;
        
        const handleAdvancePayment = async () => {
            if (!formData.userName || !formData.userEmail || !formData.userPhone) {
                alert('Please fill all required fields');
                return;
            }
            
            setProcessing(true);
            
            const options = {
                key: window.RAZORPAY_KEY,
                amount: Math.round(advanceAmount * 100),
                currency: 'INR',
                name: 'MyBirBilling',
                description: 'Advance for ' + selectedPackage.name,
                handler: async function(response) {
                    try {
                        const bookingData = {
                            package_id: selectedPackage.id,
                            booking_date: selectedDate,
                            booking_time: selectedTime,
                            user_name: formData.userName,
                            user_email: formData.userEmail,
                            user_phone: formData.userPhone,
                            participants: formData.participants,
                            total_amount: totalAmount,
                            advance_amount: advanceAmount,
                            balance_due: balanceAmount,
                            payment_type: 'advance',
                            payment_id: response.razorpay_payment_id,
                            special_requests: formData.specialRequests
                        };
                        
                        const res = await fetch('/api/bookings', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(bookingData)
                        });
                        
                        const result = await res.json();
                        if (result.success) {
                            window.location.href = '/booking-success/' + result.booking_id;
                        }
                    } catch (error) {
                        console.error('Booking error:', error);
                        alert('Booking failed. Please try again.');
                    }
                    setProcessing(false);
                },
                modal: {
                    ondismiss: () => setProcessing(false)
                }
            };
            
            const rzp = new Razorpay(options);
            rzp.open();
        };
        
        const renderStep = () => {
            switch(currentStep) {
                case 'packages':
                    return (
                        <div>
                            <h2 className="text-2xl font-bold mb-4">Select Package</h2>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {packages.map(pkg => (
                                    <div key={pkg.id} 
                                         onClick={() => handlePackageSelect(pkg)}
                                         className="border rounded p-4 cursor-pointer hover:bg-blue-50">
                                        <h3 className="font-bold">{pkg.name}</h3>
                                        <p className="text-gray-600">{pkg.duration}</p>
                                        <p className="text-2xl font-bold text-blue-600">₹{pkg.price}</p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    );
                    
                case 'calendar':
                    return (
                        <div>
                            <h2 className="text-2xl font-bold mb-4">Select Date</h2>
                            <div className="mb-4 p-3 bg-gray-50 rounded">
                                <p><strong>Selected Package:</strong> {selectedPackage?.name}</p>
                            </div>
                            <div className="grid grid-cols-7 gap-2">
                                {generateCalendarDays().map(date => (
                                    <button key={date}
                                            onClick={() => handleDateSelect(date)}
                                            className="p-2 border rounded hover:bg-blue-500 hover:text-white">
                                        {new Date(date).getDate()}
                                    </button>
                                ))}
                            </div>
                            <button onClick={() => setCurrentStep('packages')} 
                                    className="mt-4 bg-gray-500 text-white px-4 py-2 rounded">
                                Back
                            </button>
                        </div>
                    );
                    
                case 'time':
                    return (
                        <div>
                            <h2 className="text-2xl font-bold mb-4">Select Time</h2>
                            <div className="mb-4 p-3 bg-gray-50 rounded">
                                <p><strong>Package:</strong> {selectedPackage?.name}</p>
                                <p><strong>Date:</strong> {selectedDate}</p>
                            </div>
                            <div className="grid grid-cols-2 gap-4">
                                {timeSlots.map(time => (
                                    <button key={time}
                                            onClick={() => handleTimeSelect(time)}
                                            className="p-3 border rounded hover:bg-blue-500 hover:text-white">
                                        {time}
                                    </button>
                                ))}
                            </div>
                            <button onClick={() => setCurrentStep('calendar')} 
                                    className="mt-4 bg-gray-500 text-white px-4 py-2 rounded">
                                Back
                            </button>
                        </div>
                    );
                    
                case 'details':
                    return (
                        <div>
                            <h2 className="text-2xl font-bold mb-4">Personal Details</h2>
                            <div className="bg-gray-50 p-4 rounded mb-4">
                                <p><strong>Package:</strong> {selectedPackage?.name}</p>
                                <p><strong>Date:</strong> {selectedDate}</p>
                                <p><strong>Time:</strong> {selectedTime}</p>
                                <p><strong>Price per person:</strong> ₹{selectedPackage?.price}</p>
                            </div>
                            
                            <div className="space-y-4">
                                <div>
                                    <label className="block mb-2">Name*</label>
                                    <input
                                        type="text"
                                        name="userName"
                                        value={formData.userName}
                                        onChange={handleInputChange}
                                        className="w-full p-2 border rounded"
                                    />
                                </div>
                                
                                <div>
                                    <label className="block mb-2">Email*</label>
                                    <input
                                        type="email"
                                        name="userEmail"
                                        value={formData.userEmail}
                                        onChange={handleInputChange}
                                        className="w-full p-2 border rounded"
                                    />
                                </div>
                                
                                <div>
                                    <label className="block mb-2">Phone*</label>
                                    <input
                                        type="tel"
                                        name="userPhone"
                                        value={formData.userPhone}
                                        onChange={handleInputChange}
                                        className="w-full p-2 border rounded"
                                    />
                                </div>
                                
                                <div>
                                    <label className="block mb-2">Number of Participants*</label>
                                    <input
                                        type="number"
                                        name="participants"
                                        min="1"
                                        value={formData.participants}
                                        onChange={handleInputChange}
                                        className="w-full p-2 border rounded"
                                    />
                                </div>
                            </div>
                            
                            <div className="bg-blue-50 p-4 rounded my-6">
                                <h3 className="font-semibold mb-2">Payment Summary</h3>
                                <p className="flex justify-between">
                                    <span>Total Amount:</span>
                                    <span className="font-bold">₹{totalAmount}</span>
                                </p>
                                <p className="flex justify-between text-green-600">
                                    <span>Advance Payment (20%):</span>
                                    <span className="font-bold">₹{advanceAmount}</span>
                                </p>
                                <p className="flex justify-between text-orange-600">
                                    <span>Balance (Pay at venue):</span>
                                    <span className="font-bold">₹{balanceAmount}</span>
                                </p>
                            </div>
                            
                            <div className="flex justify-between">
                                <button onClick={() => setCurrentStep('time')} 
                                        className="bg-gray-500 text-white px-6 py-2 rounded">
                                    Back
                                </button>
                                <button onClick={handleAdvancePayment}
                                        disabled={processing}
                                        className="bg-green-500 text-white px-6 py-2 rounded">
                                    Pay Advance ₹{advanceAmount}
                                </button>
                            </div>
                        </div>
                    );
                
                default:
                    return <div>Loading...</div>;
            }
        };
        
        return (
            <div className="min-h-screen bg-gray-100 py-8">
                <div className="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
                    <h1 className="text-3xl font-bold mb-6 text-center">Booking System</h1>
                    {renderStep()}
                </div>
            </div>
        );
    }
    
    const root = ReactDOM.createRoot(document.getElementById('react-booking-root'));
    root.render(<BookingApp />);
</script>
@endpush
