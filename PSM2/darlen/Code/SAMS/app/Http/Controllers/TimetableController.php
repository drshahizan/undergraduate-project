<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\Subject;



class TimetableController extends Controller
{
    public function index(Request $request)
    {
        $classrooms = Classroom::all();

        return Inertia::render('Teacher/JadwalPelajaran', ['classrooms' => $classrooms]);
    }

    public function getTimetable(Request $request, $classId)
{
    $classrooms = Classroom::all();

    $timetable = Timetable::where('class_id', $classId)
        ->with([
            'hour1Subject', 'hour2Subject', 'hour3Subject', 'hour4Subject',
            'hour5Subject', 'hour6Subject', 'hour7Subject', 'hour8Subject'
        ])->get();

    $subjects = Subject::all();

    // Add break time
    $subjects->push((object)[
        'id' => -1, // use a special id for break time
        'subjectName' => 'Break Time'
    ]);

    return Inertia::render('Teacher/JadwalPelajaran', ['classrooms' => $classrooms, 'timetable' => $timetable, 'subjects' => $subjects]);
}

}
