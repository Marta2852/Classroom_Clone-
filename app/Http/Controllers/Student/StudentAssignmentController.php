<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Assignment;

class StudentAssignmentController extends Controller
{
    public function index(Classroom $classroom)
    {
        $assignments = $classroom->assignments()->latest()->get();

        return view('student.assignments.index', compact('classroom', 'assignments'));
    }

    public function show(Assignment $assignment)
    {
        return view('student.assignments.show', compact('assignment'));
    }
}
