import React from 'react';
import ReactDOM from 'react-dom/client';

const BookingApp = () => {
    const [loading, setLoading] = React.useState(false);
    const [packages, setPackages] = React.useState([]);
    
    React.useEffect(() => {
        setLoading(true);
        fetch('/api/packages')
            .then(res => res.json())
            .then(data => {
                console.log('API Response:', data);
                setPackages(data || []);
                setLoading(false);
            })
            .catch(err => {
                console.error('Error:', err);
                setLoading(false);
            });
    }, []);
    
    return (
        <div style={{ padding: '20px' }}>
            <h1>Booking System</h1>
            {loading ? (
                <p>Loading...</p>
            ) : (
                <div>
                    <h2>Available Packages: {packages.length}</h2>
                    {packages.map((pkg, index) => (
                        <div key={index} style={{ border: '1px solid #ccc', padding: '10px', margin: '10px 0' }}>
                            <h3>{pkg.name || 'Package ' + (index + 1)}</h3>
                            <p>Price: ₹{pkg.price || 'N/A'}</p>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
};

// Direct mount without waiting for DOMContentLoaded
const container = document.getElementById('react-booking-root');
if (container) {
    const root = ReactDOM.createRoot(container);
    root.render(<BookingApp />);
}
