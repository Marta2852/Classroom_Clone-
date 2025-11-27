<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ActionLogController;
use App\Http\Controllers\Student\ClassJoinController;
use App\Http\Controllers\Teacher\ClassroomController;
use App\Http\Controllers\Teacher\AssignmentController;
use App\Http\Controllers\Teacher\SubmissionController;


// =========================
// PUBLIC / BASE ROUTES
// =========================

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// =========================
// PROFILE (ALL AUTH USERS)
// =========================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =========================
// ROLE-BASED DASHBOARDS
// =========================

Route::middleware(['auth', 'role:admin'])->get('/admin', fn() => view('dashboards.admin'));

Route::middleware(['auth', 'role:teacher'])->get('/teacher', fn() => view('dashboards.teacher'));

Route::middleware(['auth', 'role:student'])->get('/student', fn() => view('dashboards.student'));


// Laravel Breeze Auth Routes
require __DIR__.'/auth.php';


// =========================
// ADMIN PANEL ROUTES
// =========================

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Action Logs
        Route::get('/logs', [ActionLogController::class, 'index'])->name('logs.index');
    });


// =========================
// TEACHER CLASS + ASSIGNMENTS + GRADING
// =========================

Route::middleware(['auth', 'role:teacher'])
    ->prefix('teacher')
    ->name('teacher.')
    ->group(function () {

        // ---------- CLASSROOMS ----------
        Route::get('/classes', [ClassroomController::class, 'index'])->name('classes.index');
        Route::get('/classes/create', [ClassroomController::class, 'create'])->name('classes.create');
        Route::post('/classes', [ClassroomController::class, 'store'])->name('classes.store');

        // ---------- ASSIGNMENTS ----------
        Route::get('/classes/{classroom}/assignments', [AssignmentController::class, 'index'])
            ->name('assignments.index');

        Route::get('/classes/{classroom}/assignments/create', [AssignmentController::class, 'create'])
            ->name('assignments.create');

        Route::post('/classes/{classroom}/assignments', [AssignmentController::class, 'store'])
            ->name('assignments.store');

        Route::get('/assignments/{assignment}', [AssignmentController::class, 'show'])
            ->name('assignments.show');

        // ---------- GRADING SUBMISSIONS ----------
        Route::post('/submissions/{submission}/grade', [SubmissionController::class, 'grade'])
            ->name('submissions.grade');
    });

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        // submit assignment
        Route::post('/assignments/{assignment}/submit',
            [\App\Http\Controllers\Student\SubmissionController::class, 'submit']
        )->name('assignments.submit');

    });

   Route::get('/join/{code}', [ClassJoinController::class, 'joinFromQr'])
    ->name('join.qr');
