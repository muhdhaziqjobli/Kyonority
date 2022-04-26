<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $casts = [
        'icons' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'details',
        'is_active',
        'icons',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
