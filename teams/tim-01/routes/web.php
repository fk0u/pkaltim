<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\DestinationImageController;

/*
|--------------------------------------------------------------------------
| BAGIAN PUBLIC (PENGUNJUNG)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'landing'])->name('landing');
Route::get('/destination', [PublicController::class, 'index'])->name('destination.index');

// Halaman Detail Wisata (URL: /destination/nama-slug)
Route::get('/destination/{slug}', [PublicController::class, 'show'])->name('destination.show');

// Kirim Review
Route::post('/review/{id}', [PublicController::class, 'storeReview'])->name('review.store');

/*
|--------------------------------------------------------------------------
| BAGIAN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| BAGIAN ADMIN
|--------------------------------------------------------------------------
| Group ini sudah otomatis menambahkan:
| 1. URL awalan '/admin'
| 2. Nama route awalan 'admin.'
*/
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    // 1. Dashboard
    // URL Jadi: /admin/dashboard
    // Name Jadi: admin.dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Resource Controllers (Hapus 'admin/' di depannya)
    // URL Jadi: /admin/destinations
    // Name Jadi: admin.destinations.index, admin.destinations.create, dst.
    Route::resource('destinations', DestinationController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('facility', FacilityController::class);

    Route::get('gallery/selection', [DestinationImageController::class, 'selectionList'])->name('gallery.selection');

    // 2. Halaman Kelola Foto (CRUD per ID Destinasi)
    Route::get('gallery/{id}/manage', [DestinationImageController::class, 'index'])->name('gallery.index'); // Menampilkan form upload & grid
    Route::post('gallery/{id}/store', [DestinationImageController::class, 'store'])->name('gallery.store'); // Proses Upload
    Route::delete('gallery/{id}/destroy', [DestinationImageController::class, 'destroy'])->name('gallery.destroy'); // Hapus Foto
    Route::put('gallery/{id}/primary', [DestinationImageController::class, 'setPrimary'])->name('gallery.primary'); // Set Thumbnail

    // 3. Manajemen Review
    Route::get('reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::put('reviews/{id}/approve', [App\Http\Controllers\Admin\ReviewController::class, 'approve'])->name('reviews.approve');
    Route::delete('reviews/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');
});