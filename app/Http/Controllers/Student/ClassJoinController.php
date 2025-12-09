<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassJoinController extends Controller
{
    public function form()
    {
        return view('student.join');
    }

    public function join(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $class = Classroom::where('join_code', $request->code)->first();

        if (!$class) {
            return back()->withErrors(['code' => 'Invalid join code']);
        }

        $class->students()->syncWithoutDetaching([auth()->id()]);

        return redirect()->route('student')->with('success', 'You joined the class!');
    }
}
