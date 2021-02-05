<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
       'id', 'name', 'password', 'email', 'phone', 'photo'
    ];

    protected $dates=['created_at','updated_at'];

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
