<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Support\Facades\Log;

class BookingStoreController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Booking request received:', $request->all());
        
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
            $booking->number_of_people = $request->participants ?? 1;
            $booking->package_price = $package->price;
            $booking->total_amount = $request->total_amount;
            $booking->final_amount = $request->total_amount;
            $booking->advance_amount = $request->advance_amount;
            $booking->pending_amount = $request->balance_due;
            $booking->payment_status = $request->payment_type === 'advance' ? 'partial' : 'paid';
            $booking->razorpay_payment_id = $request->payment_id;
            $booking->status = 'confirmed';
            $booking->special_requests = $request->special_requests ?? '';
            $booking->save();
            
            // Save in session
            $bookingIds = session('my_booking_ids', []);
            $bookingIds[] = $booking->id;
            session(['my_booking_ids' => $bookingIds]);
            
            Log::info('Booking saved:', ['id' => $booking->id]);
            
            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'booking_number' => $booking->booking_number,
                'redirect_url' => '/booking-success/' . $booking->id
            ]);
            
        } catch (\Exception $e) {
            Log::error('Booking failed:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Booking failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
