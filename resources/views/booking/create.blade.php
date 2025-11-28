@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>LENSA OFFICIAL : BOOK YOUR WEDDING </h2>
        <hr>

        @if(session('success'))
            @csrf
            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @else

            <form action="/create-booking" method="POST">
                @csrf

                {{-- Bride & Groom Details --}}
                <h4>Bride Details</h4>
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

                </div>
                <hr>
                <h4>Groom Details</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Groom's Name</label>
                        <input type="text" name="groom_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Groom's Phone</label>
                        <input type="tel" name="groom_phone" class="form-control" pattern="[0-9]+" maxlength="15"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Groom's Email</label>
                        <input type="email" name="groom_email" class="form-control" required>
                    </div>
                </div>

                <hr>
                <div class="col-md-12 mb-5">
                    <label for="message" class="form-label">Additional Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="4"
                        placeholder="Type your message here..."></textarea>
                </div>

                <hr>
                {{-- Wedding Event Details --}}
                {{-- Step 1: Select Package --}}
                <div id="step1">
                    <h4>Select Package</h4>
                    <select name="package_id" id="package_id" class="form-control" required>
                        <option value="">-- Select Package --</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                        @endforeach

                    </select>
                </div>
                <br>
                {{-- Step 2: Event Details (hidden until package selected) --}}
                <div id="eventDetails" style="display:none;">
                    <h4>Event 1 Details</h4>
                    <label>Event Type</label>
                    <input type="text" name="event_1_type" id="event1Type" class="form-control" readonly>
                    <label>Wedding Date</label>
                    <input type="date" name="event_1_date" class="form-control" required>
                    <label>Venue Type</label>
                    <select name="event_1_venue_type" class="form-control">
                        <option value="">-- Select Venue --</option>
                        <option value="Hall">Hall</option>
                        <option value="House">House</option>
                    </select>
                    <label>Venue Address</label>
                    <input type="text" name="event_1_venue_address" class="form-control">
                    {{-- Same Day Option (only if package has two events)
                    <div id="sameDayOption" style="display:none;">
                        <label>Are both events on the same day?</label>
                        <select id="sameDaySelect" name="same_day" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div> --}}

                    <br>

                    {{-- Event 2 Details (only if needed) --}}
                    <div id="event2Details" style="display:none;" style="margin-top: 10;">
                        <h4>Event 2 Details</h4>
                        <label>Event Type</label>
                        <input type="text" name="event_2_type" id="event2Type" class="form-control" readonly>
                        <label>Wedding Date</label>
                        <input type="date" name="event_2_date" class="form-control">
                        <label>Venue Type</label>
                        <select name="event_2_venue_type" class="form-control">
                            <option value="">-- Select Venue --</option>
                            <option value="Hall">Hall</option>
                            <option value="House">House</option>
                        </select>
                        <label>Venue Address</label>
                        <input type="text" name="event_2_venue_address" class="form-control">
                    </div>
                </div>

                <br>
                <!-- Button trigger -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal">
                    TERM & CONDITION
                </button>

                <!-- Modal -->
                <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 shadow-lg">

                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="bookingModalLabel">Booking Confirmation</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <!-- Scrollable Terms Section -->
                            <div class="modal-body">
                                <div class="border rounded p-3 mb-3" style="height:400px; overflow-y:auto;">
                                    <h6 class="fw-bold">Terms & Conditions - Lensa Official</h6>
                                    <p>
                                        <strong>TEMPAHAN & HARGA</strong> <br>
                                        Sebarang 'Free items' yang ditawarkan di dalam pakej atau oleh pihak LENSA OFFICIAL
                                        tidak boleh ditukar kepada bentuk wang tunai atau digunakan sebagai diskaun jika
                                        pelanggan tidak berminat dengan item tersebut.
                                        Pelanggan juga tidak boleh membangkitkan isu sekiranya sebarang free item yang
                                        ditawarkan lambat untuk diproses.
                                        Sekiranya semasa sesi 'Free Outdoor' dijalankan ketika waktu hujan, pihak LENSA OFFICIAL
                                        akan mengadakan sesi tersebut secara indoor @ sebarang persetujuan tempat antara
                                        pelanggan dan photographer. 'Free Outdoor' tidak boleh ditukar kepada tarikh lain
                                        kecuali pihak pelanggan bersetuju untuk membayar bayaran tambahan.
                                        Jarak maksimum untuk sesi 'Free Outdoor' dari lokasi majlis ke lokasi outdoor adalah 20
                                        KM atau bersamaan dengan 30 minit perjalanan. Sekiranya lebih daripada jarak tersebut
                                        caj tambahan akan dikenakan berdasarkan persetujuan pelanggan dan photographer LENSA
                                        OFFICIAL.
                                        <br>
                                        <strong>PEMBATALAN & TUKAR TARIKH</strong> <br>
                                        Sebarang deposit yang dilakukan tidak akan dipulangkan.
                                        Deposit RM200 untuk tempahan tarikh.
                                        Sekiranya ada sebarang pertukaran tarikh majlis, pihak pelanggan hendaklah memaklumkan
                                        kepada pihak LENSA OFFICIAL secepat mungkin.Pembatalan disebabkan oleh tiada
                                        photographer yang tersedia pada tarikh tersebut, pihak LENSA OFFICIAL akan mengembalikan
                                        deposit sebanyak 50%.
                                        TANGGUNGJAWAB , LIABILITI & KEMALANGAN
                                        Sekiranya berlaku sebarang kemalangan, kecederaan, kecemasan atau sebarang musibah,
                                        terhadap photographer LENSA OFFICIAL. Pihak kami akan cuba sedaya upaya untuk mencari
                                        pengganti dan sekiranya tiada, pihak kami akan mengembalikan deposit kepada pihak
                                        pelanggan.
                                        LENSA OFFICIAL tidak bertanggungjawab sekiranya photographer gagal menangkap gambar
                                        semasa majlis jika pelanggan tidak memberikan maklumat mengenai siapa yang mesti
                                        disertakan dalam penggambaran.
                                        LENSA OFFICIAL tidak bertanggungjawab ke atas sebarang kelewatan photographer disebabkan
                                        alamat yang tidak lengkap , alamat yang salah , maklumat yang salah, atau perubahan saat
                                        akhir yang menyebabkan photographer tidak dapat mencari lokasi majlis.
                                        Jika berlaku sesuatu di luar kawalan LENSA OFFICIAL (seperti kehilangan kad memori,
                                        kecurian, kerosakan kamera, kegagalan sistem penyimpanan dan sandaran), LENSA OFFICIAL
                                        akan memulangkan pembayaran yang telah dibuat oleh pelanggan. Walau bagaimanapun, LENSA
                                        OFFICIAL tidak akan bertanggungjawab ke atas foto yang telah diberikan kepada pelanggan
                                        semasa pengambilan produk. LENSA OFFICIAL akan menyimpan foto 'RAW' pelanggan selama 14
                                        hari dari tarikh pengambilan produk oleh pelanggan.

                                        <br><strong>PRODUK AKHIR</strong> <br>
                                        Hasil suntingan gambar akan dihantar dalam tempoh paling awal 1 minggu hingga ke 5
                                        minggu. Walau bagaimanapun, tempoh penghantaran ini bergantung kepada jumlah tempahan
                                        yang diterima oleh LENSA OFFICIAL. Sekiranya pihak LENSA OFFICIAL terlibat dengan proses
                                        pengambaran yang banyak dalam satu tempoh , kemungkinan besar tempoh penghantaran akan
                                        melebihi 5 minggu. Kami akan memaklumkan kepada pelanggan sekiranya terdapat sebarang
                                        kelewatan yang dijangka.
                                        Gambar suntingan penuh akan diberikan melalui link Google Photo dan tempoh sah link
                                        tersebut hanyalah selama 6 bulan selepas dari semua gambar berjaya disiapkan. Pelanggan
                                        disarankan untuk membuat backup sendiri.
                                        Tempoh untuk siap Album @ Photobook minimum 2 bulan dan paling lambat adalah 6 bulan.
                                        Color tones, konsep dan jenis photography adalah seperti portfolio LENSA OFFICIAL.
                                        Sekiranya pelanggan mempunyai permintaan konsep dan color tones tersendiri boleh
                                        berbincang dengan pihak LENSA OFFICIAL. Disarankan sebelum dari tarikh majlis dan proses
                                        editing.
                                        HAK PENERBITAN & HAK CIPTA
                                        Pelanggan mengakui bahawa LENSA OFFICIAL adalah pengarang gambar dan pemilik tunggal
                                        semua hak cipta yang kekal sebagai harta eksklusif.
                                        Pelanggan dengan ini membenarkan LENSA OFFICIAL untuk memaparkan sebarang gambar dari
                                        majlis mereka sebagai portfolio LENSA OFFICIAL dan mempromosikan perniagaan dalam iklan,
                                        laman web, media sosial, dan lain-lain.

                                    </p>
                                </div>

                                <label label class="form-label">By submitting this form me </label>
                                <input type="text" name="tnc" placeholder="Enter your name" required>
                                <label class="form-label">hereby and acknowledge with the Termn & Condition </label>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-pill"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>

                <br>
            </form>

        @endif


    </div>
    {{--
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const packageEvents = {
                "1": ["Akad Nikah", "Sanding"],
                "2": ["Akad Nikah", "Sanding"],
                "3": ["Akad Nikah"],
                "4": ["Sanding/Bertandang"],
                "5": ["Outdoor"],
            };

            const packageSelect = document.getElementById('package_id');
            const sameDaySelect = document.getElementById('sameDaySelect');

            packageSelect.addEventListener('change', function () {
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

            sameDaySelect.addEventListener('change', function () {
                if (this.value === '0') {
                    let selectedPackage = packageSelect.value;
                    let events = packageEvents[selectedPackage];
                    document.getElementById('event2Type').value = events[1];
                    document.getElementById('event2Details').style.display = 'block';
                } else {
                    document.getElementById('event2Details').style.display = 'none';
                }
            });
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const packageEvents = {
                "1": ["Akad Nikah", "Sanding"],
                "2": ["Akad Nikah", "Sanding"],
                "3": ["Akad Nikah"],
                "4": ["Sanding/Bertandang"],
                "5": ["Outdoor"],
            };

            const packageSelect = document.getElementById('package_id');

            packageSelect.addEventListener('change', function () {
                let selectedPackage = this.value;
                if (!selectedPackage) {
                    document.getElementById('eventDetails').style.display = 'none';
                    return;
                }

                let events = packageEvents[selectedPackage];
                document.getElementById('event1Type').value = events[0];
                document.getElementById('eventDetails').style.display = 'block';

                if (events.length > 1) {
                    document.getElementById('event2Type').value = events[1];
                    document.getElementById('event2Details').style.display = 'block';
                } else {
                    document.getElementById('event2Details').style.display = 'none';
                }
            });
        });
    </script>

@endsection