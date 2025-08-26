import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';

const QuickBookingModal = ({ packageData }) => {
    const [step, setStep] = useState(1);
    const [loading, setLoading] = useState(false);
    const [formData, setFormData] = useState({
        package_id: packageData.id,
        booking_date: '',
        adults: 1,
        children: 0,
        guest_name: '',
        guest_email: '',
        guest_phone: ''
    });

    const handleSubmit = async () => {
        setLoading(true);
        try {
            const response = await fetch('/api/bookings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });
            
            if (response.ok) {
                const data = await response.json();
                window.location.href = `/bookings/${data.booking_id}/payment`;
            }
        } catch (error) {
            alert('Booking failed. Please try again.');
            setLoading(false);
        }
    };

    const closeModal = () => {
        const container = document.getElementById('booking-modal-container');
        const root = container._reactRoot;
        if (root) {
            root.unmount();
        }
        container.style.display = 'none';
    };

    return (
        <div className="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div className="bg-white rounded-lg max-w-md w-full p-6">
                <div className="flex justify-between items-center mb-4">
                    <h2 className="text-2xl font-bold">{packageData.name}</h2>
                    <button onClick={closeModal} className="text-gray-500 text-2xl">&times;</button>
                </div>

                {step === 1 && (
                    <div>
                        <h3 className="text-lg font-semibold mb-3">Select Date & Participants</h3>
                        <input
                            type="date"
                            className="w-full p-3 border rounded mb-3"
                            min={new Date().toISOString().split('T')[0]}
                            value={formData.booking_date}
                            onChange={(e) => setFormData({...formData, booking_date: e.target.value})}
                        />
                        
                        <div className="grid grid-cols-2 gap-3 mb-4">
                            <div>
                                <label className="block text-sm mb-1">Adults</label>
                                <input
                                    type="number"
                                    min="1"
                                    className="w-full p-2 border rounded"
                                    value={formData.adults}
                                    onChange={(e) => setFormData({...formData, adults: e.target.value})}
                                />
                            </div>
                            <div>
                                <label className="block text-sm mb-1">Children</label>
                                <input
                                    type="number"
                                    min="0"
                                    className="w-full p-2 border rounded"
                                    value={formData.children}
                                    onChange={(e) => setFormData({...formData, children: e.target.value})}
                                />
                            </div>
                        </div>
                        
                        <div className="text-lg font-bold mb-4">
                            Total: ₹{packageData.price * (parseInt(formData.adults) + parseInt(formData.children))}
                        </div>
                        
                        <button 
                            onClick={() => setStep(2)}
                            className="w-full bg-orange-500 text-white py-3 rounded font-bold hover:bg-orange-600"
                        >
                            Continue
                        </button>
                    </div>
                )}

                {step === 2 && (
                    <div>
                        <h3 className="text-lg font-semibold mb-3">Your Details</h3>
                        <input
                            type="text"
                            placeholder="Full Name"
                            className="w-full p-3 border rounded mb-3"
                            value={formData.guest_name}
                            onChange={(e) => setFormData({...formData, guest_name: e.target.value})}
                        />
                        <input
                            type="email"
                            placeholder="Email"
                            className="w-full p-3 border rounded mb-3"
                            value={formData.guest_email}
                            onChange={(e) => setFormData({...formData, guest_email: e.target.value})}
                        />
                        <input
                            type="tel"
                            placeholder="Phone"
                            className="w-full p-3 border rounded mb-4"
                            value={formData.guest_phone}
                            onChange={(e) => setFormData({...formData, guest_phone: e.target.value})}
                        />
                        
                        <div className="flex gap-3">
                            <button 
                                onClick={() => setStep(1)}
                                className="flex-1 bg-gray-200 py-3 rounded font-bold"
                            >
                                Back
                            </button>
                            <button 
                                onClick={handleSubmit}
                                disabled={loading}
                                className="flex-1 bg-orange-500 text-white py-3 rounded font-bold hover:bg-orange-600"
                            >
                                {loading ? 'Processing...' : 'Book Now'}
                            </button>
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
};

window.openBookingModal = function(pkgData) {
    const container = document.getElementById('booking-modal-container');
    if (!container) {
        const div = document.createElement('div');
        div.id = 'booking-modal-container';
        document.body.appendChild(div);
    }
    const modalContainer = document.getElementById('booking-modal-container');
    modalContainer.style.display = 'block';
    const root = ReactDOM.createRoot(modalContainer);
    modalContainer._reactRoot = root;
    root.render(<QuickBookingModal packageData={pkgData} />);
};

export default QuickBookingModal;
