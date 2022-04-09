<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'donation_count',
        'total_price',
        'no_of_users',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
