<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test React</title>
    <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div id="root"></div>
    
    <script type="text/babel">
        const { useState, useEffect } = React;
        
        function App() {
            const [packages, setPackages] = useState([]);
            const [loading, setLoading] = useState(true);
            
            useEffect(() => {
                fetch('/api/react/packages')
                    .then(res => res.json())
                    .then(data => {
                        console.log('Packages:', data);
                        setPackages(data);
                        setLoading(false);
                    })
                    .catch(err => {
                        console.error('Error:', err);
                        setLoading(false);
                    });
            }, []);
            
            if (loading) return <div className="p-8 text-center">Loading...</div>;
            
            return (
                <div className="container mx-auto p-8">
                    <h1 className="text-3xl font-bold mb-8">Packages</h1>
                    {packages.length === 0 ? (
                        <p>No packages found</p>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                            {packages.map(pkg => (
                                <div key={pkg.id} className="border p-4 rounded">
                                    <h2 className="text-xl font-bold">{pkg.name}</h2>
                                    <p className="text-gray-600">{pkg.description}</p>
                                    <p className="text-2xl font-bold mt-2">₹{pkg.price}</p>
                                    <a href={`/bookings/create?package_id=${pkg.id}`} 
                                       className="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                                        Book Now
                                    </a>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            );
        }
        
        ReactDOM.render(<App />, document.getElementById('root'));
    </script>
</body>
</html>
