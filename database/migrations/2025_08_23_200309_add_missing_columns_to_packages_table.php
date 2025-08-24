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
            // Add missing columns that are in the seeder but not in table
            if (!Schema::hasColumn('packages', 'category')) {
                $table->string('category')->default('general');
            }
            if (!Schema::hasColumn('packages', 'location')) {
                $table->string('location')->nullable();
            }
            if (!Schema::hasColumn('packages', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable();
            }
            if (!Schema::hasColumn('packages', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable();
            }
            if (!Schema::hasColumn('packages', 'weather_dependency')) {
                $table->json('weather_dependency')->nullable();
            }
            if (!Schema::hasColumn('packages', 'requires_weather_check')) {
                $table->boolean('requires_weather_check')->default(false);
            }
            if (!Schema::hasColumn('packages', 'advance_payment_percentage')) {
                $table->decimal('advance_payment_percentage', 5, 2)->default(30.00);
            }
            if (!Schema::hasColumn('packages', 'available_time_slots')) {
                $table->json('available_time_slots')->nullable();
            }
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
