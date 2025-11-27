<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateBookingSystemTables extends Migration
{
 public function up(): void
    {
        // Drop old tables if exist
        Schema::dropIfExists('booking_events');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('packages');

        // Create packages table
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Premium, Deluxe
            $table->string('short_code', 10); // e.g., PRE, DLX
            $table->json('events_included'); // e.g., ["Akad Nikah", "Sanding"]
            $table->decimal('price', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create bookings table
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique(); // e.g., 2025-PRE-0001
            $table->string('bride_name');
            $table->string('bride_phone');
            $table->string('bride_address');
            $table->string('bride_email')->nullable();
            $table->string('groom_name');
            $table->string('groom_address');
            $table->string('groom_phone');
            $table->string('groom_email')->nullable();
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->boolean('same_day')->default(1);
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        // Create booking_events table
        Schema::create('booking_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_code')->unique(); // e.g., 2025-PRE-0001-E1
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('event_type'); // e.g., Akad Nikah
            $table->date('event_date');
            $table->string('venue_type'); // e.g., Hall, Outdoor
            $table->text('venue_address');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_events');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('packages');
    }
}
