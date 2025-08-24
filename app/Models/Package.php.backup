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
        'duration_days',
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
               stripos($name, 'flying') !== false;
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
