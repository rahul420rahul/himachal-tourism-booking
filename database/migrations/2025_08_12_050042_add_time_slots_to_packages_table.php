<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->json('available_time_slots')->nullable()->after('duration');
            $table->integer('max_participants_per_slot')->default(10)->after('available_time_slots');
            $table->boolean('requires_weather_check')->default(false)->after('max_participants_per_slot');
            $table->text('safety_requirements')->nullable()->after('requires_weather_check');
            $table->decimal('advance_payment_percentage', 5, 2)->default(30.00)->after('safety_requirements');
        });

        // Create time_slot_bookings table for tracking slot availability
        Schema::create('time_slot_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->date('booking_date');
            $table->string('time_slot'); // e.g., "09:00-12:00"
            $table->integer('booked_participants')->default(0);
            $table->integer('max_participants')->default(10);
            $table->enum('status', ['available', 'full', 'cancelled'])->default('available');
            $table->json('weather_status')->nullable(); // Store weather conditions
            $table->timestamps();
            
            $table->unique(['package_id', 'booking_date', 'time_slot']);
        });

        // Update existing packages with default time slots
        DB::table('packages')->update([
            'available_time_slots' => json_encode([
                'morning' => ['09:00-12:00', '10:00-13:00'],
                'afternoon' => ['13:00-16:00', '14:00-17:00'],
                'evening' => ['16:00-19:00']
            ]),
            'requires_weather_check' => DB::raw("CASE WHEN name LIKE '%Paragliding%' THEN 1 ELSE 0 END")
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('time_slot_bookings');
        
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn([
                'available_time_slots',
                'max_participants_per_slot',
                'requires_weather_check',
                'safety_requirements',
                'advance_payment_percentage'
            ]);
        });
    }
};
