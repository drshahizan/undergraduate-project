<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Timetable Migration
public function up(): void
{
    Schema::create('timetables', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->char('day', 10)->nullable(); 
        $table->unsignedBigInteger('class_id')->nullable();
        // Add a subject_id field for each hour
        $table->unsignedBigInteger('hour_1_subject_id')->nullable();
        $table->unsignedBigInteger('hour_2_subject_id')->nullable();
        $table->unsignedBigInteger('hour_3_subject_id')->nullable();
        $table->unsignedBigInteger('hour_4_subject_id')->nullable();
        $table->unsignedBigInteger('hour_5_subject_id')->nullable();
        $table->unsignedBigInteger('hour_6_subject_id')->nullable();
        $table->unsignedBigInteger('hour_7_subject_id')->nullable();
        $table->unsignedBigInteger('hour_8_subject_id')->nullable();
        // ... repeat for each hour
        
        $table->foreign('class_id')->references('id')->on('classrooms');
        // Add a foreign key constraint for each subject_id field
        $table->foreign('hour_1_subject_id')->references('id')->on('subjects');
        $table->foreign('hour_2_subject_id')->references('id')->on('subjects');
        $table->foreign('hour_3_subject_id')->references('id')->on('subjects');
        $table->foreign('hour_4_subject_id')->references('id')->on('subjects');
        $table->foreign('hour_5_subject_id')->references('id')->on('subjects');
        $table->foreign('hour_6_subject_id')->references('id')->on('subjects');
        $table->foreign('hour_7_subject_id')->references('id')->on('subjects');
        $table->foreign('hour_8_subject_id')->references('id')->on('subjects');
        // ... repeat for each hour
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
