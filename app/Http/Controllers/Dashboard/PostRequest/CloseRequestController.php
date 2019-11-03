<?php

namespace App\Http\Controllers\Dashboard\PostRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\PostRequest;
use App\Post;
use App\Message;


class CloseRequestController extends Controller
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

        $request_status = $post_request->request_status;

        if($request_status ==="open"){


            //$requestedata = PostRequest::where('id', $request_id)
               // ->first();

            //dd($author_id);

            if ( $post_request->post->post_author_id == \Auth::id()){
                $post_request->request_status = 'rejectedByAuthor';
            }
            else {
                $post_request->request_status = 'rejectedByUser';
                //dd($requestedata->request_status);
            }
            $post_request->save();

            return redirect(route('dashboard.index'));

        }


    }



}