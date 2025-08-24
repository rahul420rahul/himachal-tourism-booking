<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryMemory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'file_path',
        'thumbnail_path',
        'original_filename',
        'file_size',
        'mime_type',
        'likes_count',
        'liked_by_ips',
        'is_approved',
        'uploaded_by_ip'
    ];

    protected $casts = [
        'liked_by_ips' => 'array',
        'is_approved' => 'boolean'
    ];

    // Get file URL
    public function getFileUrlAttribute()
    {
        return Storage::url($this->file_path);
    }

    // Get thumbnail URL
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_path) {
            return Storage::url($this->thumbnail_path);
        }
        return $this->file_url;
    }

    // Check if IP has liked
    public function isLikedByIp($ip)
    {
        return in_array($ip, $this->liked_by_ips ?? []);
    }

    // Toggle like
    public function toggleLike($ip)
    {
        $likedIps = $this->liked_by_ips ?? [];
        
        if (in_array($ip, $likedIps)) {
            // Remove like
            $likedIps = array_filter($likedIps, fn($item) => $item !== $ip);
            $this->likes_count--;
        } else {
            // Add like
            $likedIps[] = $ip;
            $this->likes_count++;
        }
        
        $this->liked_by_ips = array_values($likedIps);
        $this->save();
        
        return !in_array($ip, $this->liked_by_ips ?? []);
    }

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePhotos($query)
    {
        return $query->where('type', 'photo');
    }

    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }
}
