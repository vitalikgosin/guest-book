<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;

class AuthorController extends Controller
{
    public function index($userid): \Illuminate\View\View
    {

        $user_data = User::where('id', $userid)
            ->first();


        if(!$user_data){ abort(404);}

        //Select AVG(review_score) FROM reviews where post_id = 1

        $value = Review::where('post_author_id', $userid);
        $reviews_val =$value->avg('review_score');


        return view('author', ['user_data' => $user_data, 'reviews_val' =>  $reviews_val]);
    }
}
