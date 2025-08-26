<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserGallery extends Model
{
    protected $fillable = [
        'user_id', 'type', 'title', 'description', 'file_path',
        'thumbnail_path', 'location', 'taken_date', 'tags',
        'views', 'likes', 'is_public', 'metadata'
    ];

    protected $casts = [
        'taken_date' => 'date',
        'tags' => 'array',
        'metadata' => 'array',
        'is_public' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
