<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\TuitionRecordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Login');
    });

    Route::post('/login', [AuthController::class, 'store']);

});


Route::middleware('auth')->group(function () {

Route::post('/logout', [AuthController::class, 'destroy']);


Route::get('/test', function () {
    return Inertia::render('Home');
});



});


Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/users/{type}', [UserController::class, 'getUser']);
    Route::post('/teacher-create', [UserController::class, 'storeTeacher']);
    Route::post('/admin-create', [UserController::class, 'storeAdmin']);
    Route::post('/student-create', [UserController::class, 'storeStudent']);


    Route::get('/beranda-admin', function () {
        return Inertia::render('Admin/AdminDashboard');
    });
    
    Route::get('/manajemen-akun', function () {
    return Inertia::render('Admin/ManajemenAkun');
    });

    Route::get('/tambah-akun-admin', function () {
        return Inertia::render('Admin/TambahAkunAdmin');
    });

    Route::get('/tambah-akun-guru', function () {
        return Inertia::render('Admin/TambahAkunGuru');
    });

    Route::get('/tambah-akun-siswa', function () {
        return Inertia::render('Admin/TambahAkunSiswa');
    });

});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/beranda-guru', function () {
        return Inertia::render('Teacher/TeacherDashboard');
    });
    
    Route::get('/rapor', [TeacherController::class, 'getUserRapor']);

    Route::get('/buat-rapor', function () {
        return Inertia::render('Teacher/TeacherCreateRapor');
    });

    Route::get('/lihat-rapor', function () {
        return Inertia::render('Teacher/TeacherViewRapor');
    });

    Route::get('/absensi', [TeacherController::class, 'getUserAbsensi']);

    Route::get('/daftar-siswa', [TeacherController::class, 'getUser']);


Route::get('/jadwal-pelajaran', [TimetableController::class, 'index']);
Route::get('/jadwal-pelajaran/{classId}', [TimetableController::class, 'getTimetable']);


    Route::get('/ubah-jadwal-pelajaran', function () {
        return Inertia::render('Teacher/UbahJadwalPelajaran');
    });

    Route::get('/spp', [TeacherController::class, 'getUserSPP']);

    Route::get('/detail-spp/{id}', [TeacherController::class, 'getTuitionRecords']);
    Route::post('/detail-spp/{id}/status', [TeacherController::class, 'updateTuitionStatus']);


    Route::get('/penilaian', function () {
        return Inertia::render('Teacher/Penilaian');
    });

    Route::get('/ubah-penilaian', [TeacherController::class, 'getUserEditPenilaian']);

    Route::get('/profil-guru', function () {
        return Inertia::render('Teacher/TeacherProfile');
    });

});

Route::middleware(['auth', 'student'])->group(function () {

    // Route::get('/teacher-list', [StudentController::class, 'getUser'])->name('teacher-list');
    Route::get('/daftar-guru', [StudentController::class, 'getUser']);


    Route::get('/beranda-siswa', function () {
        return Inertia::render('Student/StudentDashboard');
    });
    
    Route::get('/absensi-siswa', function () {
    return Inertia::render('Student/StudentAbsensi');
    });

    Route::get('/jadwal-pelajaran-siswa', function () {
        return Inertia::render('Student/StudentJadwalPelajaran');
    });

    Route::get('/rapor-siswa', function () {
        return Inertia::render('Student/StudentRapor');
    });

    Route::get('/spp-siswa', [StudentController::class, 'getTuitionRecords']);

    Route::post('/spp-siswa/{id}', [StudentController::class, 'saveTuitionRecord']);



    Route::get('/profil-siswa', [StudentController::class, 'getProfile']);

    Route::post('/update-profil-siswa', [StudentController::class, 'updateProfile']);
});
