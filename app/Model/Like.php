<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'like',
        'created_id',
        'post_id',
        'comment_id',
    ];
}
