<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('user_statistics')) {
            Schema::create('user_statistics', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->integer('total_flights')->default(0);
                $table->integer('total_flight_hours')->default(0);
                $table->float('total_distance')->default(0);
                $table->float('highest_altitude')->default(0);
                $table->integer('longest_flight')->default(0);
                $table->integer('total_sites_visited')->default(0);
                $table->integer('certificates_earned')->default(0);
                $table->integer('achievements_unlocked')->default(0);
                $table->integer('total_points')->default(0);
                $table->string('pilot_level')->default('beginner');
                $table->integer('ranking')->nullable();
                $table->json('favorite_sites')->nullable();
                $table->json('monthly_stats')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('user_statistics');
    }
};
