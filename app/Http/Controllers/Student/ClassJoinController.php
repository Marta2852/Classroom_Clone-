<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classroom;

class ClassJoinController extends Controller
{
    public function joinFromQr($code)
    {
        $class = Classroom::where('join_code', $code)->first();

        if (!$class) {
            abort(404, 'Invalid join code');
        }

        $class->students()->syncWithoutDetaching([auth()->id()]);

        return redirect()->route('student')
            ->with('success', 'You joined the class!');
    }
}
