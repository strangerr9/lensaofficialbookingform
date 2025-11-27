<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [
        'booking_code', 'bride_name', 'bride_phone', 'bride_email', 
        'groom_name', 'groom_phone', 'groom_email', 
        'package_id', 'notes', 'same_day',  'status', 'tnc',
    ];

    public function events()
    {
        return $this->hasMany(Event_booking::class);
    }

    public function package()
    {
        return $this->belongsTo(Packages::class);
    }
}
