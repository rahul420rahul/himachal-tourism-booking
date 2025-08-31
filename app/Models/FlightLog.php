<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightLog extends Model
{
    protected $fillable = [
        'user_id',
        'flight_date',
        'location',
        'duration',
        'max_altitude',
        'notes',
    ];

    protected $casts = [
        'flight_date' => 'date',
        'duration' => 'decimal:2',
        'max_altitude' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
