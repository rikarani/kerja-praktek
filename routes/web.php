<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityFileController;

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

            Route::view('/kategori', 'admin.category.index')->name('category.index');
            Route::get('{activity}/detail', [ActivityController::class, 'detail'])->name('admin.activity.detail');
            Route::get('{activity}/preview', [ActivityController::class, 'preview'])->name('admin.activity.preview');

            Route::get('{activity}/file/{path}/download', [ActivityFileController::class, 'download'])->name('admin.activity.file.download');
            Route::delete('{activity}/file/{path}/delete', [ActivityFileController::class, 'delete'])->name('admin.activity.file.delete');
        });

        Route::view('/users', 'admin.user.index', ['title' => 'Manajemen User'])->name('user.index');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
