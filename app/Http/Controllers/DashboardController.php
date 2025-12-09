<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ------------------------------------------------------------
        // DEFAULT VALUES (Prevents Blade errors)
        // ------------------------------------------------------------

        // Teacher values
        $classCount = 0;
        $assignmentCount = 0;
        $studentCount = 0;
        $submissionCount = 0;
        $recentAssignments = collect();
        $needsGrading = collect();

        // Student values
        $studentClasses = collect();
        $studentClassesCount = 0;
        $pendingAssignments = collect();
        $pendingAssignmentsCount = 0;
        $completedAssignmentsCount = 0;
        $studentSubmissionCount = 0;

        // Admin values
        $totalUsers = 0;
        $totalStudents = 0;
        $totalTeachers = 0;
        $totalClasses = 0;
        $totalAssignments = 0;
        $totalSubmissions = 0;


        // ------------------------------------------------------------
        // TEACHER DASHBOARD
        if ($user->role === 'teacher') {

            $classes = Classroom::where('teacher_id', $user->id)->get();
            $classIds = $classes->pluck('id');
            $classCount = $classIds->count();

            $assignments = Assignment::whereIn('classroom_id', $classIds)->get();
            $assignmentIds = $assignments->pluck('id');
            $assignmentCount = $assignmentIds->count();

            $studentCount = DB::table('classroom_student')
                ->whereIn('classroom_id', $classIds)
                ->count();

            $submissionCount = Submission::whereIn('assignment_id', $assignmentIds)->count();

            $recentAssignments = Assignment::whereIn('classroom_id', $classIds)
                ->latest()
                ->take(5)
                ->get();

            $needsGrading = Submission::whereIn('assignment_id', $assignmentIds)
                ->whereNull('grade')
                ->with('assignment', 'student')
                ->take(5)
                ->get();
        }


        // ------------------------------------------------------------
        // STUDENT DASHBOARD
        // ------------------------------------------------------------
        if ($user->role === 'student') {

            $studentClassIds = DB::table('classroom_student')
                ->where('student_id', $user->id)
                ->pluck('classroom_id');

            $studentClasses = Classroom::whereIn('id', $studentClassIds)
                ->with('teacher')
                ->get();

            $studentClassesCount = $studentClasses->count();

            $assignments = Assignment::whereIn('classroom_id', $studentClassIds)->get();

            $studentSubmissionCount = Submission::where('student_id', $user->id)->count();

            $completedAssignmentsCount = $studentSubmissionCount;

            $pendingAssignments = $assignments->filter(function ($assignment) use ($user) {
                return !Submission::where('assignment_id', $assignment->id)
                    ->where('student_id', $user->id)
                    ->exists();
            });

            $pendingAssignmentsCount = $pendingAssignments->count();
        }


        // ------------------------------------------------------------
        // ADMIN DASHBOARD
        // ------------------------------------------------------------
        if ($user->role === 'admin') {

            $totalUsers = User::count();
            $totalStudents = User::where('role', 'student')->count();
            $totalTeachers = User::where('role', 'teacher')->count();

            $totalClasses = Classroom::count();
            $totalAssignments = Assignment::count();
            $totalSubmissions = Submission::count();
        }


        // ------------------------------------------------------------
        // RETURN ONE COMPACTED VIEW — FINALLY CORRECT
        // ------------------------------------------------------------
        return view('dashboard', compact(

            // Teacher data
            'classCount', 'assignmentCount', 'studentCount',
            'submissionCount', 'recentAssignments', 'needsGrading',

            // Student data
            'studentClasses', 'studentClassesCount', 'pendingAssignments',
            'pendingAssignmentsCount', 'completedAssignmentsCount',
            'studentSubmissionCount',

            // Admin data
            'totalUsers', 'totalStudents', 'totalTeachers',
            'totalClasses', 'totalAssignments', 'totalSubmissions'
        ));
    }
}
