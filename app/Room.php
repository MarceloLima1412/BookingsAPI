<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
   // use SoftDeletes;

    protected $fillable = [
        'id', 'room', 'type'
    ];

    protected $dates=['created_at','updated_at'];

    public function bookingrel()
    {
        return $this->hasMany(Booking::class);
    }

}
