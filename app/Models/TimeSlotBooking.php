<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeSlotBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'booking_date', 
        'time_slot',
        'booked_participants',
        'max_participants',
        'status',
        'weather_status'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'weather_status' => 'array'
    ];

    // Relationships
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'time_slot', 'time_slot')
                   ->where('package_id', $this->package_id)
                   ->whereDate('booking_date', $this->booking_date);
    }

    // Helper methods
    public function isAvailable()
    {
        return $this->status === 'available' && $this->booked_participants < $this->max_participants;
    }

    public function isFull()
    {
        return $this->booked_participants >= $this->max_participants;
    }

    public function getRemainingCapacityAttribute()
    {
        return max(0, $this->max_participants - $this->booked_participants);
    }

    public function getCapacityPercentageAttribute()
    {
        if ($this->max_participants == 0) return 0;
        return round(($this->booked_participants / $this->max_participants) * 100);
    }

    public function addParticipants($count)
    {
        if ($this->booked_participants + $count > $this->max_participants) {
            throw new \Exception('Not enough capacity for ' . $count . ' participants');
        }

        $this->increment('booked_participants', $count);
        
        if ($this->booked_participants >= $this->max_participants) {
            $this->update(['status' => 'full']);
        }
    }

    public function removeParticipants($count)
    {
        $this->decrement('booked_participants', min($count, $this->booked_participants));
        
        if ($this->booked_participants < $this->max_participants && $this->status === 'full') {
            $this->update(['status' => 'available']);
        }
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')
                    ->whereColumn('booked_participants', '<', 'max_participants');
    }

    public function scopeForDate($query, $date)
    {
        return $query->whereDate('booking_date', $date);
    }

    public function scopeForPackage($query, $packageId)
    {
        return $query->where('package_id', $packageId);
    }

    // Static methods
    public static function createForPackageDate($packageId, $date)
    {
        $package = Package::findOrFail($packageId);
        
        if (!$package->available_time_slots) {
            return collect();
        }

        $timeSlots = $package->available_time_slots;
        $maxParticipants = $package->max_participants_per_slot ?? 10;
        
        $createdSlots = collect();

        foreach ($timeSlots as $period => $slots) {
            if (is_array($slots)) {
                foreach ($slots as $slot) {
                    $timeSlotBooking = static::firstOrCreate([
                        'package_id' => $packageId,
                        'booking_date' => $date,
                        'time_slot' => $slot,
                    ], [
                        'booked_participants' => 0,
                        'max_participants' => $maxParticipants,
                        'status' => 'available',
                        'weather_status' => null
                    ]);
                    
                    $createdSlots->push($timeSlotBooking);
                }
            }
        }

        return $createdSlots;
    }

    public static function getAvailableSlots($packageId, $date)
    {
        return static::forPackage($packageId)
                    ->forDate($date)
                    ->available()
                    ->get();
    }
}
