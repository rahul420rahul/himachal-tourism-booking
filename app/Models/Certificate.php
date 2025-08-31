<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'name',
        'certificate_number',
        'issue_date',
        'expiry_date',
        'issuing_authority',
        'verification_code',
        'qr_code',
        'file_path',
        'status',
        'metadata'
    ];

    // Important: Don't cast to date objects, keep as strings to avoid null format errors
    protected $casts = [
        'metadata' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
