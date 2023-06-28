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
        Schema::create('fuel_usage', function (Blueprint $table) {
            $table->id();
            $table->integer('unit');
            $table->double('amount');
            $table->enum('action', ['Stok', 'Pemakaian']);
            $table->enum('type', ['Tangki Induk', 'Tangki Harian', 'Module PCC 300', 'Flow Meter']);
            $table->foreignId('fuel_id')->constrained('fuel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_usage');
    }
};
