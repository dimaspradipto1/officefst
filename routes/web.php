<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function () {
    // Login
    Route::get('/',        'index')->name('login');
    Route::post('/login',  'authenticate')->name('login.submit');
    Route::post('/logout', 'logout')->name('logout');

    // Register
    Route::get('/register',  'registerForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', UsersController::class);
    Route::resource('/mahasiswa', MahasiswaController::class);
    Route::resource('/surat', SuratController::class);
    Route::get('/surat-disetujui', [SuratController::class, 'suratDisetujui'])->name('surat-disetujui');
    Route::get('/surat-tervalidasi', [SuratController::class, 'suratTervalidasi'])->name('surat-tervalidasi');

    // Profile
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/upload-photo', [\App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('profile.upload-photo');
});
