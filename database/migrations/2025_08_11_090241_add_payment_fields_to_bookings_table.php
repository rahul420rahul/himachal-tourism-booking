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
            // Add Razorpay payment columns if they don't exist
            if (!Schema::hasColumn('bookings', 'razorpay_order_id')) {
                $table->string('razorpay_order_id')->nullable()->index()->after('id');
            }
            if (!Schema::hasColumn('bookings', 'razorpay_payment_id')) {
                $table->string('razorpay_payment_id')->nullable()->index()->after('razorpay_order_id');
            }
            if (!Schema::hasColumn('bookings', 'razorpay_signature')) {
                $table->text('razorpay_signature')->nullable()->after('razorpay_payment_id');
            }
            if (!Schema::hasColumn('bookings', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'processing', 'paid', 'failed', 'cancelled', 'refunded'])
                      ->default('pending')
                      ->index()
                      ->after('razorpay_signature');
            }
            if (!Schema::hasColumn('bookings', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('payment_status');
            }
            if (!Schema::hasColumn('bookings', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('payment_method');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $columns = [
                'razorpay_order_id', 
                'razorpay_payment_id', 
                'razorpay_signature',
                'payment_status',
                'payment_method',
                'paid_at'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('bookings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
