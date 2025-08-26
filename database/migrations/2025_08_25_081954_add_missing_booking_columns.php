<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Check and add only if columns don't exist
            if (!Schema::hasColumn('bookings', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('bookings', 'advance_amount')) {
                $table->decimal('advance_amount', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('bookings', 'pending_amount')) {
                $table->decimal('pending_amount', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('bookings', 'final_amount')) {
                $table->decimal('final_amount', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('bookings', 'participants')) {
                $table->integer('participants')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'time_slot')) {
                $table->string('time_slot')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'number_of_people')) {
                $table->integer('number_of_people')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['total_amount', 'advance_amount', 'pending_amount', 'final_amount', 'participants', 'time_slot', 'number_of_people']);
        });
    }
};
