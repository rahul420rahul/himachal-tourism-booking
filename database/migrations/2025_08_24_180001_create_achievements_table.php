<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('achievements')) {
            Schema::create('achievements', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->text('description');
                $table->string('icon')->nullable();
                $table->integer('points')->default(0);
                $table->string('category'); // e.g., 'flight_hours', 'locations', 'skills'
                $table->json('criteria')->nullable();
                $table->string('reward_type')->nullable();
                $table->string('reward_value')->nullable();
                $table->boolean('is_active')->default(true);
                $table->integer('order')->default(0);
                $table->timestamps();
                
                $table->index('slug');
                $table->index('category');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('achievements');
    }
};
