@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Courses</div>
                <ul class="posts-list">

                    @foreach ($posts as $post)
                        <li>
                            @if ($post->post_featured_img)
                                <a href="{{ @route('post', $post->post_slug)  }}">
                                    <img src="{{Storage::url($post->post_featured_img ) }}" style="max-width: 200px;">
                                </a>
                            @endif
                            <a href="{{ @route('post', $post->post_slug)  }}">{{ $post->post_title }}</a>
                            by {{ $post->user->name }}
                            <p>
                                {!! nl2br(e($post->post_description)) !!}
                            </p>
                        </li>
                        <div class="card">
                            <div class="card-header">
                                <h2 > Course Average Review </h2>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="rating">
                                        @for( $i =1;  $i <= $post->getAttributes()['AVG( reviews.review_score )']; $i++)

                                            <input type="radio" id="star10" name="rating" value="{{$i}}" /><label for="star" title="star">star</label>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
                {{ $posts->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
