@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Courses</div>
                <ul class="courses-list">
                    @foreach ($courses as $course)
                        <li>
                            @if ($course->course_featured_img)
                                <a href="{{ @route('course', $course->course_slug)  }}">
                                    <img src="{{Storage::url($course->course_featured_img ) }}" style="max-width: 200px;">
                                </a>
                            @endif
                            <a href="{{ @route('course', $course->course_slug)  }}">{{ $course->course_title }}</a>
                            by {{ $course->user->name }}
                            <p>
                                {!! nl2br(e($course->course_description)) !!}
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
