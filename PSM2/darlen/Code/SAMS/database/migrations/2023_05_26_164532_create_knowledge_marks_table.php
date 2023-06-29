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
        Schema::create('knowledge_marks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('knowledgeMark');
            $table->char('knowledgePredicate', 50); 
            $table->text('knowledgeDescription')->nullable();
            $table->unsignedBigInteger('subjectMark_id');

            $table->foreign('subjectMark_id')->references('id')->on('subject_marks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge_marks');
    }
};
