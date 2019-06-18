<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    public $table = "courses";


    public function user()
    {
        // https://laravel.com/docs/5.7/eloquent-relationships#defining-relationships
        return $this->belongsTo(User::class, 'course_author_id', 'id');
    }
}
