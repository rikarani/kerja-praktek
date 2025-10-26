<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/kegiatan/{activity}', [IndexController::class, 'detail'])->name('activity.detail');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        Route::prefix('kegiatan')->group(function () {
            Route::view('/', 'admin.activity.index')->name('activity.index');
            Route::view('/tambah', 'admin.activity.create')->name('activity.create');

            Route::get('/preview/{activity}', [IndexController::class, 'preview'])->name('activity.preview');
            Route::view('/kategori', 'admin.category.index')->name('category.index');
        });
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
