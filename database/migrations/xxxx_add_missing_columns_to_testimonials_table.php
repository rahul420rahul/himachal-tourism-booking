<?php
// database/migrations/xxxx_add_missing_columns_to_testimonials_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'is_approved')) {
                $table->boolean('is_approved')->default(true)->after('rating');
            }
        });
    }

    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });
    }
};
