<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Course;
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


        //$a = Posts::all();
        //$plucked = $a->pluck('text');
        //return $a;
        $b = 'aaa';
        // dump($b);
        return view('admin.general', ['b' => $b]);


    }
}