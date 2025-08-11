<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booking_number')->nullable()->change();
            $table->string('emergency_contact')->nullable()->change();
            $table->string('emergency_phone')->nullable()->change();
            $table->integer('number_of_people')->nullable()->change();
            $table->string('booking_status')->nullable()->change();
            $table->string('payment_status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('booking_number')->nullable(false)->change();
            $table->string('emergency_contact')->nullable(false)->change();
            $table->string('emergency_phone')->nullable(false)->change();
            $table->integer('number_of_people')->nullable(false)->change();
            $table->string('booking_status')->nullable(false)->change();
            $table->string('payment_status')->nullable(false)->change();
        });
    }
};
