<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function submit(Request $request, Assignment $assignment)
    {
        $request->validate([
            'file' => 'required|file|max:20480', // 20MB
            'comment' => 'nullable|string'
        ]);

        $path = $request->file('file')->store('submissions');

        Submission::create([
            'assignment_id' => $assignment->id,
            'student_id' => auth()->id(),
            'file_path' => $path,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Submission uploaded!');
    }
}
