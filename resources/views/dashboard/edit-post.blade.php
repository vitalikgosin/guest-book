@extends('dashboard.layout')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1> Edit single post</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Draft</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Delete</button>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <span data-feather="calendar"></span>
                    This week
                </button>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="mr-sm-auto col-lg-12 px-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('dashboard.update-post', $postdata->post_slug)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="CourseTitle">Course Title</label>
                            <input type="text" name="title" class="form-control" id="posttitle" aria-describedby="emailHelp" placeholder="Enter title" value="{{old('post_title', $postdata['post_title']) }}">

                            <small id="emailHelp" class="form-text text-muted">Course title</small>
                            @if ($errors->get('post_title'))
                                <ol>
                                    @foreach ($errors->get('post_title') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ol>
                            @endif
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">With textarea</span>
                            </div>
                            <textarea name="post_description" class="form-control" aria-label="With textarea">{{old('post_description', $postdata['post_description']) }}</textarea>
                        </div>
                        <br>
                        <div class="custom-file">
                            <input type="file" name="add_img" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="col-md-4 mr-sm-auto col-lg-4 px-4">

                            <img  class="img-fluid admin_post_img" alt="Responsive image"  src="{{Storage::url($postdata->post_featured_img ) }}"/>

                            <a id="delete_post_img" href="{{route('dashboard.deleteImg', $postdata->post_slug)}}" >Delete Course Image</a>

                        </div>
                        @if (old('published', $postdata['published']) )

                        @endif
                        <div class="form-group form-check">
                            <input name="PublishCourse" type="checkbox" class="form-check-input" id="exampleCheck1"
                                 {{old('published', $postdata['published']) ? 'checked':'' }}
                            >
                            <label class="form-check-label" for="exampleCheck1">Publish post</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>


                <div class="col-md-12 mr-sm-auto col-lg-12 px-4">
                    <a href="{{route('dashboard.delete-post', $postdata->post_slug)}}"><button type="submit" class="btn btn-danger">Delete post</button></a>

                </div>
            </div>
        </div>

    </main>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $("#delete_post_img").click(function (event) {

                event.preventDefault();

                $.ajax({


                    type: "POST",

                    url: "{{route('dashboard.deleteImg', $postdata->post_slug)}}"


                }).done(function (msg) {

                    alert("Image Deleted" + msg);

                });
            })
        })
    </script>
@endsection
