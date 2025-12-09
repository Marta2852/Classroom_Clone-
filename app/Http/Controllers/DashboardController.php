<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use App\Models\Assignment;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // ------------------------------------------------------------
        // DEFAULT VALUES (Prevents Blade errors)
        // ------------------------------------------------------------
        $classCount = 0;
        $assignmentCount = 0;
        $studentCount = 0;
        $submissionCount = 0;
        $recentAssignments = collect();
        $needsGrading = collect();

        $studentClasses = collect();
        $studentClassesCount = 0;
        $pendingAssignments = collect();
        $pendingAssignmentsCount = 0;
        $completedAssignmentsCount = 0;
        $studentSubmissionCount = 0;

        // ------------------------------------------------------------
        // TEACHER DASHBOARD
        // ------------------------------------------------------------
        if ($user->role === 'teacher') {

            // All classes teacher owns
            $classes = Classroom::where('teacher_id', $user->id)->get();
            $classIds = $classes->pluck('id');
            $classCount = $classIds->count();

            // Assignments teacher created
            $assignments = Assignment::whereIn('classroom_id', $classIds)->get();
            $assignmentIds = $assignments->pluck('id');
            $assignmentCount = $assignmentIds->count();

            // Students in teacher's classes (PIVOT)
            $studentCount = DB::table('classroom_student')
                ->whereIn('classroom_id', $classIds)
                ->count();

            // How many submissions teacher received
            $submissionCount = Submission::whereIn('assignment_id', $assignmentIds)->count();

            // Recent assignments
            $recentAssignments = Assignment::whereIn('classroom_id', $classIds)
                ->latest()
                ->take(5)
                ->get();

            // Submissions that still need grading
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

            // What classes the student is in
            $studentClassIds = DB::table('classroom_student')
                ->where('student_id', $user->id)
                ->pluck('classroom_id');

            $studentClasses = Classroom::whereIn('id', $studentClassIds)
                ->with('teacher')
                ->get();

            $studentClassesCount = $studentClasses->count();

            // All assignments from those classes
            $assignments = Assignment::whereIn('classroom_id', $studentClassIds)->get();

            // Student’s submissions
            $studentSubmissionCount = Submission::where('student_id', $user->id)->count();

            $completedAssignmentsCount = $studentSubmissionCount;

            // Pending assignments (no submission made)
            $pendingAssignments = $assignments->filter(function ($assignment) use ($user) {
                return !Submission::where('assignment_id', $assignment->id)
                    ->where('student_id', $user->id)
                    ->exists();
            });

            $pendingAssignmentsCount = $pendingAssignments->count();
        }

        // ------------------------------------------------------------
        // RETURN ONE VIEW
        // ------------------------------------------------------------
        return view('dashboard', compact(
            // Teacher vars
            'classCount',
            'assignmentCount',
            'studentCount',
            'submissionCount',
            'recentAssignments',
            'needsGrading',

            // Student vars
            'studentClasses',
            'studentClassesCount',
            'pendingAssignments',
            'pendingAssignmentsCount',
            'completedAssignmentsCount',
            'studentSubmissionCount'
        ));
    }
}
