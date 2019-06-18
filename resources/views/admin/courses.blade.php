@extends('admin.layout')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mr-sm-auto col-lg-12 px-4">
                    <h2> You Courses </h2>
                    <ul>
                        @foreach ($b as $c)
                           @dump( $c['course_slug']);
                            <li> <img class="img-thumbnail admin_course_img" src="{{Storage::url($c['course_featured_img']) }}"/></li>

                            <li><a href="{{route('admin.edit-course', $c['course_slug'])}}">This is course Title {{$c['course_title']}}</a></li>

                            <li>This is course id {{$c['id']}}</li>
                             <li>This is course content {{$c['course_description']}}</li>
                            @if ($c['course_featured_img'] )
                                <li class="feature_img">{{$c['course_featured_img'] }}</li>

                            @endif
                            <li>
                            </li>
                            <hr>
                        @endforeach



                    </ul>
                </div>

            </div>
        </div>

    </main>
@endsection