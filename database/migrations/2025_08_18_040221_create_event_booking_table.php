<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('event_code')->unique(); // e.g., 2025-PRE-0001-E1
            $table->foreignId('bookings_id')->constrained('bookings')->onDelete('cascade');
            $table->string('event_type'); // e.g., Akad Nikah
            $table->date('event_date');
            $table->string('venue_type'); // e.g., Hall, Outdoor
            $table->text('venue_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_booking');
    }
}
