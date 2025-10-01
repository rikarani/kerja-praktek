<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', fn () => view('welcome'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

        Route::prefix('kegiatan')->group(function () {
            Route::get('/', fn () => view('admin.kegiatan.index'))->name('kegiatan.index');
            Route::get('/tambah', fn () => view('admin.kegiatan.create'))->name('kegiatan.create');
        });
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
