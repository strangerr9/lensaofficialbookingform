<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_booking extends Model
{
    protected $fillable = [
        'event_code',
        'event_type',
        'event_date',
        'venue_type',
        'venue_address',
        'booking_id',
    ];


    public function booking()
    {
        return $this->belongsTo(Bookings::class);
    }
}
