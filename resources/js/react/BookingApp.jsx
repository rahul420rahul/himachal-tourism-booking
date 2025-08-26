import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import PackageList from './pages/PackageList';
import PackageDetail from './pages/PackageDetail';
import BookingForm from './pages/BookingForm';
import PaymentPage from './pages/PaymentPage';
import { Toaster } from 'react-hot-toast';

function BookingApp() {
    return (
        <Router basename="/booking">
            <Toaster position="top-right" />
            <Routes>
                <Route path="/" element={<PackageList />} />
                <Route path="/package/:id" element={<PackageDetail />} />
                <Route path="/book/:packageId" element={<BookingForm />} />
                <Route path="/payment/:bookingId" element={<PaymentPage />} />
            </Routes>
        </Router>
    );
}

export default BookingApp;
