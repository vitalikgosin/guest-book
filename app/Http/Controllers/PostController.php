<?php

namespace App\Http\Controllers;

use App\Post;
use App\Review;

class PostController extends Controller
{
    public function index($slug): \Illuminate\View\View
    {

        $postdata = Post::where('post_slug', $slug)
            ->where('published', 1)
            ->with('user')
            ->first();



        if(!$postdata){ abort(404);}




        $reviews = Review::where('post_id', $postdata->id)
            ->orderByDesc('created_at')
            ->with('user')
            //->get();
            ->paginate(10);




        $value = Review::where('post_id', $postdata->id);
        $reviews_avg =$value->avg('review_score');


        return view('post', ['postdata'=> $postdata, 'reviews' =>  $reviews,'reviews_avg'=> $reviews_avg ]);


    }

}