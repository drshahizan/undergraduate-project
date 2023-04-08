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

Route::get('/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
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