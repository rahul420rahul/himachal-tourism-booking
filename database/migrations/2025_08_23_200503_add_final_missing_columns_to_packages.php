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
        Schema::table('packages', function (Blueprint $table) {
            // Add missing columns for seeder
            $table->string('category')->default('general');
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->json('weather_dependency')->nullable();
            $table->boolean('requires_weather_check')->default(false);
            $table->decimal('advance_payment_percentage', 5, 2)->default(30.00);
            $table->json('available_time_slots')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'location',
                'latitude', 
                'longitude',
                'weather_dependency',
                'requires_weather_check',
                'advance_payment_percentage',
                'available_time_slots'
            ]);
        });
    }
};
