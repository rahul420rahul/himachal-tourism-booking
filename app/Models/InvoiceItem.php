
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'description',
        'quantity',
        'unit_price',
        'total_price',
        'item_code',
        'hsn_sac_code',
        'tax_rate',
        'tax_amount',
        'discount_rate',
        'discount_amount'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_rate' => 'decimal:2',
        'discount_amount' => 'decimal:2'
    ];

    // Relationships
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    // Mutators
    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = max(1, intval($value));
        $this->calculateTotalPrice();
    }

    public function setUnitPriceAttribute($value)
    {
        $this->attributes['unit_price'] = number_format($value, 2, '.', '');
        $this->calculateTotalPrice();
    }

    public function setTaxRateAttribute($value)
    {
        $this->attributes['tax_rate'] = min(100, max(0, $value));
        $this->calculateTaxAmount();
    }

    // Methods
    public function calculateTotalPrice()
    {
        if (isset($this->attributes['quantity']) && isset($this->attributes['unit_price'])) {
            $subtotal = $this->attributes['quantity'] * $this->attributes['unit_price'];
            $discountAmount = ($subtotal * ($this->discount_rate ?? 0)) / 100;
            $taxAmount = (($subtotal - $discountAmount) * ($this->tax_rate ?? 0)) / 100;
            
            $this->attributes['discount_amount'] = $discountAmount;
            $this->attributes['tax_amount'] = $taxAmount;
            $this->attributes['total_price'] = $subtotal - $discountAmount + $taxAmount;
        }
    }

    public function calculateTaxAmount()
    {
        if (isset($this->attributes['quantity']) && isset($this->attributes['unit_price'])) {
            $subtotal = $this->attributes['quantity'] * $this->attributes['unit_price'];
            $discountAmount = ($subtotal * ($this->discount_rate ?? 0)) / 100;
            $taxAmount = (($subtotal - $discountAmount) * $this->attributes['tax_rate']) / 100;
            
            $this->attributes['tax_amount'] = $taxAmount;
            $this->attributes['total_price'] = $subtotal - $discountAmount + $taxAmount;
        }
    }

    // Boot method for auto-calculation
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            $item->calculateTotalPrice();
        });
    }
}
