<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            // Check if slug column doesn't exist before adding
            if (!Schema::hasColumn('packages', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            // Check if slug column exists before dropping
            if (Schema::hasColumn('packages', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};
