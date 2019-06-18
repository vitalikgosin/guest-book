<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        public function index(Request $request)
    {
        //dump($request);
        $a = courses::all();
        //$plucked = $a->pluck('text');


        $b = $a->toArray();

        return view('admin.courses', ['b'=> $a]);
        //return view('test', ['a' => $request->input('a'), 'b' =>  $a, 'd' => $plucked]);
    }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modelname  $modelname
     * @return \Illuminate\Http\Response
     */
    public function show(Modelname $modelname)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modelname  $modelname
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelname $modelname)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modelname  $modelname
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelname $modelname)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modelname  $modelname
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modelname $modelname)
    {
        //
    }
}
