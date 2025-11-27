<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Package;

class BookingController extends Controller
{
   public function store(Request $request)
{
    $data = $request->validate([
        'bride_name' => 'required|string|max:255',
        'bride_phone' => 'required|regex:/^[0-9]+$/|max:15',
        'bride_email' => 'required|email|max:255',
        'bride_address' => 'nullable|string|max:255',
        'groom_name' => 'required|string|max:255',
        'groom_phone' => 'required|regex:/^[0-9]+$/|max:15',
        'groom_email' => 'required|email|max:255',
        'groom_address' => 'nullable|string|max:255',
        'package_id' => 'required|exists:packages,id',
        'same_day' => 'nullable|boolean',
        'notes' => 'nullable|string',

        // Event 1 validation
        'event_1_type' => 'required|string',
        'event_1_date' => 'required|date',
        'event_1_venue_type' => 'nullable|string',
        'event_1_venue_address' => 'nullable|string',

        // Event 2 validation
        'event_2_type' => 'nullable|string',
        'event_2_date' => 'nullable|date',
        'event_2_venue_type' => 'nullable|string',
        'event_2_venue_address' => 'nullable|string',
    ]);

    // Generate booking code
    $year = date('Y');
    $package = Package::findOrFail($data['package_id']);
    $packageCode = strtoupper(substr($package->short_code, 0, 3));
    $lastBooking = Booking::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
    $nextNumber = $lastBooking ? ((int)substr($lastBooking->booking_code, -4) + 1) : 1;
    $bookingCode = "{$year}-{$packageCode}-" . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    $data['booking_code'] = $bookingCode;

    // Create booking
    $booking = Booking::create($data);

    // Create events with event_code as booking_code + event number suffix
    $booking->events()->create([
        'event_code' => $bookingCode . '-E1',
        'event_type' => $data['event_1_type'],
        'event_date' => $data['event_1_date'],
        'venue_type' => $data['event_1_venue_type'] ?? null,
        'venue_address' => $data['event_1_venue_address'] ?? null,
    ]);

    if (isset($data['same_day']) && $data['same_day'] == 0 && !empty($data['event_2_type'])) {
        $booking->events()->create([
            'event_code' => $bookingCode . '-E2',
            'event_type' => $data['event_2_type'],
            'event_date' => $data['event_2_date'],
            'venue_type' => $data['event_2_venue_type'] ?? null,
            'venue_address' => $data['event_2_venue_address'] ?? null,
        ]);
    }
    // After booking creation, before redirect:
    $request->session()->forget('_old_input');
    return redirect('/');
}

}
