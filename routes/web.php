<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman utama (public)
Route::get('/', function () {
    return view('home');
})->name('home');

// Dashboard Karyawan (hanya role: karyawan)
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/dashboard-karyawan', function () {
        return view('dashboard.karyawan');
    })->name('dashboard.karyawan');
});

// Dashboard HR / Manager
Route::middleware(['auth', 'role:hr,manager'])->group(function () {
    Route::get('/dashboard-hr', function () {
        return view('dashboard.hr');
    })->name('dashboard.hr');
});

// Profile (masih bisa untuk semua user yang login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Auth (login, register, dll)
require __DIR__.'/auth.php';
