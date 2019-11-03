<?php

namespace App\Http\Controllers\Dashboard\PostRequest;

use App\PostRequest;
use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessagesController extends Controller
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

    public function messages($request_id)
    {
        $post_request = PostRequest::find($request_id);

        if(
            $post_request->user_id != \Auth::id() // не подходит отправитель
            && // и
            $post_request->post->post_author_id != \Auth::id() // не подходит получатель
        ){
            // если не подходит ни тот, ни другой - показываем 404
            abort(404);
        }


        $postmessages = Message::where('request_id', $request_id)
        ->orderBy('created_at' , 'asc')
        ->get();




        return view('dashboard.messages', ['messages' =>  $postmessages,
            'post_request'=>$post_request,

            ]);

    }

    public function startPostBtn($request_id)
    {
        $post_request = PostRequest::find($request_id);
        if($post_request->user_id != \Auth::id())
         {
            abort(404);
          }

    }


}
