<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Payment;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    private $razorpayId;
    private $razorpayKey;

    public function __construct()
    {
        // Fixed: Use correct environment variable names
        $this->razorpayId = env('RAZORPAY_KEY_ID');
        $this->razorpayKey = env('RAZORPAY_KEY_SECRET');
    }

    public function createOrder(Request $request)
    {
        try {
            $validated = $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'amount' => 'required|numeric|min:1'
            ]);

            $booking = Booking::with('package')->findOrFail($validated['booking_id']);

            $api = new Api($this->razorpayId, $this->razorpayKey);
            
            $orderData = [
                'receipt' => 'order_' . $booking->id . '_' . time(),
                'amount' => $validated['amount'] * 100, // Convert to paise
                'currency' => 'INR',
                'notes' => [
                    'booking_id' => $booking->id,
                    'booking_number' => $booking->booking_number,
                    'package_name' => $booking->package->name ?? 'Package'
                ]
            ];

            $razorpayOrder = $api->order->create($orderData);

            $booking->update([
                'razorpay_order_id' => $razorpayOrder['id'],
                'payment_status' => 'processing'
            ]);

            Log::info('Razorpay order created', [
                'order_id' => $razorpayOrder['id'],
                'booking_id' => $booking->id,
                'amount' => $razorpayOrder['amount']
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'key' => $this->razorpayId,
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
                'name' => 'MyBirBilling',
                'description' => 'Booking for ' . ($booking->package->name ?? 'Package'),
                'booking_id' => $booking->id
            ]);

        } catch (\Exception $e) {
            Log::error('Payment order creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Payment order creation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function handleCallback(Request $request)
    {
        Log::info('=== PAYMENT CALLBACK START ===');
        Log::info('Callback data received:', $request->all());

        $paymentId = $request->input('razorpay_payment_id');
        $orderId = $request->input('razorpay_order_id');
        $signature = $request->input('razorpay_signature');
        $bookingId = $request->input('booking_id');

        // Log the keys being used (hide secret for security)
        Log::info('Using Razorpay credentials', [
            'key' => $this->razorpayId,
            'secret_length' => strlen($this->razorpayKey),
            'secret_first_4' => substr($this->razorpayKey, 0, 4) . '****'
        ]);

        if (!$paymentId || !$signature || !$orderId) {
            Log::error('Missing required payment data', [
                'payment_id' => $paymentId,
                'order_id' => $orderId,
                'signature' => $signature,
                'booking_id' => $bookingId
            ]);
            return redirect()->route('home')->with('error', 'Invalid payment data.');
        }

        // Find booking by ID first, then by order ID
        $booking = Booking::find($bookingId);
        if (!$booking && $orderId) {
            Log::info('Booking not found by ID, trying by order_id');
            $booking = Booking::where('razorpay_order_id', $orderId)->first();
        }

        if (!$booking) {
            Log::error('Booking not found', [
                'booking_id' => $bookingId,
                'order_id' => $orderId
            ]);
            return redirect()->route('home')->with('error', 'Booking not found.');
        }

        Log::info('Booking found', ['booking_id' => $booking->id]);

        try {
            // First, save the payment details regardless of verification
            $booking->update([
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ]);

            // Initialize Razorpay API
            $api = new Api($this->razorpayId, $this->razorpayKey);
            
            // Prepare signature verification data
            $verificationData = [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ];
            
            Log::info('Attempting signature verification', $verificationData);
            
            // Verify the payment signature
            try {
                $api->utility->verifyPaymentSignature($verificationData);
                Log::info('Signature verified successfully');
            } catch (\Exception $sigError) {
                Log::error('Signature verification failed', [
                    'error' => $sigError->getMessage(),
                    'data' => $verificationData
                ]);
                
                // In test mode, you might want to bypass this check
                // Comment the throw line below if you want to bypass signature verification in development
                throw $sigError;
            }

            // Update booking status to confirmed
            $booking->update([
                'payment_status' => 'paid',
                'status' => 'confirmed'
            ]);

            Log::info('Booking updated to confirmed status');

            // Create payment record if table exists
            if (\Schema::hasTable('payments')) {
                Log::info('Attempting to create payment record', [
                    'booking_id' => $booking->id,
                    'amount' => $booking->final_amount
                ]);

                try {
                    $payment = Payment::create([
                        'booking_id' => $booking->id,
                        'gateway_payment_id' => $paymentId,      // Fixed: Correct column name
                        'gateway_order_id' => $orderId,          // Fixed: Correct column name
                        'amount' => $booking->final_amount ?? 0,
                        'currency' => 'INR',
                        'status' => 'success',
                        'payment_method' => 'online',
                        'payment_type' => 'full',                // Added payment_type
                        'gateway_response' => json_encode($request->all()),
                        'paid_at' => now()                       // Added paid_at
                    ]);
                    
                    Log::info('Payment record created successfully', [
                        'payment_record_id' => $payment->id
                    ]);
                } catch (\Exception $paymentError) {
                    Log::error('Failed to create payment record - Detailed Error', [
                        'error' => $paymentError->getMessage(),
                        'trace' => $paymentError->getTraceAsString(),
                        'booking_id' => $booking->id,
                        'payment_id' => $paymentId
                    ]);
                    // Don't fail the whole transaction if payment record fails
                }
            } else {
                Log::warning('Payments table does not exist');
            }

            Log::info('=== PAYMENT SUCCESS - Redirecting to success page ===');
            
            return redirect()->route('bookings.success', $booking->id)
                ->with('success', 'Payment successful! Your booking is confirmed.');

        } catch (\Exception $e) {
            Log::error('Payment processing failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Update booking status to failed
            $booking->update([
                'payment_status' => 'failed',
                'status' => 'pending'
            ]);
            
            $errorMessage = 'Payment verification failed.';
            if (strpos($e->getMessage(), 'signature') !== false) {
                $errorMessage = 'Payment signature verification failed. Please contact support.';
            }
            
            return redirect()->route('home')->with('error', $errorMessage);
        }
    }

    public function callback(Request $request)
    {
        Log::info('=== ADVANCE PAYMENT CALLBACK START ===');
        Log::info('Callback data received:', $request->all());

        try {
            $paymentId = $request->input('razorpay_payment_id');
            $orderId = $request->input('razorpay_order_id');
            $signature = $request->input('razorpay_signature');
            $bookingId = $request->input('booking_id');

            if (!$paymentId || !$signature || !$orderId || !$bookingId) {
                Log::error('Missing required payment data for advance payment', [
                    'payment_id' => $paymentId,
                    'order_id' => $orderId,
                    'signature' => $signature,
                    'booking_id' => $bookingId
                ]);
                return redirect()->route('packages.index')->with('error', 'Invalid payment data.');
            }

            $booking = Booking::findOrFail($bookingId);
            
            // Verify payment signature
            $api = new Api($this->razorpayId, $this->razorpayKey);
            $verificationData = [
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ];

            Log::info('Attempting signature verification for advance payment', $verificationData);
            
            try {
                $api->utility->verifyPaymentSignature($verificationData);
                Log::info('Signature verified successfully for advance payment');
            } catch (\Exception $sigError) {
                Log::error('Signature verification failed for advance payment', [
                    'error' => $sigError->getMessage(),
                    'data' => $verificationData
                ]);
                throw $sigError;
            }

            // Update booking with payment details
            $booking->update([
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature,
                'payment_status' => 'partial',
                'status' => 'confirmed'
            ]);

            // Create payment record if table exists
            if (\Schema::hasTable('payments')) {
                Log::info('Attempting to create payment record for advance payment', [
                    'booking_id' => $booking->id,
                    'amount' => $booking->advance_amount ?? $booking->final_amount
                ]);

                try {
                    $payment = Payment::create([
                        'booking_id' => $booking->id,
                        'gateway_payment_id' => $paymentId,      // Fixed: Correct column name
                        'gateway_order_id' => $orderId,          // Fixed: Correct column name
                        'amount' => $booking->advance_amount ?? $booking->final_amount ?? 0,
                        'currency' => 'INR',
                        'status' => 'success',
                        'payment_method' => 'online',
                        'payment_type' => 'advance',             // Added payment_type as advance
                        'gateway_response' => json_encode($request->all()),
                        'paid_at' => now()                       // Added paid_at
                    ]);
                    
                    Log::info('Payment record created for advance payment', [
                        'payment_record_id' => $payment->id
                    ]);
                } catch (\Exception $paymentError) {
                    Log::error('Failed to create payment record for advance payment - Detailed Error', [
                        'error' => $paymentError->getMessage(),
                        'trace' => $paymentError->getTraceAsString(),
                        'booking_id' => $booking->id,
                        'payment_id' => $paymentId
                    ]);
                    // Don't fail the whole transaction if payment record fails
                }
            } else {
                Log::warning('Payments table does not exist');
            }

            Log::info('=== ADVANCE PAYMENT SUCCESS - Redirecting to booking show page ===');
            
            return redirect()->route('bookings.show', $booking)
                ->with('success', 'Advance payment successful! Your booking is confirmed.');
            
        } catch (\Exception $e) {
            Log::error('Advance payment callback error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('packages.index')
                ->with('error', 'Payment processing failed.');
        }
    }

    public function success($bookingId)
    {
        $booking = Booking::with('package')->findOrFail($bookingId);
        
        // Only show success page for confirmed bookings
        if ($booking->payment_status !== 'paid' && $booking->payment_status !== 'partial') {
            return redirect()->route('home')->with('error', 'Payment not confirmed.');
        }
        
        return view('bookings.success', compact('booking'));
    }

    public function verifyPayment(Request $request)
    {
        return $this->handleCallback($request);
    }

    public function handleFailure(Request $request)
    {
        Log::error('Payment failure from Razorpay', $request->all());
        
        $bookingId = $request->input('booking_id');
        if ($bookingId) {
            $booking = Booking::find($bookingId);
            if ($booking) {
                $booking->update([
                    'payment_status' => 'failed',
                    'status' => 'pending'
                ]);
            }
        }
        
        return redirect()->route('home')->with('error', 'Payment failed. Please try again.');
    }

    public function index()
    {
        $payments = Payment::with('booking.package')->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load('booking.package');
        return view('admin.payments.show', compact('payment'));
    }

    public function markAsPaid($invoiceId)
    {
        // This method would be implemented for invoice payments
        return response()->json(['success' => true]);
    }
}