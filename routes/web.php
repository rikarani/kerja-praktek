<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActivityFileController;
use App\Http\Controllers\ActivityFolderController;

// Route buat dapatin refresh token dari Google Drive API, jangan dihapus
Route::get('/token', function () {
    $clientID = config('filesystems.disks.google.clientId');

    $url = 'https://accounts.google.com/o/oauth2/v2/auth?'.http_build_query([
        'client_id' => $clientID,
        'redirect_uri' => url('/auth/google/callback'),
        'response_type' => 'code',
        'access_type' => 'offline',
        'prompt' => 'consent',
        'scope' => 'https://www.googleapis.com/auth/drive https://www.googleapis.com/auth/drive.file',
    ]);

    return redirect($url);
});

// Route buat dapatin refresh token dari Google Drive API, jangan dihapus
Route::get('/auth/google/callback', function () {
    $code = request('code');

    $response = Http::asForm()->post('https://oauth2.googleapis.com/token', [
        'code' => $code,
        'client_id' => config('filesystems.disks.google.clientId'),
        'client_secret' => config('filesystems.disks.google.clientSecret'),
        'redirect_uri' => url('/auth/google/callback'),
        'grant_type' => 'authorization_code',
    ]);

    $token = $response->json();

    dd($token);
});

Route::get('/', [IndexController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::view('/edit-profile', 'profile.edit')->name('profile.edit');

    Route::middleware('role:operator')->group(function () {
        Route::view('/dashboard', 'dashboard')->name('dashboard');

        Route::prefix('kegiatan')->group(function () {
            Route::view('/', 'activity.index')->name('activity.index');
            Route::view('/tambah', 'activity.create')->name('activity.create');

            Route::get('/{activity}', [IndexController::class, 'detail'])->name('activity.detail')->withoutMiddleware(['auth', 'role:operator']);
            Route::get('/{activity}/edit', [ActivityController::class, 'edit'])->name('activity.edit');
            Route::get('{activity}/drive', [ActivityController::class, 'drive'])->name('activity.drive');
            Route::get('{activity}/preview', [ActivityController::class, 'preview'])->name('activity.preview');

            Route::delete('{activity}/folder/{path}/delete', ActivityFolderController::class)->name('activity.folder.delete');

            Route::get('{activity}/file/{path}/download', [ActivityFileController::class, 'download'])->name('activity.file.download');
            Route::delete('{activity}/file/{path}/delete', [ActivityFileController::class, 'delete'])->name('activity.file.delete');
        });
    });

    Route::prefix('admin')->group(function () {
        Route::get('/manage-kategori', CategoryController::class)->name('category.index');
        Route::get('/manage-user', UserController::class)->name('user.index');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
