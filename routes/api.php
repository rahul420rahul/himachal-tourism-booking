<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Booking;

// Simple booking store with session tracking
Route::post('/bookings', function(Request $request) {
    try {
        $booking = new Booking();
        $booking->package_id = $request->package_id;
        $booking->booking_date = $request->booking_date;
        $booking->time_slot = $request->booking_time;
        $booking->guest_name = $request->user_name;
        $booking->guest_email = $request->user_email;
        $booking->guest_phone = $request->user_phone;
        $booking->participants = $request->participants ?? 1;
        $booking->final_amount = $request->total_amount;
        $booking->total_amount = $request->total_amount;
        $booking->razorpay_payment_id = $request->payment_id;
        $booking->status = 'confirmed';
        $booking->payment_status = 'paid';
        $booking->booking_number = 'BKG' . date('YmdHis') . rand(100, 999);
        $booking->save();
        
        // Save booking ID in session
        $bookingIds = session('my_booking_ids', []);
        $bookingIds[] = $booking->id;
        session(['my_booking_ids' => $bookingIds]);
        
        // Also save in cookie for persistence
        setcookie('my_bookings', implode(',', $bookingIds), time() + (86400 * 30), "/");
        
        return response()->json([
            'success' => true,
            'booking_id' => $booking->id,
            'booking_number' => $booking->booking_number
        ]);
    } catch (\Exception $e) {
        \Log::error('Booking error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
});

// Get packages
Route::get('/packages', function() {
    return response()->json([
        'data' => \App\Models\Package::where('is_active', true)->get()
    ]);
});

// Get user bookings - check session, cookie, or email
Route::get('/my-bookings', function(Request $request) {
    $bookings = collect();
    
    // First check session
    $sessionIds = session('my_booking_ids', []);
    if (!empty($sessionIds)) {
        $bookings = Booking::with('package')
            ->whereIn('id', $sessionIds)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    // Also check cookie
    if ($bookings->isEmpty() && isset($_COOKIE['my_bookings'])) {
        $cookieIds = explode(',', $_COOKIE['my_bookings']);
        $bookings = Booking::with('package')
            ->whereIn('id', $cookieIds)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    // Fallback to email/phone if provided
    if ($bookings->isEmpty()) {
        $email = $request->query('email');
        $phone = $request->query('phone');
        
        if ($email || $phone) {
            $bookings = Booking::with('package')
                ->where(function($query) use ($email, $phone) {
                    if($email) $query->orWhere('guest_email', $email);
                    if($phone) $query->orWhere('guest_phone', $phone);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }
    
    return response()->json($bookings);
});

// Update the booking store to handle advance payment
// (Previous code remains, just add advance_amount and pending_amount fields)

// Booking store route
Route::post('/bookings', [\App\Http\Controllers\Api\BookingStoreController::class, 'store']);
