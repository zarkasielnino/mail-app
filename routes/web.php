<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\SuratController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {

    // General user routes
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/surat-masuk', [UserController::class, 'suratMasuk'])->name('user.surat-masuk');
    Route::get('/user/surat-keluar', [App\Http\Controllers\User\SuratController::class, 'index'])->name('user.surat.index');
    Route::get('/buat-surat', [UserController::class, 'buatSurat'])->name('user.buat-surat');
    Route::get('/arsip', [UserController::class, 'arsip'])->name('user.arsip');
    Route::get('/profil', [UserController::class, 'profil'])->name('user.profil');
    Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
        Route::resource('surat', \App\Http\Controllers\User\SuratController::class);
    });
    Route::get('/surat/{id}', [SuratController::class,'show'])->name('user.surat.show');
    Route::get('/surat/{id}/edit', [SuratController::class,'edit'])->name('user.surat.edit');
    Route::put('/surat/{id}', [SuratController::class,'update'])->name('user.surat.update');
    Route::get('/surat/{id}/download', [SuratController::class,'update'])->name('user.surat.pdf');
    
    // Admin routes (only accessible by admin users)
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/admin/users', [UserController::class, 'manageUsers'])->name('admin.users');
        Route::get('/admin/settings', [UserController::class, 'adminSettings'])->name('admin.settings');
    });

    // Profile routes (for both user and admin)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
