@component('mail::message')
# New Booking Received

A new photography booking has been submitted.

**Bride:** {{ $booking->bride_name }}  
**Groom:** {{ $booking->groom_name }}  
**Wedding Date:** {{ $booking->wedding_date->format('d M Y') }}  
**Venue Type:** {{ ucfirst($booking->venue_type) }}  
**Venue Address:** {{ $booking->venue_address }}  

**Package:** {{ $booking->package ?? '-' }}

**Notes:**  
{{ $booking->notes ?? '-' }}

@component('mail::button', ['url' => url('/admin/bookings/'.$booking->id ?? '#')])
View Booking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
