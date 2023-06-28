<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecapitulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                DB::table('recapitulation')->insert(
                    [
                        'date_time' => now(),
                        'status' => $j,
                        'recapitulation_type' => $i,
                        'staff_id' => 1,
                        'power_plant_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                );
            }
        }
    }
}
