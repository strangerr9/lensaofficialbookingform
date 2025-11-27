@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>LENSA OFFICIAL : BOOK YOUR WEDDING </h2>

        {{-- Show Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        {{-- Booking Form --}}
        <form action="{{ route('bookings.store') }}" method="POST">


            @csrf

            {{-- Bride & Groom Details --}}
            <h4>Bride & Groom Details</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Bride's Name</label>
                    <input type="text" name="bride_name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Bride's Phone</label>
                    <input type="tel" name="bride_phone" class="form-control" pattern="[0-9]+" maxlength="15"
                        oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Bride's Email</label>
                    <input type="email" name="bride_email" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Bride's Address</label>
                    <input type="text" name="bride_address" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Groom's Name</label>
                    <input type="text" name="groom_name" class="form-control" value="{{ old('groom_name') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Groom's Phone</label>
                    <input type="tel" name="groom_phone" class="form-control" value="{{ old('groom_phone') }}"
                        pattern="[0-9]+" maxlength="15" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Groom's Email</label>
                    <input type="email" name="groom_email" class="form-control" value="{{ old('groom_email') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Groom's Address</label>
                    <input type="text" name="groom_address" class="form-control" value="{{ old('groom_address') }}">
                </div>
            </div>

            <hr>

            {{-- Wedding Event Details --}}
            {{-- Step 1: Select Package --}}
            <div id="step1">
                <h4>Select Package</h4>
                <select name="package_id" id="package_id" class="form-control" required>
                    <option value="">-- Select Package --</option>
                    <option value="1">Deluxe</option>
                    <option value="Premium">Premium</option>
                    <option value="Pakej Promosi">Pakej Promosi</option>
                    <option value="Akad Nikah">Akad Nikah</option>
                    <option value="Sanding">Sanding</option>
                    <option value="Tandang">Tandang</option>
                    <option value="Outdoor">Outdoor</option>
                    <option value="Tunang">Tunang</option>
                </select>
            </div>

            {{-- Step 2: Event Details (hidden until package selected) --}}
            <div id="eventDetails" style="display:none;">
                <h4>Event 1 Details</h4>
                <label>Event Type</label>
                <input type="text" name="event_1_type" id="event1Type" class="form-control" readonly>

                <label>Wedding Date</label>
                <input type="date" name="event_1_date" class="form-control" required>

                <label>Venue Type</label>
                <input type="text" name="event_1_venue_type" class="form-control">

                <label>Venue Address</label>
                <input type="text" name="event_1_venue_address" class="form-control">

                {{-- Same Day Option (only if package has two events) --}}
                <div id="sameDayOption" style="display:none;">
                    <label>Are both events on the same day?</label>
                    <select id="sameDaySelect" name="same_day" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                {{-- Event 2 Details (only if needed) --}}
                <div id="event2Details" style="display:none;">
                    <h4>Event 2 Details</h4>
                    <label>Event Type</label>
                    <input type="text" name="event_2_type" id="event2Type" class="form-control" readonly>

                    <label>Wedding Date</label>
                    <input type="date" name="event_2_date" class="form-control">

                    <label>Venue Type</label>
                    <input type="text" name="event_2_venue_type" class="form-control">

                    <label>Venue Address</label>
                    <input type="text" name="event_2_venue_address" class="form-control">
                </div>
            </div>

            <script>
                const packageEvents = {
                    "Premium": ["Akad Nikah", "Sanding"],
                    "1": ["Akad Nikah", "Sanding"],
                    "Pakej Promosi": ["Akad Nikah", "Sanding"],
                    "Akad Nikah": ["Akad Nikah"],
                    "Sanding": ["Sanding"],
                    "Tandang": ["Tandang"],
                    "Outdoor": ["Outdoor"],
                    "Tunang": ["Tunang"]
                };

                document.getElementById('package_id').addEventListener('change', function () {
                    let selectedPackage = this.value;
                    if (!selectedPackage) {
                        document.getElementById('eventDetails').style.display = 'none';
                        return;
                    }

                    let events = packageEvents[selectedPackage];
                    document.getElementById('event1Type').value = events[0];
                    document.getElementById('eventDetails').style.display = 'block';

                    if (events.length > 1) {
                        document.getElementById('sameDayOption').style.display = 'block';
                    } else {
                        document.getElementById('sameDayOption').style.display = 'none';
                        document.getElementById('event2Details').style.display = 'none';
                    }
                });

                document.getElementById('sameDaySelect').addEventListener('change', function () {
                    if (this.value === '0') { // Not same day
                        let selectedPackage = document.getElementById('package_id').value;
                        let events = packageEvents[selectedPackage];
                        document.getElementById('event2Type').value = events[1];
                        document.getElementById('event2Details').style.display = 'block';
                    } else {
                        document.getElementById('event2Details').style.display = 'none';
                    }
                });
            </script>

            <br>
            <button type="submit" class="btn btn-primary">NEXT</button>
            <br>
        </form>
    </div>
@endsection