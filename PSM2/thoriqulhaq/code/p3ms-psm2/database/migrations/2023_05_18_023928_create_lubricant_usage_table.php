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
        Schema::create('lubricant_usage', function (Blueprint $table) {
            $table->id();
            $table->integer('unit');
            $table->double('amount');
            $table->foreignId('lubricant_id')->constrained('lubricant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lubricant_usage');
    }
};
