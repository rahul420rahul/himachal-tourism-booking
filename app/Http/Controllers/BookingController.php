<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Package;
use App\Models\Booking;
use App\Services\WeatherService;
use App\Mail\BookingConfirmation;
use App\Notifications\BookingStatusChanged;

class BookingController extends Controller
{
    public function create()
    {
        $packages = \App\Models\Package::where("is_active", true)->get();
        return view("bookings.create", compact("packages"));
    }
    public function store(Request $request)
    {
        Log::info('=== BOOKING DEBUG START ===');
        Log::info('Request method: ' . $request->method());
        Log::info('Auth check: ' . (Auth::check() ? 'YES' : 'NO'));
        Log::info('Request data:', $request->all());
        
        try {
            // Allow guest bookings - no authentication required
            $userId = Auth::check() ? Auth::id() : null;
            
            $validatedData = $request->validate([
                'package_id' => 'required|exists:packages,id',
                'booking_date' => 'required|date|after:today',
                'adults' => 'required|integer|min:1|max:20',
                'children' => 'required|integer|min:0|max:20',
                'guest_name' => 'required|string|max:255',
                'guest_email' => 'required|email|max:255',
                'guest_phone' => 'required|string|max:20',
                'special_requests' => 'nullable|string|max:1000'
            ]);
            
            Log::info('Validation passed:', $validatedData);
            
            $package = Package::findOrFail($validatedData['package_id']);
            $totalParticipants = $validatedData['adults'] + $validatedData['children'];
            
            // Calculate total amount
            $totalAmount = (float) $package->price * $totalParticipants;
            
            // ====== ADVANCE PAYMENT CALCULATION ======
            // Calculate advance amount based on package type
            $advanceAmount = 0;
            $pendingAmount = 0;
            
            // Check if package has advance_payment_percentage
            if (isset($package->advance_payment_percentage) && $package->advance_payment_percentage > 0) {
                $advanceAmount = ($totalAmount * $package->advance_payment_percentage) / 100;
            } else {
                // Default calculation based on package type or name
                $packageName = strtolower($package->name);
                
                if (str_contains($packageName, 'p1') || str_contains($packageName, 'p2') || str_contains($packageName, 'p3')) {
                    // P1, P2, P3 courses - 20% advance (6000 for 30000)
                    $advanceAmount = $totalAmount * 0.20;
                } elseif (str_contains($packageName, 'p4')) {
                    // P4 course - 20% advance (12000 for 60000)
                    $advanceAmount = $totalAmount * 0.20;
                } elseif (str_contains($packageName, 'tandem')) {
                    // Tandem flights - 20% advance with minimum 500
                    $advanceAmount = max(500 * $totalParticipants, $totalAmount * 0.20);
                } else {
                    // Default 30% advance for other packages
                    $advanceAmount = $totalAmount * 0.20;
                }
            }
            
            // Round advance amount
            $advanceAmount = round($advanceAmount, 2);
            $pendingAmount = $totalAmount - $advanceAmount;
            
            Log::info('Payment calculation:', [
                'total_amount' => $totalAmount,
                'advance_amount' => $advanceAmount,
                'pending_amount' => $pendingAmount,
                'participants' => $totalParticipants
            ]);
            
            // Create booking with calculated amounts
            $booking = Booking::create([
                'booking_number' => 'BIR' . date('Ymd') . str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT),
                'final_amount' => $totalAmount,
                'advance_amount' => $advanceAmount,
                'pending_amount' => $pendingAmount,
                'total_amount' => $totalAmount,
                'participants' => $totalParticipants,
                'number_of_people' => $totalParticipants,
                'time_slot' => '10:00',
                'status' => 'pending',
                'payment_status' => 'pending',
                'booking_number' => 'BIR' . date('Ymd') . str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT),
                'final_amount' => $totalAmount,
                'advance_amount' => $advanceAmount,
                'pending_amount' => $pendingAmount,
                'total_amount' => $totalAmount,
                'participants' => $totalParticipants,
                'number_of_people' => $totalParticipants,
                'time_slot' => '10:00',
                'status' => 'pending',
                'payment_status' => 'pending',
                'user_id' => $userId,
                'package_id' => $validatedData['package_id'],
                'guest_name' => $validatedData['guest_name'],
                'guest_email' => $validatedData['guest_email'],
                'guest_phone' => $validatedData['guest_phone'],
                'booking_date' => $validatedData['booking_date'],
                'time_slot' => '10:00',
                'participants' => $totalParticipants,
                'package_price' => $package->price,
                'discount_amount' => 0.00,
                'tax_amount' => 0.00,
                'final_amount' => $totalAmount,
                'advance_amount' => $advanceAmount,  // Store advance amount
                'pending_amount' => $pendingAmount,   // Store pending amount
                'status' => 'pending',
                'payment_status' => 'pending',
                'special_requests' => $validatedData['special_requests'] ?? '',
                'cancellation_reason' => null,
                'cancelled_at' => null,
                'participant_details' => null,
                'meta_data' => json_encode([
                    'payment_type' => 'advance',
                    'advance_percentage' => $package->advance_payment_percentage ?? 20
                ]),
            ]);
            
            Log::info('Booking created successfully:', [
                'id' => $booking->id, 
                'total' => $totalAmount,
                'advance' => $advanceAmount,
                'pending' => $pendingAmount
            ]);
            
