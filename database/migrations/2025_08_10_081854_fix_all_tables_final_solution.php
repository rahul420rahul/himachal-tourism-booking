<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fix PAYMENTS table
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'payment_date')) {
                $table->datetime('payment_date')->nullable();
            }
            if (!Schema::hasColumn('payments', 'payment_method')) {
                $table->string('payment_method')->nullable();
            }
            if (!Schema::hasColumn('payments', 'transaction_id')) {
                $table->string('transaction_id')->nullable();
            }
            if (!Schema::hasColumn('payments', 'status')) {
                $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            }
            if (!Schema::hasColumn('payments', 'amount')) {
                $table->decimal('amount', 10, 2)->default(0);
            }
        });

        // Fix TESTIMONIALS table
        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'rating')) {
                $table->integer('rating')->default(5);
            }
            if (!Schema::hasColumn('testimonials', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            }
            if (!Schema::hasColumn('testimonials', 'package_id')) {
                $table->foreignId('package_id')->nullable()->constrained('packages')->onDelete('cascade');
            }
        });

        // Fix GALLERIES table
        Schema::table('galleries', function (Blueprint $table) {
            if (!Schema::hasColumn('galleries', 'title')) {
                $table->string('title');
            }
            if (!Schema::hasColumn('galleries', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('galleries', 'image_path')) {
                $table->string('image_path');
            }
        });

        // Fix PACKAGES table (ensure all columns)
        Schema::table('packages', function (Blueprint $table) {
            if (!Schema::hasColumn('packages', 'slug')) {
                $table->string('slug')->unique()->nullable();
            }
            if (!Schema::hasColumn('packages', 'short_description')) {
                $table->text('short_description')->nullable();
            }
            if (!Schema::hasColumn('packages', 'duration')) {
                $table->string('duration', 100)->nullable();
            }
            if (!Schema::hasColumn('packages', 'max_people')) {
                $table->integer('max_people')->default(1);
            }
            if (!Schema::hasColumn('packages', 'location')) {
                $table->string('location')->nullable();
            }
            if (!Schema::hasColumn('packages', 'includes')) {
                $table->text('includes')->nullable();
            }
            if (!Schema::hasColumn('packages', 'excludes')) {
                $table->text('excludes')->nullable();
            }
            if (!Schema::hasColumn('packages', 'image_path')) {
                $table->string('image_path')->nullable();
            }
            if (!Schema::hasColumn('packages', 'gallery_images')) {
                $table->json('gallery_images')->nullable();
            }
            if (!Schema::hasColumn('packages', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
            if (!Schema::hasColumn('packages', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active');
            }
        });

        // Fix USERS table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable();
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'customer'])->default('customer');
            }
        });

        // Fix BOOKINGS table (ensure all fields)
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'booking_number')) {
                $table->string('booking_number')->unique()->nullable();
            }
            if (!Schema::hasColumn('bookings', 'booking_date')) {
                $table->date('booking_date')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'participants')) {
                $table->integer('participants')->default(1);
            }
            if (!Schema::hasColumn('bookings', 'number_of_people')) {
                $table->integer('number_of_people')->default(1);
            }
            if (!Schema::hasColumn('bookings', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('bookings', 'discount_amount')) {
                $table->decimal('discount_amount', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('bookings', 'final_amount')) {
                $table->decimal('final_amount', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('bookings', 'status')) {
                $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            }
            if (!Schema::hasColumn('bookings', 'participant_details')) {
                $table->json('participant_details')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'emergency_contact')) {
                $table->json('emergency_contact')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'emergency_phone')) {
                $table->string('emergency_phone')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'medical_conditions')) {
                $table->text('medical_conditions')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'special_requests')) {
                $table->text('special_requests')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'booking_status')) {
                $table->string('booking_status')->default('active');
            }
            if (!Schema::hasColumn('bookings', 'payment_status')) {
                $table->string('payment_status')->default('pending');
            }
            if (!Schema::hasColumn('bookings', 'cancellation_reason')) {
                $table->text('cancellation_reason')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Reverse all changes if needed
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['payment_date', 'payment_method', 'transaction_id', 'status', 'amount']);
        });
        
        // Add other rollbacks as needed...
    }
};
