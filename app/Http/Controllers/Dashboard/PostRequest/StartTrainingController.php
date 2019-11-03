<?php

namespace App\Http\Controllers\Dashboard\PostRequest;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\PostRequest;
use App\Post;
use App\Message;


class StartTrainingController extends Controller
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


        $request_status = $post_request->request_status;

        if($request_status ==="open"){


        $requestedata = PostRequest::where('id', $request_id)
            ->first();

        $requestedata->request_status = 'activated';
        //dd($requestedata->request_status);

        $requestedata->save();

        return redirect(route('dashboard.index'));

        }


    }



}