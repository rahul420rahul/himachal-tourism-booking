<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop existing table if it exists
        Schema::dropIfExists('certificates');
        
        // Create new table with all columns
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type')->default('user_upload');
            $table->string('name');
            $table->string('certificate_number')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('issuing_authority')->nullable();
            $table->string('verification_code')->nullable();
            $table->text('qr_code')->nullable();
            $table->string('file_path')->nullable(); // This is the missing column
            $table->enum('status', ['active', 'pending', 'expired', 'rejected'])->default('active');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
};
