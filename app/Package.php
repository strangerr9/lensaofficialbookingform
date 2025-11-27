<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name', 'short_code', 'events_included', 'price', 'description'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
