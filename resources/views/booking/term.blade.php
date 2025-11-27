@extends('layouts.app')

@section('content')
@csrf
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">
    @csrf
    <h1 class="text-2xl font-bold mb-4">Terma & Syarat LENSA OFFICIAL</h1>

    <div class="overflow-y-scroll h-96 border rounded-lg p-4 mb-6 text-sm leading-relaxed">
        <h2 class="font-semibold text-lg mb-2">TEMPAHAN & HARGA</h2>
        <p>Sebarang 'Free items' yang ditawarkan ...</p>
        <p>... (copy paste all your terms here, structured with <br> or <p>)</p>

        <h2 class="font-semibold text-lg mt-4">PEMBATALAN & TUKAR TARIKH</h2>
        <p>Sebarang deposit yang dilakukan ...</p>

        <h2 class="font-semibold text-lg mt-4">TANGGUNGJAWAB , LIABILITI & KEMALANGAN</h2>
        <p>Sekiranya berlaku sebarang kemalangan ...</p>

        <h2 class="font-semibold text-lg mt-4">PRODUK AKHIR</h2>
        <p>Hasil suntingan gambar akan dihantar ...</p>

        <h2 class="font-semibold text-lg mt-4">HAK PENERBITAN & HAK CIPTA</h2>
        <p>Pelanggan mengakui bahawa LENSA OFFICIAL ...</p>
    </div>

    <form action="{{ route('booking.confirm') }}" method="POST">
        @csrf
        <div class="flex items-center mb-4">
            <input id="agree" name="agree" type="checkbox" required
                class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-500">
            <label for="agree" class="ml-2 text-sm text-gray-700">
                Saya telah membaca dan bersetuju dengan semua Terma & Syarat
            </label>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl hover:bg-blue-700">
            Seterusnya
        </button>
    </form>
</div>
@endsection
