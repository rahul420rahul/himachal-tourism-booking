<?php

namespace App\Services;

use Razorpay\Api\Api;
use Exception;

class RazorpayService
{
    private $api;

    public function __construct()
    {
        $keyId = env('RAZORPAY_KEY');
        $keySecret = env('RAZORPAY_SECRET');
        
        if ($keyId && $keySecret) {
            $this->api = new Api($keyId, $keySecret);
        }
    }

    public function createOrder($amount, $currency = 'INR', $receipt = null)
    {
        if (!$this->api) {
            throw new Exception('Razorpay not configured');
        }

        try {
            $orderData = [
                'receipt' => $receipt ?? 'order_' . time(),
                'amount' => $amount * 100, // Convert to paise
                'currency' => $currency,
                'payment_capture' => 1
            ];

            return $this->api->order->create($orderData);
        } catch (Exception $e) {
            throw new Exception('Failed to create order: ' . $e->getMessage());
        }
    }

    public function verifyPayment($razorpayOrderId, $razorpayPaymentId, $razorpaySignature)
    {
        if (!$this->api) {
            return false;
        }

        try {
            $attributes = [
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_signature' => $razorpaySignature
            ];

            $this->api->utility->verifyPaymentSignature($attributes);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
