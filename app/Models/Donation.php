<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'type',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
    
    public function donator()
    {
        return $this->hasOne(Donator::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }
}
