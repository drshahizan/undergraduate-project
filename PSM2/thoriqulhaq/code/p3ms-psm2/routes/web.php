<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\RecapitulationController;
use App\Http\Controllers\ReportController;
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
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Staff/Login');
    })->name('login.staff.get');
    
    Route::prefix('admin')->group(function () {
        Route::get('/login', function () {
            return Inertia::render('Admin/Login');
        })->name('login.admin.get');
    });
    
    Route::post('/login', [AuthenticationController::class, 'store'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'destroy'])->name('logout');
    
    Route::middleware('can:staff-access')->group(function () {
        Route::get('/', [Controller::class, 'StaffDashboard'])->name('staff.dashboard');
        
        Route::get('/rekap/edit/{id}', [RecapitulationController::class, 'editRecap'])->name('recap.edit');
        
        Route::post('/rekap/update/{id}', [RecapitulationController::class, 'updateRecap'])->name('recap.update');
        
        Route::get('/laporan/unduh', [ReportController::class, 'viewReport'])->name('report.view');
        
        Route::post('/laporan/unduh', [ReportController::class, 'generateReport'])->name('report.generate');
        
        Route::get('/laporan/unduh/simpan', [ReportController::class, 'downloadReport'])->name('report.download');
        
        Route::get('/info-material', [RecapitulationController::class, 'materialInfo'])->name('material.info');
    });
    
    Route::middleware('can:staff-pic-access')->group(function () {
        Route::get('/rekap/evaluasi/{id}', [RecapitulationController::class, 'evaluateRecap'])->name('recap.evaluate');
        
        Route::post('/rekap/evaluasi/simpan', [RecapitulationController::class, 'saveEvaluation'])->name('recap.evaluate.save');
        
        Route::get('/rekap/permintaan',  [RecapitulationController::class, 'recapRequest'])->name('recap.request');
    });
    
    Route::middleware('can:staff-operator-access')->group(function () {
        Route::get('/rekap/input/{type}', [RecapitulationController::class, 'inputRecap'])->name('recap.input');
        
        Route::post('/rekap/create', [RecapitulationController::class, 'createRecap'])->name('recap.create');
        
        Route::get('/rekap/delete/{id}', [RecapitulationController::class, 'deleteRecap'])->name('recap.delete');
        
        Route::get('/rekap/riwayat',  [RecapitulationController::class, 'recapHistory'])->name('recap.history');

        Route::get('/rekap/detail/{id}', [RecapitulationController::class, 'viewRecap'])->name('recap.view');
    });
    
    Route::prefix('admin')->middleware('can:admin-access')->group(function () {
        Route::get('/', [Controller::class, 'AdminDashboard'])->name('admin.dashboard');
        
        Route::get('/kelola-akun/staff', [AccountController::class, 'viewStaff'])->name('staff.view');
        
        Route::get('/kelola-akun/staff/input', [AccountController::class, 'inputStaff'])->name('staff.input');
        
        Route::post('/kelola-akun/staff/create', [AccountController::class, 'createStaff'])->name('staff.create');
        
        Route::get('/kelola-akun/staff/edit/{id}', [AccountController::class, 'editStaff'])->name('staff.edit');
        
        Route::post('/kelola-akun/staff/update/{id}', [AccountController::class, 'updateStaff'])->name('staff.update');
        
        Route::get('/kelola-akun/staff/delete/{id}', [AccountController::class, 'deleteStaff'])->name('staff.delete');
        
        Route::get('/kelola-akun/admin', [AccountController::class, 'viewAdmin'])->name('admin.view');
        
        Route::get('/kelola-akun/admin/input', [AccountController::class, 'inputAdmin'])->name('admin.input');
        
        Route::post('/kelola-akun/admin/create', [AccountController::class, 'createAdmin'])->name('admin.create');
        
        Route::get('/kelola-akun/admin/edit/{id}', [AccountController::class, 'editAdmin'])->name('admin.edit');
        
        Route::post('/kelola-akun/admin/update/{id}', [AccountController::class, 'updateAdmin'])->name('admin.update');
        
        Route::get('/kelola-akun/admin/delete/{id}', [AccountController::class, 'deleteAdmin'])->name('admin.delete');
        
        Route::get('/kelola-master-data/unit', [MasterDataController::class, 'viewUnit'])->name('unit.view');
        
        Route::get('/kelola-master-data/unit/input', [MasterDataController::class, 'inputUnit'])->name('unit.input');
        
        Route::post('/kelola-master-data/unit/create', [MasterDataController::class, 'createUnit'])->name('unit.create');
        
        Route::get('/kelola-master-data/unit/edit/{id}', [MasterDataController::class, 'editUnit'])->name('unit.edit');
        
        Route::post('/kelola-master-data/unit/update/{id}', [MasterDataController::class, 'updateUnit'])->name('unit.update');
        
        Route::get('/kelola-master-data/unit/delete/{id}', [MasterDataController::class, 'deleteUnit'])->name('unit.delete');
        
        Route::get('/kelola-master-data/pembangkit', [MasterDataController::class, 'viewPowerPlant'])->name('power-plant.view');
        
        Route::get('/kelola-master-data/pembangkit/input', [MasterDataController::class, 'inputPowerPlant'])->name('power-plant.input');
        
        Route::post('/kelola-master-data/pembangkit/create', [MasterDataController::class, 'createPowerPlant'])->name('power-plant.create');
        
        Route::get('/kelola-master-data/pembangkit/edit/{id}', [MasterDataController::class, 'editPowerPlant'])->name('power-plant.edit');
        
        Route::post('/kelola-master-data/pembangkit/update/{id}', [MasterDataController::class, 'updatePowerPlant'])->name('power-plant.update');
        
        Route::get('/kelola-master-data/pembangkit/delete/{id}', [MasterDataController::class, 'deletePowerPlant'])->name('power-plant.delete');
        
        Route::get('/kelola-master-data/material', [MasterDataController::class, 'viewMaterial'])->name('material.view');
        
        Route::get('/kelola-master-data/material/input', [MasterDataController::class, 'inputMaterial'])->name('material.input');
        
        Route::post('/kelola-master-data/material/create', [MasterDataController::class, 'createMaterial'])->name('material.create');
        
        Route::get('/kelola-master-data/material/edit/{id}', [MasterDataController::class, 'editMaterial'])->name('material.edit');
        
        Route::post('/kelola-master-data/material/update/{id}', [MasterDataController::class, 'updateMaterial'])->name('material.update');
        
        Route::get('/kelola-master-data/material/delete/{id}', [MasterDataController::class, 'deleteMaterial'])->name('material.delete');
    });     
});

Route::get('/test-excel', function () {
    return view('exports.plts-reports.utama');
})->name('excel.utama');