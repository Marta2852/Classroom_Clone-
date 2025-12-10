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
use App\Http\Controllers\DashboardController;


// =========================
// PUBLIC / BASE ROUTES
// =========================

Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// =========================
// PROFILE (ALL AUTH USERS)
// =========================

Route::middleware('auth')->group(function () {

    // Profile edit (Laravel Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Avatar routes
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.avatar.upload');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
});



// =========================
// ROLE-BASED DASHBOARDS
// =========================

Route::middleware(['auth', 'role:admin'])->get('/admin', fn() => view('dashboards.admin'));

Route::middleware(['auth', 'role:teacher'])->get('/teacher', fn() => view('dashboards.teacher'));

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student', function () {
        return view('dashboards.student');
    })->name('student');
});


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

// Edit Assignment
Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])
    ->name('assignments.edit');

Route::put('/assignments/{assignment}', [AssignmentController::class, 'update'])
    ->name('assignments.update');


        // ---------- GRADING SUBMISSIONS ----------
        Route::post('/submissions/{submission}/grade', [SubmissionController::class, 'grade'])
            ->name('submissions.grade');

        // ---------- GRADING PANEL ----------
        Route::get('/grading', [SubmissionController::class, 'grading'])
            ->name('grading.index');

            Route::get('/teacher/assignments/{assignment}/edit', 
    [AssignmentController::class, 'edit']
)->name('teacher.assignments.edit');

Route::post('/teacher/assignments/{assignment}/edit', 
    [AssignmentController::class, 'update']
)->name('teacher.assignments.update');

        
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


Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/join', 
        [\App\Http\Controllers\Student\ClassJoinController::class, 'form']
    )->name('student.join');

    Route::post('/student/join', 
        [\App\Http\Controllers\Student\ClassJoinController::class, 'join']
    )->name('student.join.submit');

});

Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student', function () {
        return redirect()->route('student.classes');
    })->name('student');

    Route::get('/student/classes', [\App\Http\Controllers\Student\StudentClassController::class, 'index'])
        ->name('student.classes');

    Route::get('/student/classes/{classroom}/assignments',
        [\App\Http\Controllers\Student\StudentAssignmentController::class, 'index']
    )->name('student.assignments.index');

    Route::get('/student/assignments/{assignment}',
        [\App\Http\Controllers\Student\StudentAssignmentController::class, 'show']
    )->name('student.assignments.show');

});


