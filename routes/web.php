<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminJadwalController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rute Autentikasi Login Admin
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout-to-home', [AdminAuthController::class, 'logout'])->name('admin.logout.home');

// 2. Rute Dashboard & Manajemen Admin (Diproteksi Middleware 'admin.auth')
// PENTING: Letakkan rute admin di ATAS rute publik agar tidak tertukar!
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Manajemen Profil Jemaat
    Route::post('/profil/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    // Manajemen Jadwal Ibadah (CRUD)
    Route::get('/jadwal/tambah', [AdminJadwalController::class, 'create'])->name('admin.jadwal.create');
    Route::post('/jadwal', [AdminJadwalController::class, 'store'])->name('admin.jadwal.store');
    Route::get('/jadwal/{id}/edit', [AdminJadwalController::class, 'edit'])->name('admin.jadwal.edit');
    Route::put('/jadwal/{id}', [AdminJadwalController::class, 'update'])->name('admin.jadwal.update');
    Route::delete('/jadwal/{id}', [AdminJadwalController::class, 'destroy'])->name('admin.jadwal.destroy');

    // Manajemen Galeri Kegiatan (CRUD)
    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('/gallery/tambah', [AdminGalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('/gallery/{id}/edit', [AdminGalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::put('/gallery/{id}', [AdminGalleryController::class, 'update'])->name('admin.gallery.update');
    Route::delete('/gallery/{id}', [AdminGalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    Route::delete('/gallery/image/{id}', [AdminGalleryController::class, 'destroyImage'])->name('admin.gallery.image.destroy');
});

// 3. Rute Halaman Utama & Publik (Diletakkan di bawah rute admin)
Route::get('/', function () {
    return view('welcome-gpm');
})->name('welcome');

Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/jadwal-ibadah', [ProfileController::class, 'jadwal'])->name('jadwal.index');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');