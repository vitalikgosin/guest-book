<?php

namespace App\Http\Controllers;

use App\Course;
use DB;

class CoursesController extends Controller
{
    public function index(): \Illuminate\View\View
    {

        //Select courses.*, AVG(reviews.review_score) from `courses` JOIN `reviews` on courses.`course_author_id` = reviews.`course_author_id`  where published = 1 Group by courses.id
        /*
                $reviews_avg  = DB::table('courses')
                    ->select(array( 'courses.*' DB::raw( 'AVG( reviews.review_score )' )))
            ->join('reviews', 'courses.course_author_id', '=', 'reviews.course_author_id')
            ->where('published', '=', 1)


            ->groupBy('courses.id')
            //->avg('reviews.review_score');
        ->get();
        */
        $avg = 'AVG( reviews.review_score )';
        $courses = Course::where('published', '=', 1)
            ->with('user')
            ->leftJoin('reviews', 'courses.id', '=', 'reviews.course_id')
            ->select('courses.*', DB::raw( $avg ))
            ->groupBy('courses.id')

            //->get();
            ->orderByDesc('created_at')
            ->paginate(2);



/*
        $courses = Course::where('published', 1)
            ->orderByDesc('created_at')
            ->with('user')

            ->paginate(2);
*/
            //->withPath('custom/url');
            //->simplePaginate(1);
        return view('courses', ['courses' => $courses]);
    }
}
