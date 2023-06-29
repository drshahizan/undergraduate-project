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
        Schema::create('student_activities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('typeOfActivity')->nullable();
            $table->text('description')->nullable();
            $table->char('mark', 50)->nullable(); 
            $table->unsignedBigInteger('academicReport_id');

            $table->foreign('academicReport_id')->references('id')->on('academic_reports');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_activities');
    }
};
