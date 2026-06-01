<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SecurityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/buku/proxy-cover', [BukuController::class, 'proxyCover'])->name('buku.proxy-cover');

Route::resource('/buku', BukuController::class)->middleware(['auth']);
Route::resource('/genre', GenreController::class)->middleware(['auth']);
Route::resource('/peminjaman', PeminjamanController::class)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{idUser}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/security', [SecurityController::class, 'index'])->name('profile.security');
    Route::put('/profile/security/password/{idUser}', [SecurityController::class, 'updatePassword'])->name('profile.security.updatePassword');
    Route::put('/profile/security/email/{idUser}', [SecurityController::class, 'updateEmail'])->name('profile.security.updateEmail');
    Route::delete('/profile/security/{idUser}', [SecurityController::class, 'deleteAccount'])->name('profile.security.deleteAccount');
});

require __DIR__ . '/auth.php';
