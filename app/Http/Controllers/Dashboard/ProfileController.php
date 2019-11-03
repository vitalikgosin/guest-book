<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\CourseRequest;
use Illuminate\Http\Request;

class AdminIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $courserequests = CourseRequest::where('user_id', \Auth::id())
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        //->withPath('custom/url');
        //->simplePaginate(1);
        //$requests = $courserequests->toArray();

        return view('admin.general', ['requests' =>  $courserequests]);
        //return view('admin.general', ['b' => $b]);


    }
}