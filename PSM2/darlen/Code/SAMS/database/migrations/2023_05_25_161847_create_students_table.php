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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('parentName')->nullable();
            $table->string('parentPhoneNum')->nullable();
            $table->string('profilePic')->nullable();
            $table->string('address')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->integer('nis')->nullable();
            $table->string('nisn')->nullable();
            $table->string('semester')->nullable();
            $table->string('academicYear')->nullable();
            $table->string('peminatan')->nullable();
            $table->unsignedBigInteger('classroom_id')->nullable();

            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('set null');
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
