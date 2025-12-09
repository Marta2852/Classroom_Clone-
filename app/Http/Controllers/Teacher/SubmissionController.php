<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function grade(Request $request, Submission $submission)
{
    $request->validate(['grade' => 'required|integer|min:0|max:100']);

    $submission->update([
        'grade' => $request->grade
    ]);

    return back()->with('success', 'Grade saved!');
}

public function grading()
{
    $teacherId = auth()->id();

    $submissions = \App\Models\Submission::with(['student', 'assignment.classroom'])
        ->whereNull('grade')
        ->whereHas('assignment.classroom', function ($q) use ($teacherId) {
            $q->where('teacher_id', $teacherId);
        })
        ->get();

    return view('teacher.grading.index', compact('submissions'));
}


}
