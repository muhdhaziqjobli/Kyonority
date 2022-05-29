<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_count',
        'donator_count',
        'request_count',
        'donation_count',
        'monetary_count',
        'aid_count',
        'total_donation',
        'highest_donation',
        'net_monetary',
        'net_aid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
