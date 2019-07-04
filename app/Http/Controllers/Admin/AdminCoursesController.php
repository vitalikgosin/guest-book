<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;



use App\Course;

class AdminCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //dump($request);
        $a = Course::where('course_author_id', \Auth::id())
            ->orderBy('course_title', 'desc')
            ->take(10)
            ->get();

        //$plucked = $a->pluck('text');


        $b = $a->toArray();

        return view('admin.courses', ['b'=> $a]);
        //return view('test', ['a' => $request->input('a'), 'b' =>  $a, 'd' => $plucked]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_form()
    {
        return view('admin.add-course');
    }

    /**
     * post method form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'add_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',

        ]);

        if($request->hasFile('add_img')) {
            $path = $request->file('add_img')->hashName();
            $request->file('add_img')->storeAs('public', $path);
        }



        // $post_data = Posts::create(['title' => $request->request->get('email'), 'postdata'=>$request->request->get('password')]);
        $course = new Course;
        $course->course_title = $validatedData['title'];
        $course->course_description = $request->request->get('course_description');
        $course->course_featured_img = $path?? NULL; //isset($path) ? $path : null

        $course->published = $request->request->has('PublishCourse');
        $course->course_slug = $course->course_title;
        $course->course_author_id =  \Auth::id();
        $course->save();
        return redirect(route('admin.courses'));
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
    public function edit($slug)
    {


        $coursedata = Course::where('course_slug', $slug)
            ->first();

        if(!$coursedata){

            abort(404);
        }

        // dump($b);
      return view('admin.edit-course', ['coursedata'=> $coursedata]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modelname  $modelname
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {


        $validatedData = $request->validate([
            'title' => 'required',
            'add_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',

        ]);


        $coursedata = Course::where('course_slug', $slug)
            ->first();


        if($request->hasFile('add_img')){

            if ($coursedata->course_featured_img){

                \Storage::delete('public/'.$coursedata->course_featured_img);
            }


            $path = $request->file('add_img')->hashName();
            $request->file('add_img')->storeAs('public', $path);

            $coursedata->course_featured_img = $path;

        }


        $coursedata->course_title=$validatedData['title'];
        $coursedata->course_description=$request->get('course_description');

        $coursedata->published = $request->request->has('PublishCourse');


        $coursedata->course_slug = str_slug($coursedata->course_title);

        // sdelat izmenenie slug
        // validaciju na formu redaktirovanija

        $coursedata->save();

        return redirect(route('admin.courses'));
    }

    /**
     * Remove img the specified resource from storage.
     *
     * @param  \App\Modelname  $modelname
     * @return \Illuminate\Http\Response
     */


    public function deleteImg($slug )
    {
        $coursedata = Course::where('course_slug', $slug)
            ->first();




            if ($coursedata->course_featured_img){

                \Storage::delete('public/'.$coursedata->course_featured_img);
            }
        $coursedata->course_featured_img = NULL;
        $coursedata->save();

       // return redirect(route('admin.edit-course', [$slug]));

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

    public function delete(Request $request, $slug)
    {
        $coursedata = Course::where('course_slug', $slug) ->first();


        $coursedata->delete();


        return redirect(route('admin.courses'));
    }

}
