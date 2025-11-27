<?php

namespace App\Http\Controllers;

use App\Bookings;
use App\Packages;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create_booking(Request $request)
    {
        $booking = $request->validate([
            'bride_name' => 'required|string|max:255',
            'bride_phone' => 'required|regex:/^[0-9]+$/|max:15',
            'bride_email' => 'required|email|max:255',
            'groom_name' => 'required|string|max:255',
            'groom_phone' => 'required|regex:/^[0-9]+$/|max:15',
            'groom_email' => 'required|email|max:255',
            'package_id' => 'required|exists:packages,id',
            'notes' => 'nullable|string',
            'tnc' => 'nullable|string',

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

        // 📝 Format the T&C here after validation
        if (!empty($booking['tnc'])) {
            $booking['tnc'] = "By submitting this form, I,  {$booking['tnc']} hereby acknowledge and agree to the Terms & Conditions.";
        }

        // Generate booking code
        $year = date('Y');
        $package = Packages::findOrFail($booking['package_id']);
        $packageCode = strtoupper(substr($package->short_code, 0, 3));
        $lastBooking = Bookings::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
        $nextNumber = $lastBooking ? ((int)substr($lastBooking->booking_code, -4) + 1) : 1;
        $bookingCode = "{$year}-{$packageCode}-" . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $booking['booking_code'] = $bookingCode;


        // Create booking
        $bookingCreate = Bookings::create($booking);
        // Create events with event_code as booking_code + event number suffix
        $bookingCreate->events()->create([
            'event_code' => $bookingCode . '-E1',
            'event_type' => $booking['event_1_type'],
            'event_date' => $booking['event_1_date'],
            'venue_type' => $booking['event_1_venue_type'] ?? null,
            'venue_address' => $booking['event_1_venue_address'] ?? null,
        ]);

        // if (isset($booking['same_day']) && $booking['same_day'] == 0 && !empty($booking['event_2_type'])) {
        //     $bookingCreate->events()->create([
        //         'event_code' => $bookingCode . '-E2',
        //         'event_type' => $booking['event_2_type'],
        //         'event_date' => $booking['event_2_date'],
        //         'venue_type' => $booking['event_2_venue_type'] ?? null,
        //         'venue_address' => $booking['event_2_venue_address'] ?? null,
        //     ]);
        // }

         // Create Event 2 (if provided)
        if (!empty($booking['event_2_type'])) {
            $bookingCreate->events()->create([
                'event_code' => $bookingCode . '-E2',
                'event_type' => $booking['event_2_type'],
                'event_date' => $booking['event_2_date'],
                'venue_type' => $booking['event_2_venue_type'] ?? null,
                'venue_address' => $booking['event_2_venue_address'] ?? null,
            ]);
        }


        // // dd($request->all()); // dump everything submitted

        // // Minimal validation for testing
        // $booking = ([
        //     'bride_name' => 'Test Bride',
        //     'bride_phone' => '123456789',
        //     'bride_email' => 'bride@test.com',
        //     'groom_name' => 'Test Groom',
        //     'groom_phone' => '987654321',
        //     'groom_email' => 'groom@test.com',
        //     'package_id' => '1', // make sure this package exists in packages table
        //     'booking_code' => 'TEST-0001'
        // ]);


        // // Insert into DB
        // $created = Bookings::create($booking);

        // // Dump the inserted record
        // dd($created);

        return redirect('/')->with('success', 'Thank you! Your booking was submitted.');
    }
}
