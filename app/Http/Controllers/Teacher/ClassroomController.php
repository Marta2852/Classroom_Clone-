<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
    public function index()
    {
        $classes = Classroom::where('teacher_id', auth()->id())->get();
        return view('teacher.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('teacher.classes.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'nullable',
    ]);

    $joinCode = strtoupper(Str::random(6)); // Example: "85XYQT"

    Classroom::create([
        'teacher_id'   => auth()->id(),
        'name'         => $request->name,
        'description'  => $request->description,
        'join_code'    => $joinCode,   // <-- VERY IMPORTANT
    ]);

    return redirect()
        ->route('teacher.classes.index')
        ->with('success', 'Class created!');
}
}
