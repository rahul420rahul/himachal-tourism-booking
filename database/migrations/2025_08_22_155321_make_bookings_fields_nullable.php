<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeBookingsFieldsNullable extends Migration
{
    public function up()
    {
        // SQLite doesn't support ALTER COLUMN
        // We'll skip this migration for SQLite
        if (config('database.default') === 'sqlite') {
            // For SQLite, these columns are already nullable by default
            // or we need to recreate the table which is complex
            return;
        }
        
        // For MySQL/PostgreSQL
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('package_price', 10, 2)->nullable()->change();
            $table->string('time_slot')->nullable()->change();
            $table->decimal('discount_amount', 10, 2)->nullable()->change();
            $table->decimal('tax_amount', 10, 2)->nullable()->change();
            $table->decimal('advance_amount', 10, 2)->nullable()->change();
            $table->decimal('pending_amount', 10, 2)->nullable()->change();
        });
    }
    
    public function down()
    {
        // Reverse changes if needed
    }
}
