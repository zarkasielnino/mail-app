<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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
        Route::resource('surat', SuratController::class);
    });
    Route::get('/surat/{id}', [SuratController::class, 'show'])->name('user.surat.show');
    Route::get('/surat/{id}/edit', [SuratController::class, 'edit'])->name('user.surat.edit');
    Route::put('/surat/{id}/update', [SuratController::class, 'update'])->name('user.surat.update');
    Route::put('/user/surat/{id}/ajukan', [SuratController::class, 'ajukan'])->name('user.surat.ajukan');
    Route::get('/surat/{id}/download', [SuratController::class, 'download'])->name('user.surat.pdf');

    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/surat-masuk', [AdminController::class, 'suratmasuk'])->name('admin.surat-masuk');
    Route::get('admin/surat-keluar', [AdminController::class, 'suratkeluar'])->name('admin.surat-keluar');
    Route::get('admin/arsip', [AdminController::class, 'arsip'])->name('admin.arsip');
    Route::get('admin/disposisi', [AdminController::class, 'disposisi'])->name('admin.disposisi');
    Route::get('admin/manage', [AdminController::class, 'manage'])->name('admin.manage');
    Route::get('admin/template', [AdminController::class, 'template'])->name('admin.template');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('admin/pengaturan', [AdminController::class, 'pengaturan'])->name('admin.pengaturan');

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

require __DIR__ . '/auth.php';
