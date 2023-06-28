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
        Schema::create('power_plant', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('engine_quantity');
            $table->integer('feeder_quantity');
            $table->integer('estimated_usage_amount');
            $table->integer('dead_stock_amount');
            $table->enum('power_plant_type', ['PLTD', 'PLTS']);
            $table->foreignId('unit_id')->constrained('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('power_plant');
    }
};
