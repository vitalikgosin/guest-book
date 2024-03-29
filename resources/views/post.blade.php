@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1 >{{ $postdata->post_title }}</h1>
                    </div>


                            <div class="container-fluid">
                                <div class="row">
                                <div class="post-main-img">
                                @if ($postdata->post_featured_img)
                                    <a href="{{ @route('post', $postdata->post_slug)  }}">
                                        <img src="{{Storage::url($postdata->post_featured_img ) }}" class="img-fluid">
                                    </a>
                                @endif
                                </div>
                                <div class="container p-3">

                                <h3><a href="{{ route('author', $postdata->user->id ) }}">by {{ $postdata->user->name }}</a></h3>
                                 <div class="post-desc">
                                {!! nl2br(e($postdata->post_description)) !!}
                                 </div>
                                    </div>
                            </div>
                            </div>


                </div>



                <div class="card">
                    <div class="card-header">
                        <h2 > Post Reviews </h2>
                    </div>

                    @foreach ($reviews as $review)

                    <div class="container p-3">

                        <h3>by {{  $review->user->name }}</h3>
                        <div class="post-desc">
                            <ul>
                                <li>

                                    <div class="container">
                                        <div class="row">
                                            <div class="rating">
                                                @for( $i =1;  $i <= $review->review_score; $i++)
                                                <input type="radio" id="star10" name="rating" value="{{$i}}" /><label for="star" title="star">star</label>
                                                 @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <br>



                                </li>
                                <li>  {{ nl2br(e($review->review)) }}</li>
                            </ul>
                        </div>
                    </div>

                    @endforeach


                </div>
            </div>
            <div class="col-md-4">

                @if(Auth::user())

                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">



                                <form action="{{route('dashboard.add-review', $postdata->id)}}" method="post" >
                                    @csrf



                                    <div class="form-group">
                                        <label for="review_message">Type you message</label>
                                        <textarea name="review_message" class="form-control" aria-label="With textarea" rows="4" placeholder="type new message"></textarea>
                                    </div>
                                    <br>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>






                        </div>
                    </div>

            </div>

            @else

                <div class="card-body loginform">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <button id="reg-form" class="btn btn-link" href="#"> Not Have Account?</button>

                <div class="card-body registrationform">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            @endif
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $("#reg-form").click(function(){
                $(".registrationform").toggle(1000);
            });
        });
    </script>

@endsection


