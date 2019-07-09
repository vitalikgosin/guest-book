@extends('admin.layout')

@section('content')

    <div  class="col-md-9 ml-sm-auto col-lg-9 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">messages</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                </button>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <ul>

                    @foreach ($messages as $message)

                        <li>request_id : {{$message['request_id']}}</li>
                        <li>user_name : {{$message->user['name']}}</li>
                        <li>message: {{$message['message']}}</li>
                    @endforeach
                </ul>

                <div class="col-md-12">

                    @if(Auth::user())

                        <form action="{{}}" method="get">
                            @csrf

                            <div class="form-group">
                                <label for="message">Type you message</label>
                                <textarea name="message" class="form-control" aria-label="With textarea" rows="4" placeholder="type new message"></textarea>
                            </div>
                            <br>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
                @endif



            </div>
        </div>

    </div>
@endsection