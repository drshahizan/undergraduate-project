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
        Schema::create('tuition_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('month')->nullable();
            $table->date('paymentDate')->nullable();
            $table->string('semester')->nullable();
            $table->string('paymentProof')->nullable();
            $table->bigInteger('paymentAmount')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('tuitionStatus_id')->nullable();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('tuitionStatus_id')->references('id')->on('tuition_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuition_records');
    }
};
