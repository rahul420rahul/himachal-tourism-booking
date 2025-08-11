<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'invoice_id',
        'payment_id',
        'order_id',
        'amount',
        'currency',
        'status',
        'payment_method',
        'gateway_response',
        'paid_at',
        'refund_amount',
        'refund_reason',
        'refunded_at',
        'transaction_id',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'notes',
        'failure_reason',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'refund_amount' => 'decimal:2',
        'gateway_response' => 'array',
        'paid_at' => 'datetime',
        'refunded_at' => 'datetime',
        'notes' => 'array',
    ];

    // Relationships
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    // Status Helper Methods
    public function isCreated()
    {
        return $this->status === 'created';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isSuccess()
    {
        return $this->status === 'success' || $this->status === 'completed';
    }

    public function isFailed()
    {
        return $this->status === 'failed';
    }

    public function isRefunded()
    {
        return $this->status === 'refunded';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    // Accessors
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'created' => 'gray',
            'pending' => 'yellow',
            'success', 'completed' => 'green',
            'failed' => 'red',
            'refunded' => 'orange',
            'cancelled' => 'red',
            default => 'gray'
        };
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'created' => 'bg-gray-100 text-gray-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'success', 'completed' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'refunded' => 'bg-orange-100 text-orange-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function getFormattedAmountAttribute()
    {
        return '₹' . number_format($this->amount, 2);
    }

    public function getFormattedRefundAmountAttribute()
    {
        return $this->refund_amount ? '₹' . number_format($this->refund_amount, 2) : null;
    }

    public function getPaymentMethodDisplayAttribute()
    {
        return match($this->payment_method) {
            'card' => 'Credit/Debit Card',
            'netbanking' => 'Net Banking',
            'upi' => 'UPI',
            'wallet' => 'Wallet',
            'cash' => 'Cash',
            'cheque' => 'Cheque',
            'bank_transfer' => 'Bank Transfer',
            default => ucfirst($this->payment_method)
        };
    }

    public function getCanRefundAttribute()
    {
        return $this->isSuccess() && !$this->isRefunded() && $this->refund_amount === null;
    }

    public function getCanCancelAttribute()
    {
        return in_array($this->status, ['created', 'pending']);
    }

    // Scopes
    public function scopeSuccessful($query)
    {
        return $query->whereIn('status', ['success', 'completed']);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeForBooking($query, $bookingId)
    {
        return $query->where('booking_id', $bookingId);
    }

    public function scopeForInvoice($query, $invoiceId)
    {
        return $query->where('invoice_id', $invoiceId);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByPaymentMethod($query, $method)
    {
        return $query->where('payment_method', $method);
    }

    public function scopeRefunded($query)
    {
        return $query->where('status', 'refunded');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    // Methods
    public function markAsSuccess($transactionId = null, $gatewayResponse = null)
    {
        $this->update([
            'status' => 'completed',
            'paid_at' => now(),
            'transaction_id' => $transactionId,
            'gateway_response' => $gatewayResponse,
        ]);
    }

    public function markAsFailed($reason = null, $gatewayResponse = null)
    {
        $this->update([
            'status' => 'failed',
            'failure_reason' => $reason,
            'gateway_response' => $gatewayResponse,
        ]);
    }

    public function processRefund($amount = null, $reason = null)
    {
        $refundAmount = $amount ?? $this->amount;
        
        $this->update([
            'status' => 'refunded',
            'refund_amount' => $refundAmount,
            'refund_reason' => $reason,
            'refunded_at' => now(),
        ]);

        return $this;
    }

    public function cancel($reason = null)
    {
        if (!$this->can_cancel) {
            return false;
        }

        $this->update([
            'status' => 'cancelled',
            'failure_reason' => $reason,
        ]);

        return true;
    }

    // Static methods for statistics
    public static function totalRevenue($period = null)
    {
        $query = static::successful();
        
        if ($period) {
            match($period) {
                'today' => $query->today(),
                'month' => $query->thisMonth(),
                'recent' => $query->recent(),
                default => null
            };
        }

        return $query->sum('amount');
    }

    public static function totalRefunds($period = null)
    {
        $query = static::refunded();
        
        if ($period) {
            match($period) {
                'today' => $query->today(),
                'month' => $query->thisMonth(),
                'recent' => $query->recent(),
                default => null
            };
        }

        return $query->sum('refund_amount');
    }

    public static function successRate($period = null)
    {
        $query = static::query();
        
        if ($period) {
            match($period) {
                'today' => $query->today(),
                'month' => $query->thisMonth(),
                'recent' => $query->recent(),
                default => null
            };
        }

        $total = $query->count();
        $successful = $query->successful()->count();

        return $total > 0 ? round(($successful / $total) * 100, 2) : 0;
    }

    // Boot method for automatic updates
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (!$payment->currency) {
                $payment->currency = 'INR';
            }
        });

        static::updating(function ($payment) {
            // Update related invoice payment status if exists
            if ($payment->invoice_id && $payment->isDirty('status')) {
                $invoice = $payment->invoice;
                if ($invoice && $payment->isSuccess()) {
                    $invoice->markAsPaid($payment->amount);
                }
            }
        });
    }
}
