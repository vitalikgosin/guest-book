<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\CourseRequest;
use App\Review;
use App\Message;


class ReviewController extends Controller
{
    public function index(Request $request, $request_id)
    {



        $course_request = CourseRequest::find($request_id);

        if(
            $course_request->user_id != \Auth::id() // не подходит отправитель
         ){
            // если не подходит ни тот, ни другой - показываем 404
            abort(404);
        }

        return view('admin.review', ['course_request' => $course_request]);

    }

    /**
     * post method form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addReview(Request $request, $request_id)
    {

        $validatedData = $request->validate([
            'review_message' => 'required',

        ]);

        $course_request = CourseRequest::find($request_id);



        // $post_data = Posts::create(['title' => $request->request->get('email'), 'postdata'=>$request->request->get('password')]);
        $review = new Review;
        $review->review = $validatedData['review_message'];



        $review->review_score =$request->input('rating'); // $request->request->get('raiting1') ;


        $review->user_id = \Auth::id();


        $review->course_request_id = $request_id;


       $review->course_id = $course_request->course_id;

       $review->course_author_id =  $course_request->course->course_author_id;

        $review->save();
        return redirect(route('home'));
    }



}