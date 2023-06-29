<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        UserSeeder::class,
        ClassroomTableSeeder::class,
        StudentsTableSeeder::class,
        SubjectsTableSeeder::class,
        TeacherTableSeeder::class,
        TimetableSeeder::class,
    ]);
    }
}
