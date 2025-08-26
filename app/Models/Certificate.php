<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['user_id', 'type', 'title', 'description', 'certificate_number', 'issued_date'];
    protected $casts = ['issued_date' => 'date'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
