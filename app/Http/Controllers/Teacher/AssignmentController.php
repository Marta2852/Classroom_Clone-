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
            $path = $request->file('file')->store('assignments', 'public');
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

    // SHOW EDIT FORM
    public function edit(Assignment $assignment)
    {
        return view('teacher.assignments.edit', compact('assignment'));
    }

    // HANDLE UPDATE
    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|max:10240', // 10MB
        ]);

        // Update fields
        $assignment->title = $request->title;
        $assignment->description = $request->description;

        // Handle file replacement
        if ($request->hasFile('file')) {

            // Delete old file
            if ($assignment->file_path && file_exists(public_path($assignment->file_path))) {
                unlink(public_path($assignment->file_path));
            }

            $file = $request->file('file');
            $path = 'uploads/assignments/';
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($path), $fileName);

            $assignment->file_path = $path . $fileName;
        }

        $assignment->save();

        return redirect()
            ->route('teacher.assignments.show', $assignment)
            ->with('success', 'Assignment updated!');
    }
}
