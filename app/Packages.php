<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $fillable = [
        'name', 'short_code', 'events_included', 'price', 'description'
    ];

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
}
