@extends('dashboard.layout')

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
                           @dump( $c['post_slug']);
                            <li> <img class="img-thumbnail admin_post_img" src="{{Storage::url($c['post_featured_img']) }}"/></li>

                            <li><a href="{{route('dashboard.edit-post', $c['post_slug'])}}">This is post Title {{$c['post_title']}}</a></li>

                            <li>This is post id {{$c['id']}}</li>
                             <li>This is post content {{$c['post_description']}}</li>
                            @if ($c['post_featured_img'] )
                                <li class="feature_img">{{$c['post_featured_img'] }}</li>

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