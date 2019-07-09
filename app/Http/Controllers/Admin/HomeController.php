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

        $courserequests_received = CourseRequest::where('course_id', \Auth::id())
            ->orderByDesc('created_at')
            ->take(10)
            ->get();




        //->withPath('custom/url');
        //->simplePaginate(1);
        //$requests = $courserequests->toArray();

        return view('admin.general', ['requests' =>  $courserequests]);



    }
    public function messages($request_id)
    {
        if(CourseRequest::find($request_id)->user_id != \Auth::id()){

            abort(404);
        }

        $coursemessages = Message::where('request_id', $request_id)
        ->orderByDesc('created_at')
        ->take(10)
        ->get();

        return view('admin.messages', ['messages' =>  $coursemessages]);
    }
}
