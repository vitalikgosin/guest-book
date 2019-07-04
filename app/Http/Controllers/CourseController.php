<?php

namespace App\Http\Controllers;

use App\Course;

class CourseController extends Controller
{
    public function index($slug): \Illuminate\View\View
    {

        $coursedata = Course::where('course_slug', $slug)
            ->where('published', 1)
            ->with('user')
            ->first();

        if(!$coursedata){ abort(404);}

        return view('course', ['coursedata'=> $coursedata]);


    }

}