            // Create Razorpay order for ADVANCE AMOUNT only
            try {
                // Get Razorpay credentials
                $razorpayKey = config('services.razorpay.key');
                $razorpaySecret = config('services.razorpay.secret');
                
                if (!$razorpayKey || !$razorpaySecret) {
                    $razorpayKey = env('RAZORPAY_KEY_ID');
                    $razorpaySecret = env('RAZORPAY_KEY_SECRET');
                }
                
                if (!$razorpayKey || !$razorpaySecret) {
                    throw new \Exception('Razorpay credentials not configured');
                }
                
                $api = new \Razorpay\Api\Api($razorpayKey, $razorpaySecret);
                
                // ====== IMPORTANT: Use ADVANCE AMOUNT for Razorpay order ======
                $razorpayAmount = $advanceAmount * 100; // Convert to paise
                
                $orderData = [
                    'receipt' => 'order_' . $booking->id . '_' . time(),
                    'amount' => $razorpayAmount,  // ADVANCE AMOUNT in paise
                    'currency' => 'INR',
                    'notes' => [
                        'booking_id' => $booking->id,
                        'booking_number' => $booking->booking_number,
                        'package_name' => $package->name,
                        'payment_type' => 'advance',
                        'total_amount' => $totalAmount,
                        'advance_amount' => $advanceAmount,
                        'pending_amount' => $pendingAmount
                    ]
                ];

                $razorpayOrder = $api->order->create($orderData);

                // Update booking with Razorpay order ID
                $booking->update([
                    'razorpay_order_id' => $razorpayOrder['id'],
                    'payment_status' => 'processing'
                ]);

                Log::info('Razorpay order created:', [
                    'order_id' => $razorpayOrder['id'],
                    'razorpay_amount' => $razorpayAmount,
                    'advance_amount' => $advanceAmount
                ]);
                
                return response()->json([
                    'success' => true,
                    'booking_id' => $booking->id,
                    'payment_data' => [
                        'success' => true,
                        'order_id' => $razorpayOrder['id'],
                        'key' => $razorpayKey,
                        'amount' => $razorpayOrder['amount'],  // This is advance amount in paise
                        'currency' => $razorpayOrder['currency'],
                        'name' => 'MyBirBilling',
                        'description' => 'Advance Payment for ' . $package->name,
                        'booking_id' => $booking->id,
                        'prefill' => [
                            'name' => $validatedData['guest_name'],
                            'email' => $validatedData['guest_email'],
                            'contact' => $validatedData['guest_phone']
                        ],
                        'notes' => [
                            'payment_type' => 'advance',
                            'total_amount' => $totalAmount,
                            'advance_amount' => $advanceAmount,
                            'pending_amount' => $pendingAmount
                        ]
                    ],
                    'booking_details' => [
                        'total_amount' => $totalAmount,
                        'advance_amount' => $advanceAmount,
                        'pending_amount' => $pendingAmount,
                        'payment_type' => 'Advance Payment'
                    ],
                  'message' => 'Booking created successfully! Proceed with payment.'
                ]);
                
            } catch (\Exception $e) {
                Log::error('Razorpay order creation failed:', ['error' => $e->getMessage()]);
                
                // Delete the booking if payment order creation fails
                $booking->delete();
                
                return response()->json([
                    'success' => false,
                    'message' => 'Payment initialization failed: ' . $e->getMessage()
                ], 500);
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed:', ['errors' => $e->errors()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Booking creation failed:', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Booking failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Add this new method to handle balance payment
    public function initiateBalancePayment(Request $request, Booking $booking)
    {
        try {
            // Check if advance is already paid
            if ($booking->payment_status !== 'partial') {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid payment status for balance payment'
                ], 400);
            }
            
            $razorpayKey = config('services.razorpay.key');
            $razorpaySecret = config('services.razorpay.secret');
            
            if (!$razorpayKey || !$razorpaySecret) {
                $razorpayKey = env('RAZORPAY_KEY_ID');
                $razorpaySecret = env('RAZORPAY_KEY_SECRET');
            }
            
            $api = new \Razorpay\Api\Api($razorpayKey, $razorpaySecret);
            
            // Create order for pending amount
            $orderData = [
                'receipt' => 'balance_' . $booking->id . '_' . time(),
                'amount' => $booking->pending_amount * 100, // Convert to paise
                'currency' => 'INR',
                'notes' => [
                    'booking_id' => $booking->id,
                    'booking_number' => $booking->booking_number,
                    'payment_type' => 'balance',
                    'pending_amount' => $booking->pending_amount
                ]
            ];
            
            $razorpayOrder = $api->order->create($orderData);
            
            return response()->json([
                'success' => true,
                'payment_data' => [
                    'order_id' => $razorpayOrder['id'],
                    'key' => $razorpayKey,
                    'amount' => $razorpayOrder['amount'],
                    'currency' => 'INR',
                    'name' => 'MyBirBilling',
                    'description' => 'Balance Payment for Booking #' . $booking->booking_number,
                    'prefill' => [
                        'name' => $booking->guest_name,
                        'email' => $booking->guest_email,
                        'contact' => $booking->guest_phone
                    ]
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to initiate balance payment: ' . $e->getMessage()
            ], 500);
        }
    }

    // Other existing methods remain the same...
    public function show(Booking $booking)
    {
        if (Auth::check()) {
//             $this->authorize('view', $booking);
        }
        
        return view('bookings.show', compact('booking'));
    }

    public function guestShow($id)
    {
        $booking = Booking::with('package')->findOrFail($id);
        return view('bookings.guest-show', compact('booking'));
    }

    public function myBookings()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $bookings = Auth::user()->bookings()->with('package')->latest()->paginate(10);
        return view('bookings.my-bookings', compact('bookings'));
    }

    // ... rest of the methods remain unchanged
}