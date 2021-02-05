<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class Booking extends Model
{
    protected $fillable = [
        'id', 'user', 'room', 'date'
    ];

    protected $dates=['created_at','updated_at'];
    //use softdeletes;

    public function roomrelation(){
        return $this->belongsTo(Room::class, 'room', 'id');
    }

    public function userrelation(){
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
