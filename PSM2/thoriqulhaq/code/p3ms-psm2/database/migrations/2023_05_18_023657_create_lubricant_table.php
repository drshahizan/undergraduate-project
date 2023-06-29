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
        Schema::create('lubricant', function (Blueprint $table) {
            $table->id();
            $table->double('first_lubricant_stock');
            $table->double('receipt_lubricant_stock');
            $table->foreignId('recapitulation_id')->constrained('recapitulation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lubricant');
    }
};
