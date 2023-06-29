<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Timetable;
use App\Models\Subject;
use App\Models\TuitionRecord;
use App\Models\TuitionStatus;

class StudentController extends Controller
{

public function getUser($type = null)
{
    $teachers = Teacher::with('user')->get();

    return Inertia::render('Student/DaftarGuru', ['teachers' => $teachers]);
}

public function updateProfile(Request $request)
{
    $request->validate([
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        'name' => ['nullable', 'string', 'max:255'],
        'parentName' => ['nullable', 'string', 'max:255'],
        'parentPhoneNum' => ['nullable', 'string', 'max:255'],
        'address' => ['nullable', 'string', 'max:255'],
        'dob' => ['nullable', 'date'],
        'gender' => ['nullable', 'string', 'max:255'],
        'nis' => ['nullable', 'integer'],
        'nisn' => ['nullable', 'string', 'max:255'],
        'peminatan' => ['nullable', 'string', 'max:255'],
    ]);

    $user = auth()->user();
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
        $user->save();
    }

    $student = $user->student;
    if ($request->filled('name') || $request->filled('parentName') || $request->filled('parentPhoneNum') || $request->filled('address') || $request->filled('dob') || $request->filled('gender') || $request->filled('nis') || $request->filled('nisn')
    || $request->filled('nisn') || $request->filled('peminatan')) {
        $student->update($request->all());
    }

    return Inertia::render('Student/StudentProfile');
}

public function getProfile(Request $request)
{
    $user = auth()->user();
    $student = $user->student;

    return Inertia::render('Student/StudentProfile', [
        'student' => $student,
        'user' => $user
    ]);
}

public function getTuitionRecords()
{
   $user = auth()->user(); // Get the authenticated user
    $student = $user->student; // Get the student associated with the user
    $id = $student->id; // Get the student's ID

    $tuitionRecordsFromDatabase = TuitionRecord::where('student_id', $id)
        ->get();

    // All possible months
    $months_string = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $months = range(1, 12);
    // Create a new collection with data for each month
    $tuitionRecords = collect($months)->map(function ($month) use ($tuitionRecordsFromDatabase, $months_string) {
        
        $record = $tuitionRecordsFromDatabase->firstWhere('month', (int) $month);


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

    return Inertia::render('Student/StudentSPP', [
        'tuitionRecords' => $tuitionRecords,
        'studentId' => $id,
    ]);
}


public function saveTuitionRecord(Request $request)
{
    $studentId = Auth::id();

    // Find the tuition record for the current month and the authenticated student
    $currentMonth = date('n');
    $tuitionRecord = TuitionRecord::where('student_id', $studentId)
        ->where('month', $currentMonth)
        ->first();

    // If no record exists for the current month, create a new one
    if (!$tuitionRecord) {
        $tuitionRecord = new TuitionRecord;
        $tuitionRecord->student_id = $studentId;
        $tuitionRecord->month = $currentMonth;
    }

    if ($request->hasFile('paymentProof')) {
        $file = $request->file('paymentProof');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $tuitionRecord->paymentProof = $filename;
    }

    $tuitionRecord->paymentDate = $request->input('paymentDate');
    $tuitionRecord->paymentAmount = $request->input('paymentAmount');

    // Find the ID of the "Unpaid" status
    $unpaidStatus = TuitionStatus::where('status', 'Unpaid')->first();
    if ($unpaidStatus) {
        $tuitionRecord->tuitionStatus_id = $unpaidStatus->id;
    } else {
        // If "Unpaid" status does not exist, create it
        $unpaidStatus = new TuitionStatus;
        $unpaidStatus->status = 'Unpaid';
        $unpaidStatus->save();
        $tuitionRecord->tuitionStatus_id = $unpaidStatus->id;
    }

    $tuitionRecord->save();

    return response()->json(['message' => 'Tuition record saved successfully']);
}




}
