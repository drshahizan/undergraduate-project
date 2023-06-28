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
        Schema::create('solar_panel', function (Blueprint $table) {
            $table->id();
            $table->integer('installed_power');
            $table->integer('ability');
            $table->double('load');
            $table->double('early_stand');
            $table->double('final_stand');
            $table->double('kwh_production');
            $table->string('har_activity');
            $table->string('maintenance');
            $table->foreignId('recapitulation_id')->constrained('recapitulation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solar_panel');
    }
};
