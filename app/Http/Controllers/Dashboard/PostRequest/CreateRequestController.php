<?php

namespace App\Http\Controllers\Dashboard\PostRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\PostRequest;
use App\Post;
use App\Message;


class CreateRequestController extends Controller
{
    public function index(Request $request, $slug)
    {


        $postdata = Post::where('post_slug', $slug)
            ->first();


        $post_request = new PostRequest;


        $post_request->post_id = $postdata->id;


        $post_request->user_id =  \Auth::id();
        $post_request->request_status = 'open';
        $post_request->save();


        //--------------------------------------------


        $request_message = new Message;
        $request_message->request_id = $post_request->id;
        $request_message->user_id =  \Auth::id();
        //$request_message->message = $request->input('message'); //- method get
        $request_message->message = $request->request->get('message'); //--- method post
        $request_message->save();




        return redirect(route('dashboard.post-requests'));
    }



}