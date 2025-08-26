import React, { useState, useEffect } from 'react';

const BookingComponent = () => {
    const [packages, setPackages] = useState([]);
    const [selectedPackage, setSelectedPackage] = useState(null);
    const [loading, setLoading] = useState(true);
    const [showForm, setShowForm] = useState(false);
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        date: '',
        adults: 1,
        children: 0
    });

    useEffect(() => {
        fetch('/api/v1/packages')
            .then(res => res.json())
            .then(data => {
                setPackages(data.data || []);
                setLoading(false);
            })
            .catch(err => {
                console.error('Error:', err);
                setLoading(false);
            });
    }, []);

    const handlePackageSelect = (pkg) => {
        setSelectedPackage(pkg);
        setShowForm(true);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        
        const bookingData = {
            ...formData,
            package_id: selectedPackage.id,
            total_amount: formData.adults * selectedPackage.price + formData.children * (selectedPackage.price * 0.5)
        };

        try {
            const response = await fetch('/api/v1/bookings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(bookingData)
            });

            if (response.ok) {
                alert('Booking successful!');
                window.location.href = '/bookings/success';
            } else {
                alert('Booking failed. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Network error. Please try again.');
        }
    };

    if (loading) {
        return React.createElement('div', { className: 'text-center py-8' }, 'Loading packages...');
    }

    return React.createElement('div', { className: 'max-w-6xl mx-auto' },
        !showForm ? (
            React.createElement('div', {},
                React.createElement('h2', { className: 'text-2xl font-bold mb-6' }, 'Select Your Package'),
                React.createElement('div', { className: 'grid md:grid-cols-2 gap-6' },
                    packages.map(pkg => 
                        React.createElement('div', {
                            key: pkg.id,
                            className: 'border-2 p-6 rounded-lg cursor-pointer hover:border-orange-500 transition',
                            onClick: () => handlePackageSelect(pkg)
                        },
                            React.createElement('h3', { className: 'text-xl font-bold mb-2' }, pkg.name),
                            React.createElement('p', { className: 'text-gray-600 mb-4' }, pkg.description || 'Adventure awaits!'),
                            React.createElement('div', { className: 'text-2xl font-bold text-orange-600' }, `₹${pkg.price}`)
                        )
                    )
                )
            )
        ) : (
            React.createElement('div', {},
                React.createElement('h2', { className: 'text-2xl font-bold mb-6' }, 'Complete Your Booking'),
                React.createElement('div', { className: 'bg-orange-50 p-4 rounded-lg mb-6' },
                    React.createElement('h3', { className: 'font-bold' }, 'Selected Package: '),
                    React.createElement('p', {}, `${selectedPackage.name} - ₹${selectedPackage.price}`)
                ),
                React.createElement('form', { onSubmit: handleSubmit, className: 'space-y-4' },
                    React.createElement('div', { className: 'grid md:grid-cols-2 gap-4' },
                        React.createElement('div', {},
                            React.createElement('label', { className: 'block text-sm font-medium mb-2' }, 'Name *'),
                            React.createElement('input', {
                                type: 'text',
                                required: true,
                                className: 'w-full p-2 border rounded-lg',
                                value: formData.name,
                                onChange: (e) => setFormData({...formData, name: e.target.value})
                            })
                        ),
                        React.createElement('div', {},
                            React.createElement('label', { className: 'block text-sm font-medium mb-2' }, 'Email *'),
                            React.createElement('input', {
                                type: 'email',
                                required: true,
                                className: 'w-full p-2 border rounded-lg',
                                value: formData.email,
                                onChange: (e) => setFormData({...formData, email: e.target.value})
                            })
                        ),
                        React.createElement('div', {},
                            React.createElement('label', { className: 'block text-sm font-medium mb-2' }, 'Phone *'),
                            React.createElement('input', {
                                type: 'tel',
                                required: true,
                                className: 'w-full p-2 border rounded-lg',
                                value: formData.phone,
                                onChange: (e) => setFormData({...formData, phone: e.target.value})
                            })
                        ),
                        React.createElement('div', {},
                            React.createElement('label', { className: 'block text-sm font-medium mb-2' }, 'Date *'),
                            React.createElement('input', {
                                type: 'date',
                                required: true,
                                min: new Date().toISOString().split('T')[0],
                                className: 'w-full p-2 border rounded-lg',
                                value: formData.date,
                                onChange: (e) => setFormData({...formData, date: e.target.value})
                            })
                        ),
                        React.createElement('div', {},
                            React.createElement('label', { className: 'block text-sm font-medium mb-2' }, 'Adults'),
                            React.createElement('input', {
                                type: 'number',
                                min: 1,
                                className: 'w-full p-2 border rounded-lg',
                                value: formData.adults,
                                onChange: (e) => setFormData({...formData, adults: parseInt(e.target.value)})
                            })
                        ),
                        React.createElement('div', {},
                            React.createElement('label', { className: 'block text-sm font-medium mb-2' }, 'Children'),
                            React.createElement('input', {
                                type: 'number',
                                min: 0,
                                className: 'w-full p-2 border rounded-lg',
                                value: formData.children,
                                onChange: (e) => setFormData({...formData, children: parseInt(e.target.value)})
                            })
                        )
                    ),
                    React.createElement('div', { className: 'bg-gray-100 p-4 rounded-lg' },
                        React.createElement('div', { className: 'flex justify-between text-lg font-bold' },
                            React.createElement('span', {}, 'Total Amount:'),
                            React.createElement('span', { className: 'text-orange-600' }, 
                                `₹${formData.adults * selectedPackage.price + formData.children * (selectedPackage.price * 0.5)}`)
                        )
                    ),
                    React.createElement('div', { className: 'flex gap-4' },
                        React.createElement('button', {
                            type: 'button',
                            className: 'px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400',
                            onClick: () => setShowForm(false)
                        }, 'Back'),
                        React.createElement('button', {
                            type: 'submit',
                            className: 'px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600'
                        }, 'Confirm Booking')
                    )
                )
            )
        )
    );
};

export default BookingComponent;
