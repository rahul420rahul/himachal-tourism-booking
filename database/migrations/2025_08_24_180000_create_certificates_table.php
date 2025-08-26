<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('certificates')) {
            Schema::create('certificates', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('type'); // e.g., 'pilot_license', 'training', 'achievement'
                $table->string('name');
                $table->string('certificate_number')->unique();
                $table->date('issue_date');
                $table->date('expiry_date')->nullable();
                $table->string('issuing_authority');
                $table->string('verification_code')->nullable();
                $table->text('qr_code')->nullable();
                $table->enum('status', ['active', 'expired', 'revoked'])->default('active');
                $table->json('metadata')->nullable();
                $table->timestamps();
                
                $table->index('certificate_number');
                $table->index(['user_id', 'type']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
};
