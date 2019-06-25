@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 >{{ $coursedata->course_title }}</h1>
                    </div>


                            <div class="container-fluid">
                                <div class="row">
                                <div class="course-main-img">
                                @if ($coursedata->course_featured_img)
                                    <a href="{{ @route('course', $coursedata->course_slug)  }}">
                                        <img src="{{Storage::url($coursedata->course_featured_img ) }}" class="img-fluid">
                                    </a>
                                @endif
                                </div>
                                <div class="container p-3">
                                <h3>by {{ $coursedata->user->name }}</h3>
                                 <div class="course-desc">
                                {!! nl2br(e($coursedata->course_description)) !!}
                                 </div>
                                    </div>
                            </div>
                            </div>


                </div>
            </div>
        </div>
    </div>
@endsection


