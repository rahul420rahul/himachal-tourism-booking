<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Package;

class BookingApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required|string',
            'user_name' => 'required|string',
            'user_email' => 'required|email',
            'user_phone' => 'required|string',
            'participants' => 'required|integer|min:1',
            'total_amount' => 'required|numeric',
            'payment_id' => 'required|string',
            'status' => 'required|string'
        ]);

        try {
            $booking = Booking::create($validated);
            
            // Send email notification (optional)
            // Mail::to($validated['user_email'])->send(new BookingConfirmation($booking));
            
            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully',
                'booking_id' => $booking->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
