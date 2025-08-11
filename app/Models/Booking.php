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
        'booking_number',
        'user_id',
        'package_id',
        'booking_date',
        'participants',
        'number_of_people',
        'total_amount',
        'discount_amount',
        'final_amount',
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
    ];

    protected $casts = [
        'booking_date' => 'date',
        'total_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
        'participant_details' => 'array',
        'medical_conditions' => 'array',
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
        return 'BIR' . date('Y') . str_pad($this->id, 6, '0', STR_PAD_LEFT);
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
        return match($this->status) {
            'pending' => 'yellow',
            'confirmed' => 'blue',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray'
        };
    }

    public function getPaymentStatusColorAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'yellow',
            'paid' => 'green',
            'failed' => 'red',
            'refunded' => 'blue',
            default => 'gray'
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
            'name' => $details['customer_name'] ?? 'N/A',
            'email' => $details['customer_email'] ?? 'N/A',
            'phone' => $details['customer_phone'] ?? 'N/A',
            'adults' => $details['adults'] ?? 0,
            'children' => $details['children'] ?? 0,
        ];
    }

    // Get customer name from participant details
    public function getCustomerNameAttribute()
    {
        $details = $this->participant_details ?? [];
        return $details['customer_name'] ?? $this->user->name ?? 'N/A';
    }

    // Get customer email from participant details
    public function getCustomerEmailAttribute()
    {
        $details = $this->participant_details ?? [];
        return $details['customer_email'] ?? $this->user->email ?? 'N/A';
    }

    // Get customer phone from participant details
    public function getCustomerPhoneAttribute()
    {
        $details = $this->participant_details ?? [];
        return $details['customer_phone'] ?? 'N/A';
    }
}
