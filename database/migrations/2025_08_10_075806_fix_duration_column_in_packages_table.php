<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            // Change duration from smaller type to VARCHAR or TEXT
            $table->string('duration', 100)->change(); // या $table->text('duration')->change();
        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('duration', 50)->change(); // original size
        });
    }
};
