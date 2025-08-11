<?php
// database/migrations/xxxx_add_missing_columns_to_packages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            // Check and add only if column doesn't exist
            if (!Schema::hasColumn('packages', 'duration')) {
                $table->integer('duration')->after('price')->comment('Duration in days');
            }
            
            if (!Schema::hasColumn('packages', 'featured')) {
                $table->boolean('featured')->default(false)->after('is_active');
            }
            
            if (!Schema::hasColumn('packages', 'image')) {
                $table->string('image')->nullable()->after('name');
            }
            
            // These might already exist, check first
            if (!Schema::hasColumn('packages', 'inclusions')) {
                $table->json('inclusions')->nullable()->after('description');
            }
            
            if (!Schema::hasColumn('packages', 'exclusions')) {
                $table->json('exclusions')->nullable()->after('inclusions');
            }
            
            if (!Schema::hasColumn('packages', 'itinerary')) {
                $table->json('itinerary')->nullable()->after('exclusions');
            }
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['duration', 'featured', 'image', 'inclusions', 'exclusions', 'itinerary']);
        });
    }
};
