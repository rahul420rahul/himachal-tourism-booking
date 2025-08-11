<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fix packages table
        Schema::table('packages', function (Blueprint $table) {
            if (!Schema::hasColumn('packages', 'duration')) {
                $table->string('duration', 100)->nullable();
            } else {
                $table->string('duration', 100)->change();
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
            
            if (!Schema::hasColumn('packages', 'slug')) {
                $table->string('slug')->unique()->nullable();
            }
            
            if (!Schema::hasColumn('packages', 'short_description')) {
                $table->text('short_description')->nullable();
            }
        });

        // Fix bookings table
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'number_of_people')) {
                $table->integer('number_of_people')->default(1);
            }
            
            if (!Schema::hasColumn('bookings', 'booking_number')) {
                $table->string('booking_number')->unique()->nullable();
            }
            
            if (!Schema::hasColumn('bookings', 'booking_date')) {
                $table->date('booking_date')->nullable();
            }
            
            if (!Schema::hasColumn('bookings', 'total_amount')) {
                $table->decimal('total_amount', 10, 2)->nullable();
            }
            
            if (!Schema::hasColumn('bookings', 'status')) {
                $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            }
            
            if (!Schema::hasColumn('bookings', 'special_requests')) {
                $table->text('special_requests')->nullable();
            }
        });

        // Fix users table
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

        // Fix testimonials table
        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'rating')) {
                $table->integer('rating')->default(5);
            }
            
            if (!Schema::hasColumn('testimonials', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            }
        });

        // Fix payments table
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'payment_method')) {
                $table->string('payment_method')->nullable();
            }
            
            if (!Schema::hasColumn('payments', 'transaction_id')) {
                $table->string('transaction_id')->nullable();
            }
            
            if (!Schema::hasColumn('payments', 'status')) {
                $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            }
        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn([
                'duration', 'max_people', 'location', 'includes', 'excludes', 
                'image_path', 'gallery_images', 'is_featured', 'status', 
                'slug', 'short_description'
            ]);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'number_of_people', 'booking_number', 'booking_date', 
                'total_amount', 'status', 'special_requests'
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'role']);
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['rating', 'status']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'transaction_id', 'status']);
        });
    }
};
