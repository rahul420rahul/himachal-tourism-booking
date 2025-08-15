public function handleCallback(Request $request)
{
    Log::info('Payment callback received.', $request->all());

    $paymentId = $request->input('razorpay_payment_id');
    $orderId   = $request->input('razorpay_order_id');
    $signature = $request->input('razorpay_signature');

    if (!$paymentId || !$signature) {
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'Invalid payment data.'], 400);
        }
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
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'Booking not found.'], 404);
        }
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

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('bookings.success', $booking->id),
                'message' => 'Payment successful! Your booking is confirmed.'
            ]);
        }

        return redirect()->route('bookings.success', $booking->id)
            ->with('success', 'Payment successful! Your booking is confirmed.');

    } catch (\Exception $e) {
        Log::error('Payment verification failed.', ['error' => $e->getMessage()]);
        $booking->update([
            'payment_status' => 'failed',
            'status' => 'pending'
        ]);
        
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'Payment verification failed.'], 400);
        }
        return redirect()->route('home')->with('error', 'Payment verification failed.');
    }
}
