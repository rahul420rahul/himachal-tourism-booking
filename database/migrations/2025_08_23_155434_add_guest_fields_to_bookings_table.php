<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('bookings', 'guest_name')) {
                $table->string('guest_name')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('bookings', 'guest_email')) {
                $table->string('guest_email')->nullable()->after('guest_name');
            }
            if (!Schema::hasColumn('bookings', 'guest_phone')) {
                $table->string('guest_phone')->nullable()->after('guest_email');
            }
            if (!Schema::hasColumn('bookings', 'package_price')) {
                $table->decimal('package_price', 10, 2)->nullable()->after('final_amount');
            }
            if (!Schema::hasColumn('bookings', 'pending_amount')) {
                $table->decimal('pending_amount', 10, 2)->nullable()->after('advance_amount');
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $columnsToRemove = [];
            
            if (Schema::hasColumn('bookings', 'guest_name')) {
                $columnsToRemove[] = 'guest_name';
            }
            if (Schema::hasColumn('bookings', 'guest_email')) {
                $columnsToRemove[] = 'guest_email';
            }
            if (Schema::hasColumn('bookings', 'guest_phone')) {
                $columnsToRemove[] = 'guest_phone';
            }
            if (Schema::hasColumn('bookings', 'package_price')) {
                $columnsToRemove[] = 'package_price';
            }
            if (Schema::hasColumn('bookings', 'pending_amount')) {
                $columnsToRemove[] = 'pending_amount';
            }
            
            if (!empty($columnsToRemove)) {
                $table->dropColumn($columnsToRemove);
            }
        });
    }
};
