<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public $recapitulation_type = [
        'BBM Pemakaian',
        'BBM Stok',
        'Beban',
        'Fast Moving',
        'Gangguan',
        'HAR Realisasi',
        'HAR Rencana',
        'KWH',
        'Pelumas',
        'Utama'
    ];
    
    public function up(): void
    {
        Schema::create('recapitulation', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time', $precision = 0);
            $table->enum('status', ['Dibuat', 'Dievaluasi', 'Disetujui', 'Ditolak']);
            $table->enum('recapitulation_type', $this->recapitulation_type);
            $table->foreignId('staff_id')->constrained('staff');
            $table->foreignId('power_plant_id')->constrained('power_plant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recapitulation');
    }
};
