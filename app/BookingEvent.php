<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingEvent extends Model
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
        return $this->belongsTo(Booking::class);
    }
}
