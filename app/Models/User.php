<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'status',
        'profile_image',
        'emergency_contact',
        'emergency_phone',
        'pilot_license',
        'experience_level',
        'total_flights',
        'bio',
        'date_of_birth',
        'address',
        'city',
        'country',
        'postal_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
    ];

    // Paragliding Platform Relationships
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function achievements(): BelongsToMany
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')
            ->withPivot('unlocked_at', 'progress', 'metadata')
            ->withTimestamps();
    }

    public function flightLogs(): HasMany
    {
        return $this->hasMany(FlightLog::class);
    }

    public function userGalleries(): HasMany
    {
        return $this->hasMany(UserGallery::class);
    }

    public function statistics(): HasOne
    {
        return $this->hasOne(UserStatistics::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // Helper methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isInstructor(): bool
    {
        return $this->role === 'instructor';
    }

    public function isPilot(): bool
    {
        return $this->role === 'pilot';
    }

    public function getProfileImageUrlAttribute(): string
    {
        return $this->profile_image 
            ? asset('storage/' . $this->profile_image) 
            : asset('images/default-avatar.png');
    }

    public function getExperienceLevelBadgeAttribute(): string
    {
        $badges = [
            'beginner' => '🟢',
            'intermediate' => '🔵',
            'advanced' => '🟣',
            'expert' => '🔴',
            'master' => '⭐'
        ];

        return $badges[$this->experience_level] ?? '🟢';
    }
}
