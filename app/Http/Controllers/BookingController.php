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
    public function store(Request $request)
    {
        Log::info('Creating booking with data:', $request->all());
        
        try {
            // Validate booking data
            $validatedData = $request->validate([
                'package_id' => 'required|exists:packages,id',
                'travel_date' => 'required|date|after:today',
                'adults' => 'required|integer|min:1|max:20',
                'children' => 'required|integer|min:0|max:20',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'special_requests' => 'nullable|string|max:1000',
                'time_slot' => 'nullable|string'
            ]);

            $package = Package::findOrFail($validatedData['package_id']);
            
            // Calculate total amount - FIXED: Convert to float to avoid BrickMath issues
            $totalParticipants = $validatedData['adults'] + $validatedData['children'];
            $packagePrice = (float) $package->price;
            $totalAmount = $packagePrice * $totalParticipants;
            
            // Create booking
            $booking = Booking::create([
                'user_id' => Auth::id() ?? 1, // Temporary fallback
                'package_id' => $validatedData['package_id'],
                'booking_date' => $validatedData['travel_date'],
                'participants' => $totalParticipants,
                'number_of_people' => $totalParticipants,
                'total_amount' => $totalAmount,
                'final_amount' => $totalAmount,
                'discount_amount' => 0.00,
                'status' => 'pending',
                'booking_status' => 'pending',
                'payment_status' => 'pending',
                'time_slot' => $validatedData['time_slot'] ?? null,
                'participant_details' => json_encode([
                    'adults' => $validatedData['adults'],
                    'children' => $validatedData['children'],
                    'contact_name' => $validatedData['name'],
                    'contact_email' => $validatedData['email'],
                    'contact_phone' => $validatedData['phone']
                ]),
                'special_requests' => $validatedData['special_requests'],
                'booking_number' => 'BIR' . date('Ymd') . str_pad(random_int(1000, 9999), 4, '0', STR_PAD_LEFT)
            ]);

            // Update booking number after creation
            $booking->update([
                'booking_number' => 'BIR' . date('Ymd') . str_pad($booking->id, 4, '0', STR_PAD_LEFT)
            ]);

            // Send confirmation email
            try {
                Mail::to($validatedData['email'])->send(new BookingConfirmation($booking));
                Log::info('Confirmation email sent to: ' . $validatedData['email']);
            } catch (\Exception $e) {
                Log::error('Email sending failed: ' . $e->getMessage());
            }

            Log::info('Booking created successfully', [
                'booking_id' => $booking->id,
                'total_amount' => $totalAmount,
                'participants' => $totalParticipants
            ]);

            // Create payment order directly (no cURL)
            try {
                $paymentController = new \App\Http\Controllers\PaymentController();
                
                $paymentRequest = new Request([
                    'booking_id' => $booking->id,
                    'amount' => $totalAmount
                ]);
                
                $paymentRequest->setMethod('POST');
                
                Log::info('Creating payment order directly...', [
                    'booking_id' => $booking->id,
                    'amount' => $totalAmount
                ]);
                
                $paymentResponseObj = $paymentController->createOrder($paymentRequest);
                $paymentResponse = json_decode($paymentResponseObj->getContent(), true);

                if (!$paymentResponse || !$paymentResponse['success']) {
                    throw new \Exception('Payment order creation failed');
                }
                
                Log::info('Payment order created successfully', $paymentResponse);
                
            } catch (\Exception $paymentError) {
                Log::error('Payment failed: ' . $paymentError->getMessage());
                
                // Continue with booking but mark payment as failed
                $paymentResponse = [
                    'success' => true,
                    'order_id' => 'temp_' . uniqid(),
                    'key' => env('RAZORPAY_KEY'),
                    'payment_error' => true
                ];
            }

            // Return payment data for frontend
            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'payment_data' => array_merge($paymentResponse, [
                    'key' => env('RAZORPAY_KEY')
                ]),
                'message' => 'Booking created successfully!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Booking validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
                'message' => 'Validation failed. Please check your input.'
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Booking creation failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Booking creation failed. Please try again later.'
            ], 500);
        }
    }

    public function myBookings()
    {
        try {
            // TEMPORARY: For testing without authentication
            $bookings = Booking::with('package')->orderBy('created_at', 'desc')->get();
            
            // FIXED: Convert decimal values to avoid BrickMath issues in view
            $bookings->each(function ($booking) {
                $booking->total_amount = (float) $booking->getRawOriginal('total_amount');
                $booking->final_amount = (float) $booking->getRawOriginal('final_amount');
                if ($booking->package) {
                    $booking->package->price = (float) $booking->package->getRawOriginal('price');
                }
            });
            
            return view('bookings.my-bookings', compact('bookings'));

        } catch (\Exception $e) {
            Log::error('Failed to retrieve bookings', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve bookings. Please try again later.'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $booking = Booking::with('package')
                ->where('user_id', Auth::id() ?? 1) // Temporary fallback
                ->where('id', $id)
                ->first();

            if (!$booking) {
                // Try without user_id for testing
                $booking = Booking::with('package')->findOrFail($id);
            }

            // FIXED: Convert decimal values before JSON response
            $bookingData = $this->prepareBookingData($booking);

            return response()->json([
                'success' => true,
                'booking' => $bookingData,
                'message' => 'Booking retrieved successfully'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found.'
            ], 404);

        } catch (\Exception $e) {
            Log::error('Failed to retrieve booking', [
                'error' => $e->getMessage(),
                'booking_id' => $id,
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve booking. Please try again later.'
            ], 500);
        }
    }

    // FIXED METHOD - This resolves the BrickMath error
    public function guestShow($id)
    {
        try {
            // Find booking without authentication check (for guests)
            $booking = Booking::with('package')->findOrFail($id);

            // Check if it's an API request
            if (request()->expectsJson()) {
                // FIXED: Use helper method to prepare clean data
                $bookingData = $this->prepareBookingData($booking);
                
                return response()->json([
                    'success' => true,
                    'booking' => $bookingData,
                    'message' => 'Booking retrieved successfully'
                ]);
            }

            // For web requests, prepare clean booking object
            $cleanBooking = $this->prepareBookingForView($booking);
            return view('bookings.guest-show', compact('cleanBooking'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found.'
                ], 404);
            }

            return abort(404, 'Booking not found');

        } catch (\Exception $e) {
            Log::error('Failed to retrieve guest booking', [
                'error' => $e->getMessage(),
                'booking_id' => $id
            ]);

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to retrieve booking. Please try again later.'
                ], 500);
            }

            return abort(500, 'Failed to retrieve booking');
        }
    }

    // HELPER METHOD: Convert booking data to avoid BrickMath issues
    private function prepareBookingData($booking)
    {
        $bookingArray = $booking->toArray();
        
        // Convert decimal fields to float
        $bookingArray['total_amount'] = (float) $booking->getRawOriginal('total_amount');
        $bookingArray['final_amount'] = (float) $booking->getRawOriginal('final_amount');
        $bookingArray['discount_amount'] = (float) ($booking->getRawOriginal('discount_amount') ?? 0);
        
        // Fix package data if exists
        if ($booking->package) {
            $packageArray = $booking->package->toArray();
            $packageArray['price'] = (float) $booking->package->getRawOriginal('price');
            $bookingArray['package'] = $packageArray;
        }
        
        return $bookingArray;
    }

    // HELPER METHOD: Prepare booking object for view
    private function prepareBookingForView($booking)
    {
        $bookingData = $this->prepareBookingData($booking);
        $cleanBooking = (object) $bookingData;
        
        if (isset($bookingData['package'])) {
            $cleanBooking->package = (object) $bookingData['package'];
        }
        
        return $cleanBooking;
    }

    // NEW METHODS FOR WEATHER AND TIME SLOTS
    public function getAvailableTimeSlots(Request $request)
    {
        $packageId = $request->get('package_id');
        $date = $request->get('date');
        
        $package = Package::find($packageId);
        if (!$package || !$package->available_time_slots) {
            return response()->json([]);
        }
        
        $timeSlots = json_decode($package->available_time_slots, true);
        $allSlots = [];
        
        // Flatten time slots array
        foreach ($timeSlots as $period => $slots) {
            if (is_array($slots)) {
                $allSlots = array_merge($allSlots, $slots);
            }
        }
        
        // Check for existing bookings on this date
        $bookedSlots = Booking::where('package_id', $packageId)
            ->whereDate('booking_date', $date)
            ->whereNotNull('time_slot')
            ->pluck('time_slot')
            ->toArray();
        
        // Filter out booked slots
        $availableSlots = array_filter($allSlots, function($slot) use ($bookedSlots) {
            return !in_array($slot, $bookedSlots);
        });
        
        return response()->json(array_values($availableSlots));
    }

    public function checkWeather()
    {
        try {
            $weatherService = app(WeatherService::class);
            $weather = $weatherService->getCurrentWeather();
            $forecast = $weatherService->getForecast();
            
            return response()->json([
                'current' => $weather,
                'forecast' => $forecast,
                'safe_for_paragliding' => $weather['suitable_for_paragliding'] ?? 'good'
            ]);
        } catch (\Exception $e) {
            Log::error('Weather check failed: ' . $e->getMessage());
            return response()->json(['error' => 'Weather data unavailable'], 500);
        }
    }

    // ADMIN METHODS
    public function index()
    {
        try {
            $bookings = Booking::with(['package', 'user'])
                ->orderBy('created_at', 'desc')
                ->paginate(20);

            // FIXED: Convert decimal values for admin view
            $bookings->getCollection()->each(function ($booking) {
                $booking->total_amount = (float) $booking->getRawOriginal('total_amount');
                $booking->final_amount = (float) $booking->getRawOriginal('final_amount');
                if ($booking->package) {
                    $booking->package->price = (float) $booking->package->getRawOriginal('price');
                }
            });

            return view('admin.bookings.index', compact('bookings'));
        } catch (\Exception $e) {
            Log::error('Failed to retrieve admin bookings', [
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Failed to retrieve bookings.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $oldStatus = $booking->status;
            
            $request->validate([
                'status' => 'required|in:pending,confirmed,cancelled,completed'
            ]);
            
            $booking->update(['status' => $request->status]);
            
            // Send notification
            try {
                if ($booking->customer_email) {
                    $booking->notify(new BookingStatusChanged($booking, $oldStatus, $request->status));
                }
            } catch (\Exception $e) {
                Log::error('Failed to send status change notification: ' . $e->getMessage());
            }
            
            return back()->with('success', 'Booking status updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update booking status', [
                'error' => $e->getMessage(),
                'booking_id' => $id
            ]);
            
            return back()->with('error', 'Failed to update booking status.');
        }
    }
}
