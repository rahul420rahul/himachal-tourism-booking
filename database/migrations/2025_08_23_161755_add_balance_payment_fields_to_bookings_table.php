<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'razorpay_balance_order_id')) {
                $table->string('razorpay_balance_order_id')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'razorpay_balance_payment_id')) {
                $table->string('razorpay_balance_payment_id')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'razorpay_balance_signature')) {
                $table->string('razorpay_balance_signature')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'balance_paid_at')) {
                $table->timestamp('balance_paid_at')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['razorpay_balance_order_id', 'razorpay_balance_payment_id', 'razorpay_balance_signature', 'balance_paid_at']);
        });
    }
};
