import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';

// Setup axios
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

function BookingApp() {
    const [packages, setPackages] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    
    useEffect(() => {
        fetchPackages();
    }, []);
    
    const fetchPackages = async () => {
        try {
            const response = await axios.get('/api/react/packages');
            console.log('Packages loaded:', response.data);
            setPackages(response.data);
            setError(null);
        } catch (err) {
            console.error('Error loading packages:', err);
            setError('Failed to load packages. Please try again.');
        } finally {
            setLoading(false);
        }
    };
    
    if (loading) {
        return (
            <div className="flex justify-center items-center min-h-screen">
                <div className="text-center">
                    <div className="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500 mx-auto"></div>
                    <p className="mt-4 text-gray-600">Loading packages...</p>
                </div>
            </div>
        );
    }
    
    if (error) {
        return (
            <div className="flex justify-center items-center min-h-screen">
                <div className="text-center text-red-600">
                    <p>{error}</p>
                    <button 
                        onClick={fetchPackages}
                        className="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                    >
                        Retry
                    </button>
                </div>
            </div>
        );
    }
    
    return (
        <div className="container mx-auto px-4 py-8">
            <h1 className="text-4xl font-bold text-center mb-8">
                Choose Your Adventure Package
            </h1>
            
            {packages.length === 0 ? (
                <div className="text-center text-gray-600">
                    <p>No packages available at the moment.</p>
                </div>
            ) : (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {packages.map((pkg) => (
                        <div
                            key={pkg.id}
                            className="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow"
                        >
                            <div className="h-48 bg-gradient-to-r from-blue-400 to-blue-600"></div>
                            <div className="p-6">
                                <h2 className="text-xl font-semibold mb-2">{pkg.name}</h2>
                                <p className="text-gray-600 mb-4">
                                    {pkg.description || 'Amazing paragliding experience'}
                                </p>
                                <div className="flex justify-between items-center">
                                    <span className="text-2xl font-bold text-blue-600">
                                        ₹{pkg.price}
                                    </span>
                                    <button 
                                        onClick={() => window.location.href = `/bookings/create?package_id=${pkg.id}`}
                                        className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition"
                                    >
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
}

// Mount the app
const container = document.getElementById('react-booking-app');
if (container) {
    const root = ReactDOM.createRoot(container);
    root.render(<BookingApp />);
}
