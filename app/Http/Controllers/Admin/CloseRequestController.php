<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\CourseRequest;
use App\Course;
use App\Message;


class CloseRequestController extends Controller
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

        $request_status = $course_request->request_status;

        if($request_status ==="open"){


            //$requestedata = CourseRequest::where('id', $request_id)
               // ->first();

            //dd($author_id);

            if ( $course_request->course->course_author_id == \Auth::id()){
                $course_request->request_status = 'rejectedByAuthor';
            }
            else {
                $course_request->request_status = 'rejectedByUser';
                //dd($requestedata->request_status);
            }
            $course_request->save();

            return redirect(route('home'));

        }


    }



}