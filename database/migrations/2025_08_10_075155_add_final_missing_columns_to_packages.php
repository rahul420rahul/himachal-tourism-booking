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
        Schema::table('packages', function (Blueprint $table) {
            // Check करें कि column exist नहीं करता, फिर add करें
            if (!Schema::hasColumn('packages', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
            if (!Schema::hasColumn('packages', 'short_description')) {
                $table->text('short_description')->nullable()->after('description');
            }
            if (!Schema::hasColumn('packages', 'duration')) {
                $table->string('duration')->nullable()->after('price');
            }
            if (!Schema::hasColumn('packages', 'max_people')) {
                $table->integer('max_people')->default(1)->after('duration');
            }
            if (!Schema::hasColumn('packages', 'location')) {
                $table->string('location')->nullable()->after('max_people');
            }
            if (!Schema::hasColumn('packages', 'includes')) {
                $table->text('includes')->nullable()->after('location');
            }
            if (!Schema::hasColumn('packages', 'excludes')) {
                $table->text('excludes')->nullable()->after('includes');
            }
            if (!Schema::hasColumn('packages', 'image_path')) {
                $table->string('image_path')->nullable()->after('excludes');
            }
            if (!Schema::hasColumn('packages', 'gallery_images')) {
                $table->json('gallery_images')->nullable()->after('image_path');
            }
            if (!Schema::hasColumn('packages', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('gallery_images');
            }
            if (!Schema::hasColumn('packages', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('is_featured');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $columns = ['slug', 'short_description', 'duration', 'max_people', 'location', 'includes', 'excludes', 'image_path', 'gallery_images', 'is_featured', 'status'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('packages', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
