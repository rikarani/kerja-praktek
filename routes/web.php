<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        Route::prefix('kegiatan')->group(function () {
            Route::view('/', 'admin.activity.index')->name('activity.index');
            Route::view('/tambah', 'admin.activity.create')->name('activity.create');
        });
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
