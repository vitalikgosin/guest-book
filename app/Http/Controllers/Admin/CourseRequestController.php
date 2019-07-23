<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\CourseRequest;
use App\Course;
use App\Message;


class CourseRequestController extends Controller
{
    public function index(Request $request, $slug)
    {


        $coursedata = Course::where('course_slug', $slug)
            ->first();
        //dd($coursedata->id);

        $course_request = new CourseRequest;


        $course_request->course_id = $coursedata->id;
        //$course_request->course_description = $request->request->get('course_description');

        $course_request->user_id =  \Auth::id();
        $course_request->request_status = 'open';
        $course_request->save();

        //--------------------------------------------


        $request_message = new Message;
        $request_message->request_id = $course_request->id;
        $request_message->user_id =  \Auth::id();
        //$request_message->message = $request->input('message'); //- method get
        $request_message->message = $request->request->get('message'); //--- method post
        $request_message->save();




        return redirect(route('home'));
    }



}