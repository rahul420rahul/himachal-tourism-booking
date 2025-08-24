<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // For SQLite - recreate table with proper structure
        if (config('database.default') === 'sqlite') {
            
            // Backup existing data
            $existingBookings = DB::table('bookings')->get()->toArray();
            
            // Drop the table
            Schema::drop('bookings');
            
            // Recreate with proper structure
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->string('booking_number');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('package_id');
                $table->string('guest_name')->nullable();
                $table->string('guest_email')->nullable();
                $table->string('guest_phone')->nullable();
                $table->date('booking_date');
                $table->string('time_slot')->default('10:00');
                $table->integer('participants')->default(1);
                $table->decimal('package_price', 10, 2)->default(0);
                $table->decimal('discount_amount', 10, 2)->default(0);
                $table->decimal('tax_amount', 10, 2)->default(0);
                $table->decimal('final_amount', 10, 2);
                $table->decimal('advance_amount', 10, 2)->default(0);
                $table->decimal('pending_amount', 10, 2)->default(0);
                $table->string('status')->default('pending');
                $table->string('payment_status')->default('pending');
                $table->text('special_requests')->nullable();
                $table->text('cancellation_reason')->nullable();
                $table->timestamp('cancelled_at')->nullable();
                $table->text('participant_details')->nullable();
                $table->text('meta_data')->nullable();
                $table->string('razorpay_order_id')->nullable();
                $table->timestamps();
            });
            
            // Restore data if exists
            if (!empty($existingBookings)) {
                foreach ($existingBookings as $booking) {
                    DB::table('bookings')->insert((array)$booking);
                }
            }
        }
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
