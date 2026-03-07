<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', UsersController::class);
});
