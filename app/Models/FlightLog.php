<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FlightLog extends Model
{
    protected $fillable = [
        'user_id', 'date', 'site_name', 'launch_time', 'landing_time',
        'flight_duration', 'max_altitude', 'distance', 'glider_model',
        'weather_conditions', 'wind_speed', 'wind_direction', 'notes',
        'track_file', 'photos', 'is_verified', 'verified_by', 'tags'
    ];

    protected $casts = [
        'date' => 'datetime',
        'launch_time' => 'datetime',
        'landing_time' => 'datetime',
        'photos' => 'array',
        'tags' => 'array',
        'is_verified' => 'boolean',
        'max_altitude' => 'float',
        'distance' => 'float'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
