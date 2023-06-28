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
        Schema::create('material_expense', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignId('recapitulation_id')->constrained('recapitulation');
            $table->foreignId('material_id')->constrained('material');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_expense');
    }
};
