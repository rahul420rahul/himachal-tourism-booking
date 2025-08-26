<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';
    
    protected $fillable = [
        'user_id',
        'flight_log_id',
        'title',
        'description',
        'file_path',
        'type',
        'category',
        'is_public'
    ];

    protected $casts = [
        'is_public' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flightLog()
    {
        return $this->belongsTo(FlightLog::class);
    }

    // Helper method to get full URL
    public function getFileUrlAttribute()
    {
        if (str_starts_with($this->file_path, 'http')) {
            return $this->file_path;
        }
        return Storage::url($this->file_path);
    }

    // Helper method to check if it's an image
    public function getIsImageAttribute()
    {
        return in_array($this->type, ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp']);
    }

    // Helper method to check if it's a video
    public function getIsVideoAttribute()
    {
        return in_array($this->type, ['video/mp4', 'video/mpeg', 'video/quicktime', 'video/webm']);
    }
}
