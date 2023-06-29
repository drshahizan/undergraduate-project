<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unit')->insert(
            [
                [
                    'name' => 'ULP SAMPANG',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'ULP SUMENEP',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'ULP KANGEAN',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
