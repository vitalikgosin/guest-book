<?php

namespace App\Http\Controllers;

use App\courses;

class CoursesController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $courses = courses::where('published', 1)
            ->orderBy('created_at')
            ->with('user')
            ->get();
        return view('courses', ['courses' => $courses]);
    }
}
