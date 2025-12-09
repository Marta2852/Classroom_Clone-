<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class StudentClassController extends Controller
{
    public function index()
    {
        $classes = auth()->user()->classes;

        return view('student.classes.index', compact('classes'));
    }
}
