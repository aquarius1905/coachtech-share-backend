<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'post_id' => 'required',
        'comment' => 'required | max:120'
    );
}