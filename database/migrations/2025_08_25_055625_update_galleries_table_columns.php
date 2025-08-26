<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            // Check and add missing columns
            if (!Schema::hasColumn('galleries', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('galleries', 'flight_log_id')) {
                $table->unsignedBigInteger('flight_log_id')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('galleries', 'category')) {
                $table->string('category')->default('other')->after('type');
            }
            if (!Schema::hasColumn('galleries', 'is_public')) {
                $table->boolean('is_public')->default(false)->after('category');
            }
        });
    }

    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            // Drop columns if they exist
            $columnsToRemove = ['description', 'flight_log_id', 'category', 'is_public'];
            foreach($columnsToRemove as $column) {
                if (Schema::hasColumn('galleries', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
