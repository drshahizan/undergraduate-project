<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PLTD Material Only (id from 1 - 12)
        for ($i = 1; $i <= 12; $i++) {
            DB::table('material')->insert(
                [
                    [
                        'description' => "FUEL FILTER",
                        'quantity' => 100,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "OIL FILTER",
                        'quantity' => 0,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "WATER FILTER",
                        'quantity' => 50,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "AIR FILTER",
                        'quantity' => 0,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "ROT ELEMENT",
                        'quantity' => 0,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "RAKOR ELEMENT",
                        'quantity' => 30,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "AIR AKI ZUUR",
                        'quantity' => 0,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "AIR AKI AQUADES",
                        'quantity' => 0,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "COOLANT RADIATOR",
                        'quantity' => 150,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "V BELT RADIATOR",
                        'quantity' => 0,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "V BELT ALTERNATOR",
                        'quantity' => 0,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]
            );
        }
        
        // PLTS Material Only (id from 13 - 24)
        for ($i = 13; $i <= 24; $i++) {
            DB::table('material')->insert(
                [
                    [
                        'description' => "FUSE LINK 10A",
                        'quantity' => 100,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "FUSE LINK 15A",
                        'quantity' => 150,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "NH FUSE 125A",
                        'quantity' => 500,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'description' => "NH FUSE 250A",
                        'quantity' => 0,
                        'power_plant_id' => $i,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]
            );
        }
    }
}
