<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    // SHOW ALL ASSIGNMENTS IN A CLASS
    public function index(Classroom $classroom)
    {
        $assignments = $classroom->assignments()->latest()->get();

        return view('teacher.assignments.index', compact('classroom', 'assignments'));
    }

    // SHOW CREATE FORM
    public function create(Classroom $classroom)
    {
        return view('teacher.assignments.create', compact('classroom'));
    }

    // STORE NEW ASSIGNMENT
    public function store(Request $request, Classroom $classroom)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:20480', // 20MB
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('assignments');
        }

        $classroom->assignments()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'file_path'   => $path,
        ]);

        return redirect()
            ->route('teacher.assignments.index', $classroom)
            ->with('success', 'Assignment created!');
    }

    // SHOW ASSIGNMENT PAGE
    public function show(Assignment $assignment)
    {
        $assignment->load('classroom', 'submissions.student');
        return view('teacher.assignments.show', compact('assignment'));
    }
}
