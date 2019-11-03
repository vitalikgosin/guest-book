<?php

namespace App\Http\Controllers;

use App\Post;
use DB;
use App\Review;

class PostsController extends Controller
{
    public function index(): \Illuminate\View\View
    {



        $posts = Post::where('published', '=', 1)

            //->with('review')

            ->leftJoin('reviews', 'posts.id', '=', 'reviews.post_id')
            ->select('posts.*', DB::raw('GROUP_CONCAT(review) AS review'))
           ->groupBy('posts.id', 'reviews.post_id')
            ->with('user')
            ->with('review')
           // ->get();
           // ->orderByDesc('created_at')
           ->paginate(25);

        $posts1 = DB::table('posts')

            ->leftjoin('reviews', 'posts.id', '=', 'reviews.post_id')
           // ->with('user')
            ->select('posts.*', DB::raw('GROUP_CONCAT(review) AS review'))
            ->groupBy('posts.id', 'reviews.post_id')
            ->get();



//dd($posts1);
//        $posts = Post::where('published', 1)
//            ->orderByDesc('created_at')
//            ->with('user')
//
//            ->paginate(20);



            //->withPath('custom/url');
            //->simplePaginate(1);
        return view('posts', ['posts' => $posts]);
    }
}
