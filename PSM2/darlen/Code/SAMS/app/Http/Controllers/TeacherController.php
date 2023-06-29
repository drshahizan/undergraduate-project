<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\Subject;
use App\Models\TuitionRecord;

class TeacherController extends Controller
{

    public function getUser($type = null)
{
    $students = Student::with('user')->get()->map(function ($student) {
        $student->nis_nisn = $student->nis . '/' . $student->nisn;
        $student->classroom_id = $student->classroom_id;
        return $student;
    });

    $classrooms = Classroom::all();
    return Inertia::render('Teacher/DaftarSiswa', ['students' => $students, 'classrooms' => $classrooms]);
}

public function getUserSPP($type = null)
{
    $students = Student::with('user')->get()->map(function ($student) {
        $student->nis_nisn = $student->nis . '/' . $student->nisn;
        $student->classroom_id = $student->classroom_id;
        return $student;
    });

    $classrooms = Classroom::all();
    return Inertia::render('Teacher/SPP', ['students' => $students, 'classrooms' => $classrooms]);
}

public function getUserAbsensi($type = null)
{
    $students = Student::with('user')->get()->map(function ($student) {
        $student->nis_nisn = $student->nis . '/' . $student->nisn;
        $student->classroom_id = $student->classroom_id;
        return $student;
    });

    $classrooms = Classroom::all();
    return Inertia::render('Teacher/Absensi', ['students' => $students, 'classrooms' => $classrooms]);
}

public function getUserRapor($type = null)
{
    $students = Student::with('user')->get()->map(function ($student) {
        $student->nis_nisn = $student->nis . '/' . $student->nisn;
        $student->classroom_id = $student->classroom_id;
        return $student;
    });

    $classrooms = Classroom::all();
    return Inertia::render('Teacher/TeacherRapor', ['students' => $students, 'classrooms' => $classrooms]);
}

public function getUserEditPenilaian($type = null)
{
    $students = Student::with('user')->get()->map(function ($student) {
        $student->nis_nisn = $student->nis . '/' . $student->nisn;
        $student->classroom_id = $student->classroom_id;
        return $student;
    });

    $classrooms = Classroom::all();
    return Inertia::render('Teacher/EditPenilaian', ['students' => $students, 'classrooms' => $classrooms]);
}

public function getTuitionRecords($id)
{
    $student = Student::find($id);
    $tuitionRecordsFromDatabase = TuitionRecord::where('student_id', $id)
        ->get();

    // All possible months
    $months_string = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $months = range(1, 12);
    // Create a new collection with data for each month
    $tuitionRecords = collect($months)->map(function ($month) use ($tuitionRecordsFromDatabase, $months_string) {
        $record = $tuitionRecordsFromDatabase->firstWhere('month', $month);

        // Check if record exists for the month
        if ($record) {
            // Existing record, return all the fields
            return [
                'month' => $months_string[$record->month -1],
                'paymentDate' => $record->paymentDate,
                'paymentAmount' => $record->paymentAmount,
                'paymentProof' => $record->paymentProof,
                'tuitionStatus' => [
                    'status' => $record->tuitionStatus
                ],
            ];
        } else {
            // No record for the month, return nulls
            return [
                'month' => $months_string[$month -1],
                'paymentDate' => null,
                'paymentAmount' => null,
                'paymentProof' => null,
                'tuitionStatus' => [
                    'status' => null
                ],
            ];
        }
    });

    return Inertia::render('Teacher/ViewSPP', [
        'tuitionRecords' => $tuitionRecords,
        'studentId' => $id,
        'studentName' => $student->name,
    ]);
}


public function updateTuitionStatus(Request $request, $id)
{
    $tuitionRecord = TuitionRecord::find($id);

    if (!$tuitionRecord) {
        return response()->json(['message' => 'Tuition record not found'], 404);
    }

    $tuitionRecord->tuitionStatus_id = $request->input('tuitionStatus_id');
    $tuitionRecord->save();

    return response()->json(['message' => 'Tuition status updated successfully']);
}

}





