<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman utama (public)
Route::get('/', function () {
    return view('home');
})->name('home');

// Dashboard Karyawan (hanya role: karyawan)
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/dashboard-karyawan', [\App\Http\Controllers\DashboardKaryawanController::class, 'index'])->name('dashboard.karyawan');
    Route::get('/pengaduan/buat', [\App\Http\Controllers\PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan/store', [\App\Http\Controllers\PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/saya', [\App\Http\Controllers\PengaduanController::class, 'index'])->name('pengaduan.index');
});

// Dashboard HR / Manager
Route::middleware(['auth', 'role:hr,manager'])->group(function () {
    Route::get('/dashboard-hr', [\App\Http\Controllers\DashboardHrController::class, 'index'])
        ->middleware(['auth', 'role:hr,manager'])
        ->name('dashboard.hr');
    Route::get('/pengaduan/list', [\App\Http\Controllers\PengaduanHrController::class, 'index'])->name('pengaduan.index');
    Route::post('/pengaduan/{pengaduan}/status', [\App\Http\Controllers\PengaduanHrController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::get('/data-karyawan', [\App\Http\Controllers\KaryawanController::class, 'index'])->name('hr.karyawan.index');
    Route::get('/user/create', [\App\Http\Controllers\UserHrController::class, 'create'])->name('hr.user.create');
    Route::post('/user/store', [\App\Http\Controllers\UserHrController::class, 'store'])->name('hr.user.store');
    Route::get('/data-admin', [\App\Http\Controllers\UserHrController::class, 'index'])->name('hr.user.index');
    Route::delete('/user/{user}/delete', [\App\Http\Controllers\UserHrController::class, 'destroy'])
        ->name('hr.user.destroy');

});

// Profile (masih bisa untuk semua user yang login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Auth (login, register, dll)
require __DIR__ . '/auth.php';
