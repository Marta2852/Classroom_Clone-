<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ActionLogController;
use Illuminate\Support\Facades\Route;


// Home page
Route::get('/', function () {
    return view('welcome');
});

// General dashboard (only for logged-in + verified)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================
// ROLE-BASED DASHBOARDS
// =========================

Route::middleware(['auth', 'role:admin'])->get('/admin', function () {
    return view('dashboards.admin');
});

Route::middleware(['auth', 'role:teacher'])->get('/teacher', function () {
    return view('dashboards.teacher');
});

Route::middleware(['auth', 'role:student'])->get('/student', function () {
    return view('dashboards.student');
});

require __DIR__.'/auth.php';

// Admin user management
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // user management
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    // action logs
    Route::get('/logs', [\App\Http\Controllers\Admin\ActionLogController::class, 'index'])->name('logs.index');
});
