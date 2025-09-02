<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->boolean('balance_confirmed')->default(false)->after('payment_status');
            $table->timestamp('balance_confirmed_at')->nullable()->after('balance_confirmed');
            $table->unsignedBigInteger('confirmed_by')->nullable()->after('balance_confirmed_at');
            $table->string('confirmation_notes')->nullable()->after('confirmed_by');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['balance_confirmed', 'balance_confirmed_at', 'confirmed_by', 'confirmation_notes']);
        });
    }
};
