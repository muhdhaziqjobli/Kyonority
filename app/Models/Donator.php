<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donator extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'email',
        'phone_number',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
