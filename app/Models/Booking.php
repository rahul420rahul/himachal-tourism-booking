<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'razorpay_balance_order_id',
'razorpay_balance_payment_id', 
'razorpay_balance_signature',
'balance_paid_at',
    'booking_number',
    'user_id',
    'package_id',
    'booking_date',
    'participants',
    'number_of_people',
    'guest_name',           // ADD THIS
    'guest_email',          // ADD THIS  
    'guest_phone',          // ADD THIS
    'package_price',        // ADD THIS
    'pending_amount',       // ADD THIS
    'total_amount',
    'discount_amount',
    'final_amount',
    'advance_amount',
    'remaining_amount',
    'advance_percentage',
    'advance_paid',
    'full_payment_required',
    'advance_paid_at',
    'status',
    'booking_status',
    'payment_status',
    'participant_details',
    'special_requests',
    'emergency_contact',
    'emergency_phone',
    'medical_conditions',
    'cancellation_reason',
    'notes',
    'time_slot',
    'razorpay_order_id',
    'razorpay_payment_id',
    'razorpay_signature',
    'payment_method',
    'paid_at',
];

    // FIX: Remove decimal casting to avoid BrickMath issues
    protected $casts = [
        'booking_date' => 'date',
        'total_amount' => 'float',
        'discount_amount' => 'float', 
        'final_amount' => 'float',
        'advance_amount' => 'float',        // NEW
        'remaining_amount' => 'float',      // NEW
        'advance_percentage' => 'float',    // NEW
        'advance_paid' => 'boolean',        // NEW
        'full_payment_required' => 'boolean', // NEW
        'advance_paid_at' => 'datetime',    // NEW
        'participant_details' => 'array',
        'medical_conditions' => 'array',
        'paid_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // Helper methods
    public function generateBookingNumber()
    {
        return 'BIR' . date('Ymd') . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending'   => 'yellow',
            'confirmed' => 'blue',
            'completed' => 'green',
            'cancelled' => 'red',
            default     => 'gray'
        };
    }

    public function getPaymentStatusColorAttribute()
    {
        return match ($this->payment_status) {
            'pending'    => 'yellow',
            'processing' => 'blue',
            'paid'       => 'green',
            'failed'     => 'red',
            'refunded'   => 'orange',
            default      => 'gray'
        };
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByPaymentStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', now()->toDateString());
    }

    // Get formatted participant details
    public function getFormattedParticipantDetailsAttribute()
    {
        $details = $this->participant_details ?? [];
        return [
            'name'     => $details['contact_name'] ?? $details['customer_name'] ?? 'N/A',
            'email'    => $details['contact_email'] ?? $details['customer_email'] ?? 'N/A',
            'phone'    => $details['contact_phone'] ?? $details['customer_phone'] ?? 'N/A',
            'adults'   => $details['adults'] ?? 0,
            'children' => $details['children'] ?? 0,
        ];
    }

    // Get customer name from participant details
    public function getCustomerNameAttribute()
    {
        $details = is_array($this->participant_details)
            ? $this->participant_details
            : json_decode($this->participant_details, true) ?? [];
        return $details['contact_name'] ?? $details['customer_name'] ?? ($this->user->name ?? 'N/A');
    }

    // Get customer email from participant details
    public function getCustomerEmailAttribute()
    {
        $details = is_array($this->participant_details)
            ? $this->participant_details
            : json_decode($this->participant_details, true) ?? [];
        return $details['contact_email'] ?? $details['customer_email'] ?? ($this->user->email ?? 'N/A');
    }

    // Get customer phone from participant details
    public function getCustomerPhoneAttribute()
    {
        $details = is_array($this->participant_details)
            ? $this->participant_details
            : json_decode($this->participant_details, true) ?? [];
        return $details['contact_phone'] ?? $details['customer_phone'] ?? 'N/A';
    }

    // Get adults count
    public function getAdultsAttribute()
    {
        $details = is_array($this->participant_details)
            ? $this->participant_details
            : json_decode($this->participant_details, true) ?? [];
        return (int) ($details['adults'] ?? 1);
    }

    // Get children count  
    public function getChildrenAttribute()
    {
        $details = is_array($this->participant_details)
            ? $this->participant_details
            : json_decode($this->participant_details, true) ?? [];
        return (int) ($details['children'] ?? 0);
    }

    // Check if payment is successful
    public function isPaymentSuccessful()
    {
        return $this->payment_status === 'paid' && !empty($this->razorpay_payment_id);
    }

    // Get total participants
    public function getTotalParticipantsAttribute()
    {
        return $this->adults + $this->children;
    }

    // Get formatted time slot
    public function getFormattedTimeSlotAttribute()
    {
        if (!$this->time_slot) {
            return 'To be decided';
        }
        
        return $this->time_slot;
    }

    // Check if booking requires weather check
    public function requiresWeatherCheck()
    {
        return $this->package && $this->package->requires_weather_check;
    }

    // FIX: Add custom accessor for decimal formatting
    public function getTotalAmountAttribute($value)
    {
        return $value ? number_format((float)$value, 2, '.', '') : '0.00';
    }

    public function getFinalAmountAttribute($value)
    {
        return $value ? number_format((float)$value, 2, '.', '') : '0.00';
    }

    public function getDiscountAmountAttribute($value)
    {
        return $value ? number_format((float)$value, 2, '.', '') : '0.00';
    }

    // NEW ADVANCE PAYMENT METHODS
    public function isAdvancePaid()
    {
        return $this->advance_paid;
    }

    public function isFullyPaid()
    {
        return $this->payment_status === 'paid' && 
               ($this->full_payment_required || $this->remaining_amount <= 0);
    }

    public function hasRemainingPayment()
    {
        return !$this->full_payment_required && $this->remaining_amount > 0 && $this->advance_paid;
    }

    public function markAdvancePaid()
    {
        $this->update([
            'advance_paid' => true,
            'advance_paid_at' => now(),
            'payment_status' => $this->full_payment_required ? 'paid' : 'advance_paid'
        ]);
    }

    public function markFullyPaid()
    {
        $this->update([
            'payment_status' => 'paid',
            'status' => 'confirmed'
        ]);
    }

    // Get payment status text
    public function getPaymentStatusTextAttribute()
    {
        if ($this->full_payment_required) {
            return $this->payment_status === 'paid' ? 'Fully Paid' : 'Payment Pending';
        }

        if ($this->advance_paid && $this->remaining_amount <= 0) {
            return 'Fully Paid';
        } elseif ($this->advance_paid) {
            return 'Advance Paid - ₹' . number_format($this->remaining_amount) . ' Remaining';
        } else {
            return 'Advance Payment Pending - ₹' . number_format($this->advance_amount);
        }
    }

    // Get next payment amount
    public function getNextPaymentAmountAttribute()
    {
        if (!$this->advance_paid) {
            return $this->advance_amount;
        }
        return $this->remaining_amount;
    }
}
