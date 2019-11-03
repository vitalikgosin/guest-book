<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\PostRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $postrequests = PostRequest::where('user_id', \Auth::id())
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        $postrequests_received = PostRequest::whereHas(
            'post',
            function ($query) {
                $query->where('post_author_id', \Auth::id());
            }
        )->get();


        return view('dashboard.general', ['requests' =>  $postrequests,'postrequests_received' => $postrequests_received]);




    }
}