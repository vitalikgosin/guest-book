<?php

namespace App\Http\Controllers;

use App\Course;
use App\Review;

class CourseController extends Controller
{
    public function index($slug): \Illuminate\View\View
    {

        $coursedata = Course::where('course_slug', $slug)
            ->where('published', 1)
            ->with('user')
            ->first();



        if(!$coursedata){ abort(404);}




        $reviews = Review::where('course_id', $coursedata->id)
            ->orderByDesc('created_at')
            ->with('user')
            //->get();
            ->paginate(10);




        $value = Review::where('course_id', $coursedata->id);
        $reviews_avg =$value->avg('review_score');


        return view('course', ['coursedata'=> $coursedata, 'reviews' =>  $reviews,'reviews_avg'=> $reviews_avg ]);


    }

}