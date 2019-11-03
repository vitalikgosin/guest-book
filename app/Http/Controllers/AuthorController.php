<?php

namespace App\Http\Controllers;

use App\Course;

class CoursesController extends Controller
{
    public function index(): \Illuminate\View\View
    {

        $courses = Course::where('published', 1)
            ->orderByDesc('created_at')
            ->with('user')

            ->paginate(2);

            //->withPath('custom/url');
            //->simplePaginate(1);
        return view('courses', ['courses' => $courses]);
    }
}
