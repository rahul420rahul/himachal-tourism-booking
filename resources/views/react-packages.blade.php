<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Adventure - MyBirBilling</title>
    <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div id="root"></div>
    
    <script type="text/babel">
        const { useState, useEffect } = React;
        
        function App() {
            const [packages, setPackages] = useState([]);
            const [loading, setLoading] = useState(true);
            const [selectedCategory, setSelectedCategory] = useState('all');
            
            useEffect(() => {
                fetch('/api/react/packages')
                    .then(res => res.json())
                    .then(data => {
                        setPackages(data);
                        setLoading(false);
                    })
                    .catch(err => {
                        console.error('Error:', err);
                        setLoading(false);
                    });
            }, []);
            
            const categories = {
                all: 'All Packages',
                course: 'Training Courses',
                tandem: 'Tandem Flights'
            };
            
            const filteredPackages = selectedCategory === 'all' 
                ? packages 
                : packages.filter(pkg => {
                    const name = pkg.name.toLowerCase();
                    if (selectedCategory === 'course') {
                        return name.includes('course') || name.includes('p1') || name.includes('p2') || name.includes('p3') || name.includes('p4');
                    }
                    if (selectedCategory === 'tandem') {
                        return name.includes('tandem');
                    }
                    return true;
                });
            
            if (loading) {
                return (
                    <div className="flex justify-center items-center min-h-screen">
                        <div className="text-center">
                            <div className="animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-purple-600 mx-auto"></div>
                            <p className="mt-4 text-gray-600 text-lg">Loading amazing adventures...</p>
                        </div>
                    </div>
                );
            }
            
            return (
                <div className="min-h-screen">
                    {/* Hero Section */}
                    <div className="gradient-bg text-white py-20">
                        <div className="container mx-auto px-4">
                            <h1 className="text-5xl font-bold mb-4 text-center">Choose Your Sky Adventure</h1>
                            <p className="text-xl text-center opacity-90">Professional Paragliding Courses & Tandem Flights in Bir Billing</p>
                        </div>
                    </div>
                    
                    {/* Filter Tabs */}
                    <div className="container mx-auto px-4 py-8">
                        <div className="flex justify-center space-x-4 mb-8">
                            {Object.entries(categories).map(([key, label]) => (
                                <button
                                    key={key}
                                    onClick={() => setSelectedCategory(key)}
                                    className={`px-6 py-3 rounded-full font-medium transition-all ${
                                        selectedCategory === key
                                            ? 'bg-purple-600 text-white shadow-lg'
                                            : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300'
                                    }`}
                                >
                                    {label}
                                </button>
                            ))}
                        </div>
                        
                        {/* Packages Grid */}
                        {filteredPackages.length === 0 ? (
                            <div className="text-center py-12">
                                <p className="text-gray-600 text-lg">No packages available in this category.</p>
                            </div>
                        ) : (
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                {filteredPackages.map((pkg) => (
                                    <div key={pkg.id} className="card-hover">
                                        <div className="bg-white rounded-2xl shadow-lg overflow-hidden h-full">
                                            {/* Image placeholder with gradient */}
                                            <div className="h-48 bg-gradient-to-br from-purple-400 via-pink-400 to-blue-400 relative">
                                                <div className="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                                                    <svg className="w-20 h-20 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                    </svg>
                                                </div>
                                                {pkg.name.includes('P1') || pkg.name.includes('P2') ? (
                                                    <span className="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                        Beginner
                                                    </span>
                                                ) : pkg.name.includes('P3') ? (
                                                    <span className="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                        Intermediate
                                                    </span>
                                                ) : pkg.name.includes('P4') ? (
                                                    <span className="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                        Advanced
                                                    </span>
                                                ) : (
                                                    <span className="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                        Experience
                                                    </span>
                                                )}
                                            </div>
                                            
                                            <div className="p-6">
                                                <h2 className="text-2xl font-bold mb-3 text-gray-800">{pkg.name}</h2>
                                                <p className="text-gray-600 mb-4 line-clamp-3">
                                                    {pkg.description || 'Experience the thrill of paragliding with our certified instructors'}
                                                </p>
                                                
                                                <div className="flex items-center justify-between mb-4">
                                                    <div>
                                                        <p className="text-sm text-gray-500">Starting from</p>
                                                        <p className="text-3xl font-bold text-purple-600">₹{pkg.price.toLocaleString()}</p>
                                                    </div>
                                                    <div className="text-right">
                                                        <p className="text-sm text-gray-500">Duration</p>
                                                        <p className="font-medium text-gray-800">{pkg.duration || '1 Day'}</p>
                                                    </div>
                                                </div>
                                                
                                                <a 
                                                    href={`/bookings/create?package_id=${pkg.id}`}
                                                    className="block w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white text-center py-3 rounded-lg font-medium hover:from-purple-700 hover:to-pink-700 transition-all shadow-md hover:shadow-xl"
                                                >
                                                    Book Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        )}
                    </div>
                    
                    {/* Footer CTA */}
                    <div className="bg-gray-100 py-12 mt-16">
                        <div className="container mx-auto px-4 text-center">
                            <h3 className="text-2xl font-bold mb-4">Need Help Choosing?</h3>
                            <p className="text-gray-600 mb-6">Our expert team is here to help you select the perfect adventure</p>
                            <div className="flex justify-center space-x-4">
                                <a href="tel:+919736696260" className="inline-flex items-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                    <svg className="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Call Now
                                </a>
                                <a href="https://wa.me/919736696260" className="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                    <svg className="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.149-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414-.074-.123-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                    </svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            );
        }
        
        ReactDOM.render(<App />, document.getElementById('root'));
    </script>
</body>
</html>
