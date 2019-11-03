<?php

namespace App\Http\Controllers\Dashboard\PostRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\PostRequest;
use App\Review;
use App\Message;


class ReviewController extends Controller
{
    public function index(Request $request, $request_id)
    {



        $post_request = PostRequest::find($request_id);

        if(
            $post_request->user_id != \Auth::id() // не подходит отправитель
         ){
            // если не подходит ни тот, ни другой - показываем 404
            abort(404);
        }

        return view('dashboard.review', ['post_request' => $post_request]);

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

        $post_request = PostRequest::find($request_id);



        // $post_data = Posts::create(['title' => $request->request->get('email'), 'postdata'=>$request->request->get('password')]);
        $review = new Review;
        $review->review = $validatedData['review_message'];



        $review->review_score =$request->input('rating'); // $request->request->get('raiting1') ;


        $review->user_id = \Auth::id();


        $review->post_request_id = $request_id;


       $review->post_id = $post_request->post_id;

       $review->post_author_id =  $post_request->post->post_author_id;

        $review->save();
        return redirect(route('dashboard.post-requests'));
    }



}