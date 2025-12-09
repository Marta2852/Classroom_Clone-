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

        // Default values
        $classCount = 0;
        $assignmentCount = 0;
        $studentCount = 0;
        $submissionCount = 0;
        $recentAssignments = collect();
        $needsGrading = collect();

        // ============================
        // TEACHER DASHBOARD
        // ============================
        if ($user->role === 'teacher') {

            // Get teacher classes
            $classes = Classroom::where('teacher_id', $user->id)->get();
            $classIds = $classes->pluck('id');

            // --- Basic stats ---
            $classCount = $classIds->count();

            // Get assignment IDs only for teacher's classes
            $assignmentIds = Assignment::whereIn('classroom_id', $classIds)->pluck('id');
            $assignmentCount = $assignmentIds->count();

            // Students enrolled
            $studentCount = DB::table('classroom_student')
                ->whereIn('classroom_id', $classIds)
                ->count();

            // Total submissions
            $submissionCount = Submission::whereIn('assignment_id', $assignmentIds)->count();


            // --- Protect queries when no classes exist ---
            if ($classIds->isNotEmpty()) {

                // Recent assignments (only teacher's)
                $recentAssignments = Assignment::whereIn('classroom_id', $classIds)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

                // Needs grading (only teacher's)
                $needsGrading = Submission::whereIn('assignment_id', $assignmentIds)
                    ->whereNull('grade')
                    ->with('assignment', 'student')
                    ->take(5)
                    ->get();

            } else {
                // No classes → no assignments → no submissions
                $recentAssignments = collect();
                $needsGrading = collect();
            }
        }


        return view('dashboard', compact(
            'classCount',
            'assignmentCount',
            'studentCount',
            'submissionCount',
            'recentAssignments',
            'needsGrading'
        ));
    }
}
