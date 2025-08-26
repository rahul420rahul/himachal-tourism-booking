<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->nullable()->constrained();
            $table->foreignId('booking_id')->nullable()->constrained();
            $table->string('certificate_number')->unique();
            $table->string('certificate_type');
            $table->date('issue_date');
            $table->date('expiry_date')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('certificate_url')->nullable();
            $table->json('metadata')->nullable();
            $table->boolean('is_verified')->default(true);
            $table->string('blockchain_hash')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_certificates');
    }
};
