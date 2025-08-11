<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    private $razorpayId;
    private $razorpayKey;
    
    public function __construct()
    {
        $this->razorpayId = env('RAZORPAY_KEY');
        $this->razorpayKey = env('RAZORPAY_SECRET');
    }

    public function createOrder(Request $request)
    {
        try {
            Log::info('PaymentController: Creating order with data:', $request->all());

            $validatedData = $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'amount' => 'required|numeric|min:1'
            ]);

            $booking = Booking::with('package')->findOrFail($validatedData['booking_id']);
            $amount = $validatedData['amount'];

            // Initialize Razorpay API
            $api = new Api($this->razorpayId, $this->razorpayKey);

            // Create order
            $orderData = [
                'receipt' => 'order_' . $booking->id . '_' . time(),
                'amount' => $amount * 100, // Amount in paise
                'currency' => 'INR',
                'notes' => [
                    'booking_id' => $booking->id,
                    'booking_number' => $booking->booking_number,
                    'package_name' => $booking->package->name ?? 'Package'
                ]
            ];

            $razorpayOrder = $api->order->create($orderData);

            Log::info('Razorpay order created successfully:', [
                'order_id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount'],
                'booking_id' => $booking->id
            ]);

            // Update booking with order details
            $booking->update([
                'razorpay_order_id' => $razorpayOrder['id'],
                'payment_status' => 'initiated'
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'key' => $this->razorpayId,
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
                'name' => 'MyBirBilling',
                'description' => 'Booking for ' . ($booking->package->name ?? 'Package'),
                'booking_id' => $booking->id,
                'prefill' => [
                    'name' => $booking->participant_details ? json_decode($booking->participant_details, true)['contact_name'] ?? '' : '',
                    'email' => $booking->participant_details ? json_decode($booking->participant_details, true)['contact_email'] ?? '' : '',
                    'contact' => $booking->participant_details ? json_decode($booking->participant_details, true)['contact_phone'] ?? '' : ''
                ],
                'theme' => [
                    'color' => '#3399cc'
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Payment order validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Invalid payment data provided.',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Payment order creation failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment order creation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyPayment(Request $request)
    {
        try {
            Log::info('PaymentController: Verifying payment with data:', $request->all());

            $validatedData = $request->validate([
                'razorpay_payment_id' => 'required|string',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'required|string',
                'booking_id' => 'required|exists:bookings,id'
            ]);

            $booking = Booking::findOrFail($validatedData['booking_id']);

            // Verify signature
            $api = new Api($this->razorpayId, $this->razorpayKey);
            
            $attributes = [
                'razorpay_order_id' => $validatedData['razorpay_order_id'],
                'razorpay_payment_id' => $validatedData['razorpay_payment_id'],
                'razorpay_signature' => $validatedData['razorpay_signature']
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Update booking status
            $booking->update([
                'razorpay_payment_id' => $validatedData['razorpay_payment_id'],
                'payment_status' => 'completed',
                'booking_status' => 'confirmed',
                'status' => 'confirmed'
            ]);

            Log::info('Payment verified successfully', [
                'booking_id' => $booking->id,
                'payment_id' => $validatedData['razorpay_payment_id']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment verified successfully!',
                'booking' => $booking,
                'redirect_url' => route('bookings.show', $booking->id)
            ]);

        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            Log::error('Payment signature verification failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed. Invalid signature.'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Payment verification failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function handleFailure(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'error' => 'nullable|array'
            ]);

            $booking = Booking::findOrFail($validatedData['booking_id']);

            // Update booking status
            $booking->update([
                'payment_status' => 'failed',
                'booking_status' => 'pending'
            ]);

            Log::warning('Payment failed for booking', [
                'booking_id' => $booking->id,
                'error' => $validatedData['error'] ?? 'Unknown error'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment failed. Please try again.',
                'booking_id' => $booking->id
            ]);

        } catch (\Exception $e) {
            Log::error('Payment failure handling failed', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing payment failure.'
            ], 500);
        }
    }

    public function handleCallback(Request $request)
    {
        try {
            Log::info('Payment callback received:', $request->all());

            // Get payment details from request
            $paymentId = $request->input('razorpay_payment_id');
            $orderId = $request->input('razorpay_order_id');
            $signature = $request->input('razorpay_signature');

            if (!$paymentId || !$orderId || !$signature) {
                return redirect()->route('packages.index')->with('error', 'Invalid payment callback data.');
            }

            // Find booking by order ID
            $booking = Booking::where('razorpay_order_id', $orderId)->first();

            if (!$booking) {
                return redirect()->route('packages.index')->with('error', 'Booking not found.');
            }

            // Verify payment signature
            $api = new Api($this->razorpayId, $this->razorpayKey);
            
            $attributes = [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ];

            try {
                $api->utility->verifyPaymentSignature($attributes);
                
                // Payment verified successfully
                $booking->update([
                    'razorpay_payment_id' => $paymentId,
                    'payment_status' => 'completed',
                    'booking_status' => 'confirmed',
                    'status' => 'confirmed'
                ]);

                Log::info('Payment verified and booking confirmed', [
                    'booking_id' => $booking->id,
                    'payment_id' => $paymentId
                ]);

                return redirect()->route('bookings.success', $booking->id)
                    ->with('success', 'Payment successful! Your booking is confirmed.');

            } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
                Log::error('Payment signature verification failed:', [
                    'error' => $e->getMessage(),
                    'booking_id' => $booking->id
                ]);

                $booking->update([
                    'payment_status' => 'failed',
                    'booking_status' => 'pending'
                ]);

                return redirect()->route('packages.index')
                    ->with('error', 'Payment verification failed. Please try again.');
            }

        } catch (\Exception $e) {
            Log::error('Payment callback handling failed:', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->route('packages.index')
                ->with('error', 'Payment processing failed. Please contact support.');
        }
    }

    public function success($bookingId)
    {
        try {
            $booking = Booking::with('package')->findOrFail($bookingId);
            
            return view('bookings.success', compact('booking'));
            
        } catch (\Exception $e) {
            return redirect()->route('packages.index')
                ->with('error', 'Booking not found.');
        }
    }
}
