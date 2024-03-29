<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostRequest extends Model
{
    public $table = "requests";
    //use SoftDeletes;

    public function user()
    {
        // https://laravel.com/docs/5.7/eloquent-relationships#defining-relationships
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

}
