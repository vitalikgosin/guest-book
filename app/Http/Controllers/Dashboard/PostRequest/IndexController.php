<?php

namespace App\Http\Controllers\Dashboard\PostRequest;

use App\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $postrequests = PostRequest::where('user_id', \Auth::id())
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        $postrequests_received = PostRequest::whereHas(
            'post',
            function ($query) {
                $query->where('post_author_id', \Auth::id());
            }
        )->get();


       // return view('dashboard.requests', ['requests' =>  $postrequests,'postrequests_received' => $postrequests_received]);
        return view('dashboard.requests');



    }


}
