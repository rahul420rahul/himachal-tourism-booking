<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Package;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $package = Package::find($request->package_id);
            
            $booking = new Booking();
            
            // CRITICAL FIX: Set user_id from auth
            if (Auth::check()) {
                $booking->user_id = Auth::id();
                \Log::info('Setting user_id from Auth: ' . Auth::id());
            } elseif ($request->has('user_id') && !empty($request->user_id)) {
                $booking->user_id = (int) $request->user_id;
                \Log::info('Setting user_id from request: ' . $request->user_id);
            } else {
                $booking->user_id = null;
                \Log::warning('No user_id available - guest booking');
            }
            
            $booking->booking_number = 'BKG' . date('YmdHis') . rand(100, 999);
            $booking->package_id = $request->package_id;
            $booking->booking_date = $request->booking_date;
            $booking->time_slot = $request->booking_time ?? '10:00 AM';
            $booking->guest_name = $request->user_name ?? $request->guest_name;
            $booking->guest_email = $request->user_email ?? $request->guest_email;
            $booking->guest_phone = $request->user_phone ?? $request->guest_phone;
            $booking->participants = $request->participants ?? 1;
            $booking->number_of_people = $request->participants ?? 1;
            
            // Package pricing
            $booking->package_price = $package->price;
            $booking->total_amount = $request->total_amount ?? ($package->price * $booking->participants);
            $booking->final_amount = $booking->total_amount;
            
            // Payment info
            if ($request->payment_type === 'advance') {
                $booking->advance_amount = $request->advance_amount ?? ($booking->total_amount * 0.2);
                $booking->pending_amount = $booking->total_amount - $booking->advance_amount;
                $booking->payment_status = 'partial';
            } else {
                $booking->advance_amount = $booking->total_amount;
                $booking->pending_amount = 0;
                $booking->payment_status = 'paid';
            }
            
            $booking->razorpay_payment_id = $request->payment_id;
            $booking->razorpay_order_id = $request->order_id ?? null;
            $booking->razorpay_signature = $request->signature ?? null;
            $booking->status = 'confirmed';
            $booking->special_requests = $request->special_requests ?? '';
            
            $booking->save();
            
            \Log::info('Booking created', [
                'id' => $booking->id,
                'user_id' => $booking->user_id,
                'number' => $booking->booking_number
            ]);
            
            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'booking_number' => $booking->booking_number,
                'user_id' => $booking->user_id,
                'message' => 'Booking confirmed successfully!'
            ]);
            
        } catch (\Exception $e) {
            \Log::error('API Booking error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Booking failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function getMyBookings(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([]);
        }
        
        $bookings = Booking::with('package')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($bookings);
    }
}
