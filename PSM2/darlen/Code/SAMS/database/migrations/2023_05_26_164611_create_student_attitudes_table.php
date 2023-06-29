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
        Schema::create('student_attitudes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('spiritualAttitudeDescription');
            $table->char('spiritualAttitudePredicate', 50);
            $table->text('socialAttitudeDescription');
            $table->char('socialAttitudePredicate', 50); 
            $table->unsignedBigInteger('academicReport_id');

            $table->foreign('academicReport_id')->references('id')->on('academic_reports');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attitudes');
    }
};
