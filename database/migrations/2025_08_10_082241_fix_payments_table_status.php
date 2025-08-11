<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Change status column to allow more values
            $table->enum('status', [
                'pending', 
                'completed', 
                'failed', 
                'cancelled', 
                'refunded'
            ])->change();
            
            // Add payment_date column if it doesn't exist
            if (!Schema::hasColumn('payments', 'payment_date')) {
                $table->timestamp('payment_date')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('status', ['pending', 'failed'])->change();
            $table->dropColumn('payment_date');
        });
    }
};
