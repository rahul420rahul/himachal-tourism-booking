<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStatistics extends Model
{
    protected $fillable = [
        'user_id', 'total_flights', 'total_flight_hours', 'total_distance',
        'highest_altitude', 'longest_flight', 'total_sites_visited',
        'certificates_earned', 'achievements_unlocked', 'total_points',
        'pilot_level', 'ranking', 'favorite_sites', 'monthly_stats'
    ];

    protected $casts = [
        'favorite_sites' => 'array',
        'monthly_stats' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
