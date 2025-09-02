<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'booking_number',
        'user_id',
        'package_id',
        'booking_date',
        'time_slot',
        'participants',
        'number_of_people',
        'status',
        'total_amount',
        'advance_amount',
        'pending_amount',
        'final_amount',
        'payment_status',
        'special_requests',
        'guest_name',
        'guest_email',
        'guest_phone',
        'adults',
        'children',
        'package_price',
        'discount_amount',
        'tax_amount',
        'cancellation_reason',
        'cancelled_at',
        'participant_details',
        'meta_data',
        'metadata',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
        'razorpay_balance_order_id',
        'razorpay_balance_payment_id',
        'razorpay_balance_signature',
        'balance_paid_at'
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'metadata' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
