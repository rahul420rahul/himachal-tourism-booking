<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('booking_id');
                $table->string('payment_id')->nullable();
                $table->string('order_id')->nullable();
                $table->decimal('amount', 10, 2);
                $table->string('currency', 3)->default('INR');
                $table->string('status');
                $table->string('gateway')->default('razorpay');
                $table->text('gateway_response')->nullable();
                $table->timestamps();
                
                $table->foreign('booking_id')->references('id')->on('bookings');
                $table->index('payment_id');
                $table->index('order_id');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
