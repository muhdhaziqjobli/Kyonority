<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'age',
        'address',
        'postcode',
        'city',
        'state',
        'coord',
        'phone_number',
        'income',
        'occupation',
        'household_member',
        'bio',
        'files',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
