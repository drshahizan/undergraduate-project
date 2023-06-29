<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubjectsTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            ['subjectName' => 'Matematika', 'subjectGroup' => 'Kelompok A (Umum)'],
            ['subjectName' => 'Biologi', 'subjectGroup' => 'Kelompok C (Peminatan)'],
            ['subjectName' => 'Kimia', 'subjectGroup' => 'Kelompok C (Peminatan)'],
            ['subjectName' => 'Fisika', 'subjectGroup' => 'Kelompok C (Peminatan)'],
            ['subjectName' => 'Ekonomi', 'subjectGroup' => 'Kelompok C (Peminatan)'],
            ['subjectName' => 'Sejarah Indonesia', 'subjectGroup' => 'Kelompok A (Umum)'],
            ['subjectName' => 'Pendidikan Pancasila dan Kewarganegaraan', 'subjectGroup' => 'Kelompok A (Umum)'],
            ['subjectName' => 'Bahasa Indonesia', 'subjectGroup' => 'Kelompok A (Umum)'],
            ['subjectName' => 'Bahasa Inggris', 'subjectGroup' => 'Kelompok A (Umum)'],
            ['subjectName' => 'Seni Budaya', 'subjectGroup' => 'Kelompok B (Umum)'],
            ['subjectName' => 'Prakarya dan Kewirausahaan', 'subjectGroup' => 'Kelompok B (Umum)'],
            ['subjectName' => 'Prakarya dan Kewirausahaan', 'subjectGroup' => 'Kelompok B (Umum)'],
        ];

        foreach ($subjects as $subject) {

            // Create the Teacher```php
            DB::table('subjects')->insert([
                'subjectName' => $subject['subjectName'],
                'subjectGroup' => $subject['subjectGroup'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
