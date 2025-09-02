<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Booking;

// Web middleware GROUP ke andar daalo for session access
Route::middleware(['web'])->group(function () {
    
    Route::post('/bookings', function(Request $request) {
        try {
            // Debug log
            \Log::info('Booking Request Data', [
                'all' => $request->all(),
                'user_id_from_request' => $request->user_id,
                'auth_check' => auth()->check(),
                'auth_id' => auth()->id()
            ]);
            
            $booking = new Booking();
            
            // Properly get user_id with validation
            $userId = null;
            if ($request->has('user_id') && !empty($request->user_id) && $request->user_id !== 'null') {
                $userId = (int) $request->user_id;
            } elseif (auth()->check()) {
                $userId = auth()->id();
            }
            
            $booking->user_id = $userId;
            $booking->package_id = $request->package_id;
            $booking->booking_date = $request->booking_date;
            $booking->time_slot = $request->booking_time ?? '10:00 AM';
            $booking->guest_name = $request->user_name ?? $request->guest_name;
            $booking->guest_email = $request->user_email ?? $request->guest_email;
            $booking->guest_phone = $request->user_phone ?? $request->guest_phone;
            $booking->participants = $request->participants ?? 1;
            $booking->final_amount = $request->total_amount;
            $booking->total_amount = $request->total_amount;
            $booking->razorpay_payment_id = $request->payment_id;
            $booking->status = 'confirmed';
            $booking->payment_status = 'paid';
            $booking->booking_number = 'BKG' . date('YmdHis') . rand(100, 999);
            $booking->save();
            
            \Log::info('Booking Created Successfully', [
                'booking_id' => $booking->id,
                'user_id_saved' => $booking->user_id
            ]);
            
            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'booking_number' => $booking->booking_number,
                'user_id' => $booking->user_id
            ]);
        } catch (\Exception $e) {
            \Log::error('Booking error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    });
    
});

// Package route doesn't need auth
Route::get('/packages', function() {
    return response()->json([
        'data' => \App\Models\Package::where('is_active', true)->get()
    ]);
});
