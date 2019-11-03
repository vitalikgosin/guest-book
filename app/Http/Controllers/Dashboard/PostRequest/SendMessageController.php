<?php

namespace App\Http\Controllers\Dashboard\PostRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\PostRequest;
use App\Post;
use App\Message;


class SendMessageController extends Controller
{
    public function index(Request $request, $request_id)
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


        //--------------------------------------------


        $request_message = new Message;
        $request_message->request_id = $request_id;
        $request_message->user_id =  \Auth::id();
        //$request_message->message = $request->input('message'); //- method get
        $request_message->message = $request->request->get('message'); //--- method post
        $request_message->save();




        return redirect(route('dashboard.messages',[$request_id]));
    }



}