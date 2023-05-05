<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Login');
});

Route::get('/test', function () {
    return Inertia::render('Home');
});

Route::get('/dashboard-guru', function () {
    return Inertia::render('Teacher/TeacherDashboard');
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

Route::get('/rapor', function () {
    return Inertia::render('Teacher/TeacherRapor');
});

Route::get('/buat-rapor', function () {
    return Inertia::render('Teacher/TeacherCreateRapor');
});

Route::get('/lihat-rapor', function () {
    return Inertia::render('Teacher/TeacherViewRapor');
});

Route::get('/absensi', function () {
    return Inertia::render('Teacher/Absensi');
});

Route::get('/daftar-siswa', function () {
    return Inertia::render('Teacher/DaftarSiswa');
});

Route::get('/jadwal-pelajaran', function () {
    return Inertia::render('Teacher/JadwalPelajaran');
});

Route::get('/ubah-jadwal-pelajaran', function () {
    return Inertia::render('Teacher/UbahJadwalPelajaran');
});

Route::get('/spp', function () {
    return Inertia::render('Teacher/SPP');
});

Route::get('/penilaian', function () {
    return Inertia::render('Teacher/Penilaian');
});

Route::get('/edit-penilaian', function () {
    return Inertia::render('Teacher/EditPenilaian');
});

Route::get('/dashboard-siswa', function () {
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

Route::get('/spp-siswa', function () {
    return Inertia::render('Student/StudentSPP');
});

Route::get('/daftar-guru', function () {
    return Inertia::render('Student/DaftarGuru');
});