<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    public $table = "posts";
    use SoftDeletes;

    public function user()
    {
        // https://laravel.com/docs/5.7/eloquent-relationships#defining-relationships
        return $this->belongsTo(User::class, 'post_author_id', 'id');
    }
    public function review()
    {
        return $this->belongsTo(Review::class, 'post_id', 'id');
    }
}
