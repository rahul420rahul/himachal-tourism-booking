import React from 'react';
import { useParams, Link } from 'react-router-dom';

function PackageDetail() {
    const { id } = useParams();
    
    return (
        <div className="container mx-auto px-4 py-8">
            <h1 className="text-3xl font-bold mb-4">Package Details</h1>
            <p>Package ID: {id}</p>
            <Link to={`/book/${id}`} className="bg-blue-500 text-white px-4 py-2 rounded">
                Book Now
            </Link>
        </div>
    );
}

export default PackageDetail;
