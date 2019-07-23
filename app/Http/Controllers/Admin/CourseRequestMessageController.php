<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\CourseRequest;
use App\Course;
use App\Message;


class CourseRequestMessageController extends Controller
{
    public function index(Request $request, $request_id)
    {

        $course_request = CourseRequest::find($request_id);

        if(
            $course_request->user_id != \Auth::id() // не подходит отправитель
            && // и
            $course_request->course->course_author_id != \Auth::id() // не подходит получатель
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




        return redirect(route('messages',[$request_id]));
    }



}