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
    Schema::create('subjects', function (Blueprint $table) {
        $table->id();
        $table->timestamps();
        $table->string('subjectName');
        $table->char('subjectGroup', 50)->nullable(); 
        $table->unsignedBigInteger('class_id')->nullable(); // replace timetable_id with class_id

        $table->foreign('class_id')->references('id')->on('classrooms'); // replace timetables with classrooms
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
