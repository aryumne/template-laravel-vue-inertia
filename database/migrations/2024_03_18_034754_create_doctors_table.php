<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('doctor_name');
            $table->string('doctor_phone');
            $table->string('doctor_email')->unique();
            $table->string('doctor_profile_pict')->nullable();
            $table->string('doctor_address')->nullable();
            $table->foreignUuid('specialist_id')->nullable()->constrained('specialists');
            $table->string('doctor_specialist_name')->nullable();
            $table->string('sip');
            $table->string('id_ihs')->nullable();
            $table->string('nik')->nullable()->unique();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
