import React, { useState, useEffect } from 'react';
import { Calendar, Users, Phone, Mail, Clock, MapPin, AlertCircle, CheckCircle } from 'lucide-react';

// Package Card Component
const PackageCard = ({ package: pkg, onSelect, isSelected }) => {
  return (
    <div 
      onClick={() => onSelect(pkg)}
      className={`border-2 rounded-xl p-6 cursor-pointer transition-all transform hover:scale-105 ${
        isSelected 
          ? 'border-orange-500 bg-orange-50 shadow-xl' 
          : 'border-gray-200 hover:border-orange-300 hover:shadow-lg'
      }`}
    >
      <div className="flex justify-between items-start mb-4">
        <h3 className="text-xl font-bold text-gray-800">{pkg.name}</h3>
        {isSelected && <CheckCircle className="text-orange-500 w-6 h-6" />}
      </div>
      <p className="text-gray-600 mb-4">{pkg.description}</p>
      <div className="space-y-2">
        <div className="flex items-center text-sm text-gray-500">
          <Clock className="w-4 h-4 mr-2" />
          <span>{pkg.duration}</span>
        </div>
        <div className="flex items-center justify-between">
          <span className="text-2xl font-bold text-orange-600">₹{pkg.price}</span>
          <span className="text-sm text-gray-500">per person</span>
        </div>
      </div>
    </div>
  );
};

// Main Booking Component
const BookingSystem = () => {
  const [packages, setPackages] = useState([]);
  const [selectedPackage, setSelectedPackage] = useState(null);
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    date: '',
    adults: 1,
    children: 0
  });

  useEffect(() => {
    // Fetch packages from API
    fetch('/api/v1/packages')
      .then(res => res.json())
      .then(data => {
        console.log('Packages loaded:', data);
        setPackages(data.data || []);
      })
      .catch(err => console.error('Error loading packages:', err));
  }, []);

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    const bookingData = {
      ...formData,
      package_id: selectedPackage?.id,
      total_amount: selectedPackage ? (formData.adults * selectedPackage.price) : 0
    };

    console.log('Submitting booking:', bookingData);

    try {
      const response = await fetch('/api/v1/bookings', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify(bookingData)
      });

      const result = await response.json();
      
      if (response.ok) {
        alert('Booking successful!');
        window.location.href = '/bookings/success';
      } else {
        alert('Booking failed: ' + (result.message || 'Unknown error'));
      }
    } catch (error) {
      console.error('Booking error:', error);
      alert('Network error. Please try again.');
    }
  };

  return (
    <div className="max-w-6xl mx-auto p-6">
      <h2 className="text-3xl font-bold mb-8 text-center">Book Your Paragliding Adventure</h2>
      
      {/* Package Selection */}
      <div className="mb-8">
        <h3 className="text-xl font-semibold mb-4">Step 1: Select Package</h3>
        <div className="grid md:grid-cols-2 gap-6">
          {packages.length > 0 ? (
            packages.map(pkg => (
              <PackageCard
                key={pkg.id}
                package={pkg}
                onSelect={setSelectedPackage}
                isSelected={selectedPackage?.id === pkg.id}
              />
            ))
          ) : (
            <p>Loading packages...</p>
          )}
        </div>
      </div>

      {/* Booking Form */}
      {selectedPackage && (
        <form onSubmit={handleSubmit} className="bg-white p-6 rounded-lg shadow-lg">
          <h3 className="text-xl font-semibold mb-4">Step 2: Your Details</h3>
          
          <div className="grid md:grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium mb-2">Name *</label>
              <input
                type="text"
                required
                value={formData.name}
                onChange={(e) => setFormData({...formData, name: e.target.value})}
                className="w-full p-2 border rounded-lg"
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium mb-2">Email *</label>
              <input
                type="email"
                required
                value={formData.email}
                onChange={(e) => setFormData({...formData, email: e.target.value})}
                className="w-full p-2 border rounded-lg"
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium mb-2">Phone *</label>
              <input
                type="tel"
                required
                value={formData.phone}
                onChange={(e) => setFormData({...formData, phone: e.target.value})}
                className="w-full p-2 border rounded-lg"
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium mb-2">Date *</label>
              <input
                type="date"
                required
                min={new Date().toISOString().split('T')[0]}
                value={formData.date}
                onChange={(e) => setFormData({...formData, date: e.target.value})}
                className="w-full p-2 border rounded-lg"
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium mb-2">Adults</label>
              <input
                type="number"
                min="1"
                value={formData.adults}
                onChange={(e) => setFormData({...formData, adults: parseInt(e.target.value)})}
                className="w-full p-2 border rounded-lg"
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium mb-2">Children</label>
              <input
                type="number"
                min="0"
                value={formData.children}
                onChange={(e) => setFormData({...formData, children: parseInt(e.target.value)})}
                className="w-full p-2 border rounded-lg"
              />
            </div>
          </div>

          <div className="mt-6 p-4 bg-gray-100 rounded-lg">
            <div className="flex justify-between text-lg font-semibold">
              <span>Total Amount:</span>
              <span className="text-orange-600">₹{formData.adults * (selectedPackage?.price || 0)}</span>
            </div>
          </div>

          <button
            type="submit"
            className="mt-6 w-full bg-orange-500 text-white py-3 rounded-lg font-semibold hover:bg-orange-600 transition"
          >
            Book Now
          </button>
        </form>
      )}
    </div>
  );
};

export default BookingSystem;
