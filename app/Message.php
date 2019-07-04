<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    public $table = "messages";
    //use SoftDeletes;



    public function course()
    {
        return $this->belongsTo(Message::class, 'request_id', 'id');
    }

}
