<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Package;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $package = Package::find($request->package_id);
            
            $booking = new Booking();
            $booking->booking_number = 'BKG' . date('YmdHis') . rand(100, 999);
            $booking->package_id = $request->package_id;
            $booking->booking_date = $request->booking_date;
            $booking->time_slot = $request->booking_time;
            $booking->guest_name = $request->user_name;
            $booking->guest_email = $request->user_email;
            $booking->guest_phone = $request->user_phone;
            $booking->participants = $request->participants ?? 1;
            $booking->number_of_people = $request->participants ?? 1; // Fix NULL field
            
            // Package pricing
            $booking->package_price = $package->price;
            $booking->total_amount = $request->total_amount; // Fix NULL field
            $booking->final_amount = $request->total_amount;
            
            // Payment info based on advance or full
            if ($request->payment_type === 'advance') {
                $booking->advance_amount = $request->advance_amount;
                $booking->pending_amount = $request->balance_due;
                $booking->payment_status = 'partial';
            } else {
                $booking->advance_amount = $request->total_amount;
                $booking->pending_amount = 0;
                $booking->payment_status = 'paid';
            }
            
            $booking->razorpay_payment_id = $request->payment_id;
            $booking->razorpay_order_id = $request->order_id ?? null;
            $booking->razorpay_signature = $request->signature ?? null;
            $booking->status = 'confirmed';
            $booking->special_requests = $request->special_requests ?? '';
            
            // Participant details if provided
            if ($request->has('participant_details')) {
                $booking->participant_details = json_encode($request->participant_details);
            }
            
            $booking->save();
            
            // Save in session for tracking
            $bookingIds = session('my_booking_ids', []);
            $bookingIds[] = $booking->id;
            session(['my_booking_ids' => $bookingIds]);
            
            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'booking_number' => $booking->booking_number,
                'message' => 'Booking confirmed successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function getMyBookings(Request $request)
    {
        $bookingIds = session('my_booking_ids', []);
        
        // Cookie se bhi check karo
        if (empty($bookingIds) && isset($_COOKIE['my_bookings'])) {
            $bookingIds = explode(',', $_COOKIE['my_bookings']);
        }
        
        $bookings = Booking::with('package')
            ->whereIn('id', $bookingIds)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($bookings);
    }
}
