<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\GuidelinesController;
use App\Http\Controllers\AdminFeedbackController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Middleware\CheckStatus;

// Guest Routes (Main Landing Page)
Route::get('/', [UserDashboardController::class, 'index'])->name('landing');
Route::get('/api/kuliner/{id}', [UserDashboardController::class, 'show'])->name('kuliner.show.guest');

// Guest Favorites Page
Route::get('/favorites', [UserDashboardController::class, 'favorites'])->name('guest.favorites');

// Guest Actions (Session/Anonymous)
Route::post('/guest/kuliner/{kuliner}/favorite', [UserDashboardController::class, 'guestToggleFavorite'])->name('guest.kuliner.favorite');
Route::post('/guest/kuliner/{kuliner}/rate', [UserDashboardController::class, 'guestRate'])->name('guest.kuliner.rate');
Route::post('/guest/kuliner/{kuliner}/review', [UserDashboardController::class, 'guestReview'])->name('guest.kuliner.review');
Route::post('/guest/review/{review}/like', [UserDashboardController::class, 'guestToggleReviewLike'])->name('guest.review.like');
Route::post('/guest/feedback', [UserDashboardController::class, 'storeFeedback'])->name('guest.feedback.store');

// Admin Login Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin', CheckStatus::class])->group(function () {
    // Dashboard
    Route::get('/dashboard/admin', [AdminController::class, 'dashboard'])->name('dashboard.admin');

    // Kuliner Management
    Route::get('/admin/kuliner', [KulinerController::class, 'manage'])->name('admin.kuliner.manage');
    Route::get('/admin/kuliner/create', [KulinerController::class, 'create'])->name('kuliner.create');
    Route::post('/admin/kuliner', [KulinerController::class, 'store'])->name('kuliner.store');
    Route::get('/admin/kuliner/{id}/edit', [KulinerController::class, 'edit'])->name('kuliner.edit');
    Route::put('/admin/kuliner/{id}', [KulinerController::class, 'update'])->name('kuliner.update');
    Route::delete('/admin/kuliner/{id}/delete', [KulinerController::class, 'destroy'])->name('kuliner.destroy');
    Route::get('/dashboard/admin/kuliner/{id}/show', [KulinerController::class, 'show'])->name('kuliner.show');

    // Review Management
    Route::get('/admin/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/admin/reviews/{id}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    // User Management
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/users/{user}/toggle-ban', [AdminUserController::class, 'toggleBan'])->name('admin.users.toggle-ban');
    Route::get('/admin/users/{user}/logs', [AdminUserController::class, 'logs'])->name('admin.users.logs');

    // Feedback Management
    Route::get('/admin/feedback', [AdminFeedbackController::class, 'index'])->name('admin.feedback.index');
    Route::get('/admin/feedback/{id}', [AdminFeedbackController::class, 'show'])->name('admin.feedback.show');
    Route::post('/admin/feedback/{id}/read', [AdminFeedbackController::class, 'markAsRead'])->name('admin.feedback.read');
    Route::delete('/admin/feedback/{id}', [AdminFeedbackController::class, 'destroy'])->name('admin.feedback.destroy');

    // Activity Logs
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity-logs');

    // Guidelines
    Route::get('/admin/guidelines', [GuidelinesController::class, 'index'])->name('admin.guidelines');
});
