<?php

namespace App\Http\Controllers\Dashboard\Posts;
use App\Http\Controllers\Dashboard\Modelname;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;



use App\Post;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //dump($request);
        $a = Post::where('post_author_id', \Auth::id())
            ->orderBy('post_title', 'desc')
            ->take(10)
            ->get();

        //$plucked = $a->pluck('text');


        $b = $a->toArray();

        return view('dashboard.posts', ['b'=> $a]);
        //return view('test', ['a' => $request->input('a'), 'b' =>  $a, 'd' => $plucked]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_form()
    {
        return view('dashboard.add-post');
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
        $post = new Post;
        $post->post_title = $validatedData['title'];
        $post->post_description = $request->request->get('post_description');
        $post->post_featured_img = $path?? NULL; //isset($path) ? $path : null

        $post->published = $request->request->has('PublishPost');
        $post->post_slug = $post->post_title;
        $post->post_author_id =  \Auth::id();
        $post->save();
        return redirect(route('dashboard.posts'));
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


        $postdata = Post::where('post_slug', $slug)
            ->first();

        if(!$postdata){

            abort(404);
        }

        // dump($b);
      return view('dashboard.edit-post', ['postdata'=> $postdata]);

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


        $postdata = Post::where('post_slug', $slug)
            ->first();


        if($request->hasFile('add_img')){

            if ($postdata->post_featured_img){

                \Storage::delete('public/'.$postdata->post_featured_img);
            }


            $path = $request->file('add_img')->hashName();
            $request->file('add_img')->storeAs('public', $path);

            $postdata->post_featured_img = $path;

        }


        $postdata->post_title=$validatedData['title'];
        $postdata->post_description=$request->get('post_description');

        $postdata->published = $request->request->has('PublishPost');


        $postdata->post_slug = str_slug($postdata->post_title);

        // sdelat izmenenie slug
        // validaciju na formu redaktirovanija

        $postdata->save();

        return redirect(route('dashboard.posts'));
    }

    /**
     * Remove img the specified resource from storage.
     *
     * @param  \App\Modelname  $modelname
     * @return \Illuminate\Http\Response
     */


    public function deleteImg($slug )
    {
        $postdata = Post::where('post_slug', $slug)
            ->first();




            if ($postdata->post_featured_img){

                \Storage::delete('public/'.$postdata->post_featured_img);
            }
        $postdata->post_featured_img = NULL;
        $postdata->save();

       // return redirect(route('dashboard.edit-post', [$slug]));

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
        $postdata = Post::where('post_slug', $slug) ->first();


        $postdata->delete();


        return redirect(route('dashboard.posts'));
    }

}
