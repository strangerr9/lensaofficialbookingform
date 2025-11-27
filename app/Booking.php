<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code', 'bride_name', 'bride_phone', 'bride_email', 'bride_address',
        'groom_name', 'groom_phone', 'groom_email', 'groom_address',
        'package_id', 'same_day', 'notes', 'status',
    ];

    public function events()
    {
        return $this->hasMany(BookingEvent::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
