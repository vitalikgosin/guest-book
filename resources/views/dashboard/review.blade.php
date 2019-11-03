@extends('dashboard.layout')

@section('content')

    <div  class="col-md-9 ml-sm-auto col-lg-9 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Your feedback is important to us  </h1>

        </div>

        <div class="container">
            <div class="row">

                <div class="col-md-12">



                        <form action="{{route('dashboard.add-review', $post_request->id)}}" method="post" >
                            @csrf

                            <div class="container">
                                <div class="row">
                                    <div class="rating">
                                        <input type="radio" id="star10" name="rating" value="10" /><label for="star10" title="Best!">5 stars</label>
                                        <input type="radio" id="star9" name="rating" value="9" /><label for="star9" title="Very good">4 stars</label>
                                        <input type="radio" id="star8" name="rating" value="8" /><label for="star8" title="Pretty good">3 stars</label>
                                        <input type="radio" id="star7" name="rating" value="7" /><label for="star7" title="Good">2 stars</label>
                                        <input type="radio" id="star6" name="rating" value="6" /><label for="star6" title="Average +">1 star</label>
                                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Average">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Average -">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Kind of bad">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Bad">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title=" Vary Bad">1 star</label>
                                    </div>
                                </div>
                            </div>
                            <br>
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
@endsection