<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            if (!Schema::hasColumn('packages', 'slug')) {
                $table->string('slug')->nullable()->after('name');
            }
            if (!Schema::hasColumn('packages', 'short_description')) {
                $table->text('short_description')->nullable()->after('description');
            }
            if (!Schema::hasColumn('packages', 'discount_price')) {
                $table->decimal('discount_price', 8, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('packages', 'duration_days')) {
                $table->integer('duration_days')->nullable()->after('price');
            }
            if (!Schema::hasColumn('packages', 'max_participants')) {
                $table->integer('max_participants')->default(1)->after('duration_days');
            }
            if (!Schema::hasColumn('packages', 'inclusions')) {
                $table->json('inclusions')->nullable()->after('max_participants');
            }
            if (!Schema::hasColumn('packages', 'exclusions')) {
                $table->json('exclusions')->nullable()->after('inclusions');
            }
            if (!Schema::hasColumn('packages', 'requirements')) {
                $table->json('requirements')->nullable()->after('exclusions');
            }
            if (!Schema::hasColumn('packages', 'difficulty_level')) {
                $table->enum('difficulty_level', ['easy', 'moderate', 'difficult', 'expert'])->default('easy')->after('requirements');
            }
            if (!Schema::hasColumn('packages', 'category')) {
                $table->string('category')->default('tandem')->after('difficulty_level');
            }
            if (!Schema::hasColumn('packages', 'location')) {
                $table->string('location')->default('Bir Billing')->after('category');
            }
            if (!Schema::hasColumn('packages', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('location');
            }
            if (!Schema::hasColumn('packages', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }
            if (!Schema::hasColumn('packages', 'gallery_images')) {
                $table->json('gallery_images')->nullable()->after('longitude');
            }
            if (!Schema::hasColumn('packages', 'featured_image')) {
                $table->string('featured_image')->nullable()->after('gallery_images');
            }
            if (!Schema::hasColumn('packages', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('featured_image');
            }
            if (!Schema::hasColumn('packages', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('is_active');
            }
            if (!Schema::hasColumn('packages', 'weather_dependency')) {
                $table->boolean('weather_dependency')->default(true)->after('sort_order');
            }
            if (!Schema::hasColumn('packages', 'min_age')) {
                $table->integer('min_age')->default(12)->after('weather_dependency');
            }
            if (!Schema::hasColumn('packages', 'max_age')) {
                $table->integer('max_age')->default(65)->after('min_age');
            }
            if (!Schema::hasColumn('packages', 'weight_min')) {
                $table->integer('weight_min')->default(35)->after('max_age');
            }
            if (!Schema::hasColumn('packages', 'weight_max')) {
                $table->integer('weight_max')->default(90)->after('weight_min');
            }
            if (!Schema::hasColumn('packages', 'advance_booking_required')) {
                $table->boolean('advance_booking_required')->default(false)->after('weight_max');
            }
            if (!Schema::hasColumn('packages', 'cancellation_policy')) {
                $table->text('cancellation_policy')->nullable()->after('advance_booking_required');
            }
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $columnsToRemove = [
                'slug', 'short_description', 'discount_price', 'duration_days',
                'max_participants', 'inclusions', 'exclusions', 'requirements',
                'difficulty_level', 'category', 'location', 'latitude', 'longitude',
                'gallery_images', 'featured_image', 'is_active', 'sort_order',
                'weather_dependency', 'min_age', 'max_age', 'weight_min', 'weight_max',
                'advance_booking_required', 'cancellation_policy'
            ];

            foreach ($columnsToRemove as $column) {
                if (Schema::hasColumn('packages', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
