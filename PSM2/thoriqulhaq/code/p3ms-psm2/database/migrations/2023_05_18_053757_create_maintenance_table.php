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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->integer('unit');
            $table->string('lh_five_no');
            $table->string('description');
            $table->enum('status', ['Belum Diperbaiki', 'Dalam Perbaikan', 'Selesai']);
            $table->foreignId('recapitulation_id')->constrained('recapitulation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
