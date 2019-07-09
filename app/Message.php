<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    public $table = "messages";
    //use SoftDeletes;



    public function course_request()
    {
        return $this->belongsTo(Message::class, 'request_id', 'id');
    }

    public function user()
    {
        // https://laravel.com/docs/5.7/eloquent-relationships#defining-relationships
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
