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
        Schema::create('subject_marks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('kkm');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('academicReport_id');
            $table->unsignedBigInteger('teacher_id');

            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('academicReport_id')->references('id')->on('academic_reports');
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_marks');
    }
};
