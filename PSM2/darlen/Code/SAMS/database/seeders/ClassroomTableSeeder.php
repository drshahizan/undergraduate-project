<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = [
            ['grade' => 'X MIPA', 'totalStudent' => null],
            ['grade' => 'X IPS', 'totalStudent' => null],
            ['grade' => 'XI MIPA', 'totalStudent' => null],
            ['grade' => 'XI IPS', 'totalStudent' => null],
            ['grade' => 'XII MIPA', 'totalStudent' => null],
            ['grade' => 'XII IPS', 'totalStudent' => null],
        ];

        foreach ($classrooms as $classroom) {
            DB::table('classrooms')->insert([
                'grade' => $classroom['grade'],
                'totalStudent' => $classroom['totalStudent'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
