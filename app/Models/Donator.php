<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Donator extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $fillable = [
        'email',
        'phone_number',
        'password'
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function requests()
    {
        return $this->belongsToMany(Request::class)
                ->as('donation')
                ->withPivot('type', 'price')
                ->withTimestamps();
    }
}
