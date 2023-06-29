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
        Schema::create('fast_moving', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->enum('status', ['Penerimaan', 'Pemakaian', 'Kirim']);
            $table->foreignId('material_id')->constrained('material');
            $table->foreignId('recapitulation_id')->constrained('recapitulation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fast_moving');
    }
};
