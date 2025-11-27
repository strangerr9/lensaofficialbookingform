<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique(); // e.g., 2025-PRE-0001
            $table->string('bride_name');
            $table->string('bride_phone');
            $table->string('bride_email');
            $table->string('groom_name');
            $table->string('groom_phone');
            $table->string('groom_email');
            $table->foreignId('package_id')->constrained('packages');
            $table->text('notes')->nullable();
            // $table->boolean('same_day')->default(1);
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->text('tnc')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
