<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsMember;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/buku/proxy-cover', [BukuController::class, 'proxyCover'])->name('buku.proxy-cover');

// Route bisa di akses member maupun admin
Route::middleware('auth')->group(function () {
    // Profile Controller
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{idUser}', [ProfileController::class, 'update'])->name('profile.update');

    // Security Controller
    Route::get('/profile/security', [SecurityController::class, 'index'])->name('profile.security');
    Route::put('/profile/security/password/{idUser}', [SecurityController::class, 'updatePassword'])->name('profile.security.updatePassword');
    Route::put('/profile/security/email/{idUser}', [SecurityController::class, 'updateEmail'])->name('profile.security.updateEmail');
    Route::delete('/profile/security/{idUser}', [SecurityController::class, 'deleteAccount'])->name('profile.security.deleteAccount');
    
});

// Route khusus Member
Route::middleware('auth', IsMember::class)->group(function () {

});

// Route khusus Admin / Superadmin
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    // Profile Controller
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Peminjaman Controller
    Route::post('peminjaman/{peminjaman}/detail/{detail}', [PeminjamanController::class, 'updateDetail'])->name('peminjaman.updateDetail');
    Route::resource('peminjaman', PeminjamanController::class);

    // Genre Controller
    Route::resource('genre', GenreController::class);

    // Buku Controller
    Route::resource('buku', BukuController::class);

    // Dashboard
    Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

    // User Controller
    Route::resource('user', UserController::class);
    Route::post('user/makeadmin/{idUser}', [UserController::class, 'makeAdmin'])->name('user.makeAdmin');
    Route::post('user/makemember/{idUser}', [UserController::class, 'makeMember'])->name('user.makeAdmin');
});

require __DIR__ . '/auth.php';
