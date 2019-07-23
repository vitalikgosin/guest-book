<?php

namespace App\Http\Controllers\Admin;

use App\CourseRequest;
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


        return view('admin.general', ['requests' =>  $courserequests,'courserequests_received' => $courserequests_received]);



    }


}
