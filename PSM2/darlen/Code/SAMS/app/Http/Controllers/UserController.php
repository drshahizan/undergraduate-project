<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Classroom;

class UserController extends Controller
{
    public function storeTeacher(Request $request)
    {
        $data = $request->validate([
        'username' => 'required|string|max:255',
        'password' => 'required|string|confirmed|min:8',
        'userType' => ['required', Rule::in([1, 2, 3])],
    ]);

    $data['password'] = Hash::make($request->password);

    $user = User::create($data);

    if ($request->userType === 2) {
        $teacherData = [
            'user_id' => $user->id,
        ];

        $teacher = new Teacher($teacherData);
        $teacher->user_id = $user->id; 
        $teacher->save();
    }

        return Inertia::render('Admin/TambahAkunGuru'); 
    }

    
    public function storeAdmin(Request $request)
    {
    $data = $request->validate([
        'username' => 'required|string|max:255',
        'password' => 'required|string|confirmed|min:8',
        'userType' => ['required', Rule::in([1, 2, 3])],
    ]);

    $data['password'] = Hash::make($request->password);

    $user = User::create($data);

    if ($request->userType === 1) {
        $adminData = [
            'user_id' => $user->id,
        ];

        $admin = new Admin($adminData);
        $admin->user_id = $user->id; 
        $admin->save();
    }

    return Inertia::render('Admin/TambahAkunAdmin');
    }





    public function storeStudent(Request $request)
{
    $data = $request->validate([
        'username' => 'required|string|max:255',
        'password' => 'required|string|confirmed|min:8',
        'userType' => ['required', Rule::in([1, 2, 3])],
        'selectedYear' => 'required',
        'selectedSemester' => 'required',
        'selectedPeminatan' => 'required',
        'selectedClassroom' => 'required', // Add this line
    ]);

    $data['password'] = Hash::make($request->password);

    $user = User::create($data);

    if ($request->userType === 3) {
        $studentData = [
            'user_id' => $user->id,
            'semester' => $request->selectedSemester,
            'academicYear' => $request->selectedYear,
            'peminatan' => $request->selectedPeminatan,
            'classroom_id' => $request->selectedClassroom, // Add this line
        ];

        $student = Student::create($studentData);
    }

    return Inertia::render('Admin/TambahAkunSiswa');
}


    
public function getUser($type = null)
{
    $query = User::query(); // start building the query

    if ($type === 'admin') {
        $query->where('userType', 1)->with('admin');
    } elseif ($type === 'teacher') {
        $query->where('userType', 2)->with('teacher');
    } elseif ($type === 'student') {
        $query->where('userType', 3)->with('student');
    }

    $users = $query->get(); // execute the query and get the results

     foreach ($users as $user) {
        if ($user->student) {
            $user->name = $user->student->name;
            $user->nis_nisn = $user->student->nis . '/' . $user->student->nisn;
            $user->peminatan = $user->student->peminatan;
        } elseif ($user->teacher) {
            $user->name = $user->teacher->name;
            $user->nip = $user->teacher->nip;
            $user->teacherRole = $user->teacher->teacherRole;
        } else {
            $user->name = $user->admin->name;
        }
    }

    return Inertia::render('Admin/ManajemenAkun', ['users' => $users]);
}


}
