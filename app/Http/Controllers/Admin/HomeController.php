<?php

namespace App\Http\Controllers\Admin;

use App\CourseRequest;
use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
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

        $courserequests = CourseRequest::where('user_id', \Auth::id())
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        $courserequests_received = CourseRequest::whereHas(
            'course',
            function ($query) {
                $query->where('course_author_id', \Auth::id());
            }
        )->get();




        //->withPath('custom/url');
        //->simplePaginate(1);
        //$requests = $courserequests->toArray();

        return view('admin.general', ['requests' =>  $courserequests]);



    }
    public function messages($request_id)
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

        // раз сюда дошли - значит подходит

        $coursemessages = Message::where('request_id', $request_id)
        ->orderByDesc('created_at')
        ->take(10)
        ->get();

        return view('admin.messages', ['messages' =>  $coursemessages]);
    }
}
