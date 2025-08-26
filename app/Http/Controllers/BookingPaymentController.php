<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Razorpay\Api\Api;

class BookingPaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'participants' => 'required|min:1'
        ]);

        // Store in session
        session(['booking_data' => $validated]);
        
        // Return Razorpay config
        return response()->json([
            'key' => config('services.razorpay.key'),
            'amount' => $validated['amount'] ?? 1000,
            'currency' => 'INR'
        ]);
    }

    public function confirmBooking(Request $request)
    {
        $bookingData = session('booking_data');
        
        // Save to database
        $booking = Booking::create([
            'package_id' => $bookingData['package_id'],
            'user_name' => $bookingData['name'],
            'user_email' => $bookingData['email'],
            'user_phone' => $bookingData['phone'],
            'booking_date' => $bookingData['date'],
            'booking_time' => $bookingData['time'],
            'participants' => $bookingData['participants'],
            'payment_id' => $request->payment_id,
            'status' => 'confirmed'
        ]);

        return response()->json(['success' => true, 'booking_id' => $booking->id]);
    }
}
