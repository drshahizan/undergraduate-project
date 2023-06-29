<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Timetable;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $subjects = Subject::all()->pluck('id')->toArray();

        // Loop over each classroom
        foreach (Classroom::all() as $classroom) {

            // Loop over each day of the week
            foreach ($days as $day) {

                // Shuffle subjects for each day to randomize the order
                shuffle($subjects);

                $timetableData = [
                    'day' => $day,
                    'class_id' => $classroom->id,
                    'hour_1_subject_id' => $subjects[0] ?? null,
                    'hour_2_subject_id' => $subjects[1] ?? null,
                    'hour_3_subject_id' => $subjects[2] ?? null,
                    'hour_4_subject_id' => $subjects[3] ?? null,
                    'hour_5_subject_id' => $subjects[4] ?? null,
                    'hour_6_subject_id' => $subjects[5] ?? null,
                    'hour_7_subject_id' => $subjects[6] ?? null,
                    'hour_8_subject_id' => $subjects[7] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                Timetable::create($timetableData);
            }
        }
    }
}
