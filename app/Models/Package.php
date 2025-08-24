<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'discount_price',
        'duration',
        'max_participants',
        'inclusions',
        'exclusions',
        'requirements',
        'difficulty_level',
        'category',
        'location',
        'latitude',
        'longitude',
        'gallery_images',
        'featured_image',
        'is_active',
        'sort_order',
        'weather_dependency',
        'available_time_slots',
        'max_participants_per_slot',
        'requires_weather_check',
        'safety_requirements',
        'advance_payment_percentage',
    ];

    protected $casts = [
        'price' => 'float',
        'discount_price' => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
        'inclusions' => 'array',
        'exclusions' => 'array',
        'gallery_images' => 'array',
        'weather_dependency' => 'array',
        'available_time_slots' => 'array',
        'is_active' => 'boolean',
        'requires_weather_check' => 'boolean',
        'advance_payment_percentage' => 'float',
    ];

    // Relationships
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function timeSlotBookings(): HasMany
    {
        return $this->hasMany(TimeSlotBooking::class);
    }

    // Helper methods
    public function getEffectivePriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    // Add method version for calculations
    public function getEffectivePrice()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->discount_price) {
            return round((($this->price - $this->discount_price) / $this->price) * 100);
        }
        return 0;
    }

    public function getAvailableTimeSlotsForDateAttribute()
    {
        if (!$this->available_time_slots) {
            return [];
        }
        
        $slots = [];
        foreach ($this->available_time_slots as $period => $periodSlots) {
            if (is_array($periodSlots)) {
                $slots = array_merge($slots, $periodSlots);
            }
        }
        
        return $slots;
    }

    public function isWeatherDependent()
    {
        return $this->requires_weather_check || 
               stripos($this->name, 'paragliding') !== false ||
               stripos($this->name, 'flying') !== false; // FIXED: was $name, now $this->name
    }

    public function getAdvancePaymentAmountAttribute()
    {
        return $this->effective_price * ($this->advance_payment_percentage / 100);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeWeatherDependent($query)
    {
        return $query->where('requires_weather_check', true);
    }

    // NEW ADVANCE PAYMENT METHODS
    
    // Get advance payment percentage based on package type
    public function getAdvancePaymentPercentage()
    {
        // Check if set in database first
        if ($this->advance_payment_percentage > 0) {
            return $this->advance_payment_percentage;
        }

        // Default rules based on package name/category
        $packageName = strtolower($this->name);
        
        // Course packages - 50% advance for big courses
        if (str_contains($packageName, 'course') || 
            str_contains($packageName, 'training') ||
            str_contains($packageName, 'basic') ||
            str_contains($packageName, 'intermediate') ||
            str_contains($packageName, 'advanced')) {
            return 50; // 50% advance for courses
        }
        
        // Tandem flights - ₹500 per person (calculate percentage)
        if (str_contains($packageName, 'tandem')) {
            $effectivePrice = $this->getEffectivePrice();
            if ($effectivePrice > 0) {
                $percentage = (500 / $effectivePrice) * 100;
                return min($percentage, 50); // Max 50% advance
            }
            return 30; // Default 30% for tandem
        }
        
        return 40; // Default 40% advance
    }

    // Calculate advance amount for given participants
    public function calculateAdvanceAmount($participants = 1)
    {
        $totalPrice = $this->getEffectivePrice() * $participants;
        $advancePercentage = $this->getAdvancePaymentPercentage();
        
        $advanceAmount = $totalPrice * ($advancePercentage / 100);
        
        // For tandem flights, ensure minimum ₹500 per person
        if (str_contains(strtolower($this->name), 'tandem')) {
            $minimumAdvance = 500 * $participants;
            $advanceAmount = max($advanceAmount, $minimumAdvance);
        }
        
        return round($advanceAmount, 2);
    }

    // Calculate remaining amount
    public function calculateRemainingAmount($participants = 1)
    {
        $totalPrice = $this->getEffectivePrice() * $participants;
        $advanceAmount = $this->calculateAdvanceAmount($participants);
        
        return round($totalPrice - $advanceAmount, 2);
    }

    // Check if package requires full payment upfront
    public function requiresFullPayment()
    {
        // Small amount packages (less than ₹2000) - full payment
        return $this->getEffectivePrice() < 2000;
    }

    // Get payment info for display
    public function getPaymentInfo($participants = 1)
    {
        $totalPrice = $this->getEffectivePrice() * $participants;
        $advanceAmount = $this->calculateAdvanceAmount($participants);
        $remainingAmount = $this->calculateRemainingAmount($participants);
        $requiresFullPayment = $this->requiresFullPayment();
        
        return [
            'total_price' => $totalPrice,
            'advance_amount' => $requiresFullPayment ? $totalPrice : $advanceAmount,
            'remaining_amount' => $requiresFullPayment ? 0 : $remainingAmount,
            'advance_percentage' => $requiresFullPayment ? 100 : $this->getAdvancePaymentPercentage(),
            'requires_full_payment' => $requiresFullPayment,
            'payment_type' => $requiresFullPayment ? 'full' : 'advance'
        ];
    }

    // Slug Auto-Generation
    public static function boot()
    {
        parent::boot();

        static::creating(function ($package) {
            $package->slug = Str::slug($package->name);
            $original = $package->slug;
            $count = 1;
            while (static::whereSlug($package->slug)->exists()) {
                $package->slug = "$original-$count";
                $count++;
            }
        });

        static::updating(function ($package) {
            if ($package->isDirty('name')) {
                $package->slug = Str::slug($package->name);
                $original = $package->slug;
                $count = 1;
                while (static::whereSlug($package->slug)->where('id', '!=', $package->id)->exists()) {
                    $package->slug = "$original-$count";
                    $count++;
                }
            }
        });
    }

    // Use slug for route binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
