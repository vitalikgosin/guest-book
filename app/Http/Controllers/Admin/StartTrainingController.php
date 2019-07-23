<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\CourseRequest;
use App\Course;
use App\Message;


class StartTrainingController extends Controller
{
    public function index(Request $request, $request_id)
    {

        $course_request = CourseRequest::find($request_id);

        if(
            $course_request->user_id != \Auth::id() // не подходит отправитель
         ){
            // если не подходит ни тот, ни другой - показываем 404
            abort(404);
        }


        $request_status = $course_request->request_status;

        if($request_status ==="open"){


        $requestedata = CourseRequest::where('id', $request_id)
            ->first();

        $requestedata->request_status = 'activated';
        //dd($requestedata->request_status);

        $requestedata->save();

        return redirect(route('home'));

        }


    }



}