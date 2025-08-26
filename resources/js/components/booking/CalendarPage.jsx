import React, { useState, useEffect } from 'react';

const CalendarPage = ({ onNext, onUpdate, data }) => {
    const [selectedDate, setSelectedDate] = useState(data.date || '');
    const [selectedTime, setSelectedTime] = useState(data.time || '');
    const [availableSlots, setAvailableSlots] = useState([]);

    useEffect(() => {
        if (selectedDate) {
            // Fetch available slots from Laravel backend
            fetch(`/api/available-slots?date=${selectedDate}`)
                .then(response => response.json())
                .then(data => setAvailableSlots(data.slots || []));
        }
    }, [selectedDate]);

    const handleNext = () => {
        if (selectedDate && selectedTime) {
            onUpdate({ date: selectedDate, time: selectedTime });
            onNext();
        }
    };

    return (
        <div className="container mx-auto px-4 py-8">
            <div className="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
                <h2 className="text-2xl font-bold text-center mb-6">Select Date & Time</h2>
                
                <div className="mb-4">
                    <label className="block text-sm font-medium mb-2">Select Date</label>
                    <input 
                        type="date" 
                        value={selectedDate}
                        onChange={(e) => setSelectedDate(e.target.value)}
                        min={new Date().toISOString().split('T')[0]}
                        className="w-full px-3 py-2 border border-gray-300 rounded-md"
                    />
                </div>

                {selectedDate && (
                    <div className="mb-6">
                        <label className="block text-sm font-medium mb-2">Select Time</label>
                        <div className="grid grid-cols-3 gap-2">
                            {availableSlots.map((slot, index) => (
                                <button
                                    key={index}
                                    onClick={() => setSelectedTime(slot)}
                                    className={`px-3 py-2 text-sm rounded border ${
                                        selectedTime === slot 
                                            ? 'bg-blue-500 text-white' 
                                            : 'bg-white text-gray-700 hover:bg-gray-50'
                                    }`}
                                >
                                    {slot}
                                </button>
                            ))}
                        </div>
                    </div>
                )}

                <button 
                    onClick={handleNext}
                    disabled={!selectedDate || !selectedTime}
                    className="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Continue to Details
                </button>
            </div>
        </div>
    );
};

export default CalendarPage;
