<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'user_id',
        'booking_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_gstin',
        'invoice_date',
        'due_date',
        'status',
        'payment_status',
        'subtotal',
        'tax_rate',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'paid_amount',
        'balance_amount',
        'notes',
        'terms_conditions',
        'currency',
        'is_recurring',
        'recurring_period',
        'next_invoice_date',
        'sent_at',
        'paid_at',
        'payment_history'
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'next_invoice_date' => 'date',
        'sent_at' => 'datetime',
        'paid_at' => 'datetime',
        'payment_history' => 'array',
        'subtotal' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance_amount' => 'decimal:2',
        'is_recurring' => 'boolean'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // Scopes
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue')
                    ->where('due_date', '<', now());
    }

    public function scopeRecurring($query)
    {
        return $query->where('is_recurring', true);
    }

    // Accessors & Mutators
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total_amount, 2);
    }

    public function getIsOverdueAttribute()
    {
        return $this->due_date < now() && $this->payment_status !== 'paid';
    }

    public function getRemainingDaysAttribute()
    {
        return $this->due_date->diffInDays(now(), false);
    }

    // Methods
    public function generateInvoiceNumber()
    {
        $lastInvoice = static::orderBy('id', 'desc')->first();
        $number = $lastInvoice ? intval(substr($lastInvoice->invoice_number, 4)) + 1 : 1;
        return 'INV-' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }

    public function calculateTotal()
    {
        $subtotal = $this->items->sum('total_price');
        $taxAmount = ($subtotal * $this->tax_rate) / 100;
        $total = $subtotal + $taxAmount - $this->discount_amount;
        
        $this->update([
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_amount' => $total,
            'balance_amount' => $total - $this->paid_amount
        ]);
    }

    public function markAsPaid($paymentAmount = null)
    {
        $amount = $paymentAmount ?: $this->total_amount;
        
        $this->update([
            'paid_amount' => $this->paid_amount + $amount,
            'balance_amount' => $this->total_amount - ($this->paid_amount + $amount),
            'payment_status' => $this->balance_amount <= 0 ? 'paid' : 'partially_paid',
            'status' => $this->balance_amount <= 0 ? 'paid' : $this->status,
            'paid_at' => $this->balance_amount <= 0 ? now() : $this->paid_at
        ]);
    }

    public function sendInvoice()
    {
        $this->update([
            'status' => 'sent',
            'sent_at' => now()
        ]);
        
        // Add email sending logic here
        // Mail::to($this->customer_email)->send(new InvoiceMail($this));
    }
}
