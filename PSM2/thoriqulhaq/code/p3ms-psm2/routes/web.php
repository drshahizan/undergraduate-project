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

Route::get('/login', function () {
    return Inertia::render('Staff/Login');
});

Route::get('/', function () {
    return Inertia::render('Staff/Dashboard');
});

Route::get('/rekap/input', function () {
    return Inertia::render('Staff/InputRekap');
});

Route::get('/rekap/riwayat', function () {
    return Inertia::render('Staff/RiwayatRekap');
});

Route::get('/rekap/permintaan', function () {
    return Inertia::render('Staff/PermintaanRekap');
});

Route::get('/rekap/detail', function () {
    return Inertia::render('Staff/Rekap');
});

Route::get('/laporan/unduh', function () {
    return Inertia::render('Staff/UnduhLaporan');
});

Route::get('/info-material', function () {
    return Inertia::render('Staff/InfoMaterial');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Admin/Login');
    });

    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard');
    });
});
