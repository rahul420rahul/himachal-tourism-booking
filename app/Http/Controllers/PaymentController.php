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

    /**
     * Create Razorpay Order
     */
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
                'amount' => $validated['amount'] * 100,
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
                    'name' => $booking->customer_name ?? '',
                    'email' => $booking->customer_email ?? '',
                    'contact' => $booking->customer_phone ?? ''
                ],
                'theme' => [
                    'color' => '#3399cc'
                ],
                'callback_url' => route('payments.callback')
            ]);

        } catch (\Exception $e) {
            Log::error('Payment order creation failed.', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Payment order creation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle Payment Callback
     */
    public function handleCallback(Request $request)
    {
        Log::info('Payment callback received.', $request->all());

        $paymentId = $request->input('razorpay_payment_id');
        $orderId   = $request->input('razorpay_order_id');
        $signature = $request->input('razorpay_signature');

        if (!$paymentId || !$signature) {
            return redirect()->route('home')->with('error', 'Invalid payment data.');
        }

        // Find booking by multiple ways
        $booking = null;
        if ($orderId) {
            $booking = Booking::where('razorpay_order_id', $orderId)->first();
        }
        if (!$booking && $request->has('booking_id')) {
            $booking = Booking::find($request->input('booking_id'));
        }
        if (!$booking) {
            $booking = Booking::whereJsonContains('notes', $orderId)->first();
        }

        if (!$booking) {
            return redirect()->route('home')->with('error', 'Booking not found.');
        }

        try {
            // Verify payment signature
            $api = new Api($this->razorpayId, $this->razorpayKey);
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $orderId ?? $booking->razorpay_order_id,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature
            ]);

            // Update booking
            $booking->update([
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signature,
                'razorpay_order_id' => $orderId ?? $booking->razorpay_order_id,
                'payment_status' => 'paid',
                'status' => 'confirmed',
                'paid_at' => now()
            ]);

            return redirect()->route('bookings.success', $booking->id)
                ->with('success', 'Payment successful! Your booking is confirmed.');

        } catch (\Exception $e) {
            Log::error('Payment verification failed.', ['error' => $e->getMessage()]);
            $booking->update([
                'payment_status' => 'failed',
                'status' => 'pending'
            ]);
            return redirect()->route('home')->with('error', 'Payment verification failed.');
        }
    }

    /**
     * Success Page
     */
    public function success($bookingId)
    {
        $booking = Booking::with('package')->findOrFail($bookingId);
        return view('bookings.success', compact('booking'))
            ->with('success', 'Payment successful! Your booking has been confirmed.');
    }
}
