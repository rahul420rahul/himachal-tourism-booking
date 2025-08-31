<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'file_path',
        'file_type',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopePublicGallery($query)
    {
        return $query->where('is_public', true);
    }
    
    public function scopePersonalGallery($query)
    {
        return $query->where('is_public', false);
    }
}
