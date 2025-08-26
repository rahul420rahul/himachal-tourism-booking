<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('flight_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained();
            $table->string('flight_type');
            $table->dateTime('takeoff_time');
            $table->dateTime('landing_time');
            $table->integer('flight_duration');
            $table->string('takeoff_location');
            $table->string('landing_location');
            $table->float('max_altitude');
            $table->float('distance_covered')->nullable();
            $table->string('equipment_used')->nullable();
            $table->string('wing_model')->nullable();
            $table->text('flight_notes')->nullable();
            $table->json('weather_data')->nullable();
            $table->json('gps_track')->nullable();
            $table->string('igc_file')->nullable();
            $table->integer('rating')->nullable();
            $table->foreignId('instructor_id')->nullable()->constrained('users');
            $table->text('instructor_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flight_logs');
    }
};
