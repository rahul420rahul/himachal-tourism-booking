<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('galleries', function (Blueprint $table) {
            if (!Schema::hasColumn('galleries', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('galleries', 'flight_log_id')) {
                $table->foreignId('flight_log_id')->nullable()->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('galleries', 'category')) {
                $table->enum('category', ['flight', 'equipment', 'scenery', 'team', 'other'])->default('other');
            }
            if (!Schema::hasColumn('galleries', 'is_public')) {
                $table->boolean('is_public')->default(false);
            }
        });
    }

    public function down()
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['description', 'flight_log_id', 'category', 'is_public']);
        });
    }
};
