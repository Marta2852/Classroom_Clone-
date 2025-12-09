<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use App\Models\Assignment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Default stats
        $classCount = 0;
        $assignmentCount = 0;
        $studentCount = 0;

        // TEACHER STATS
        if ($user->role === 'teacher') {

            // Get classes belonging to teacher
            $classes = Classroom::where('teacher_id', $user->id)->get();
            $classIds = $classes->pluck('id');

            $classCount = $classIds->count();

            // Count assignments in these classes
            $assignmentCount = Assignment::whereIn('classroom_id', $classIds)->count();

            // Most recent 5 assignments (for teacher dashboard)
            $recentAssignments = Assignment::whereIn('classroom_id', $classIds)
             ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();


            // Count students in these classes (via pivot table)
            $studentCount = DB::table('classroom_student')
                ->whereIn('classroom_id', $classIds)
                ->count();
        }

        return view('dashboard', compact(
            'classCount',
            'assignmentCount',
            'studentCount',
            'recentAssignments'
        ));
    }
}
