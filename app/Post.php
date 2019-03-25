<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'created_id',
        'modified_id',
    ];

    public function created_by ()
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function modified_by ()
    {
        return $this->belongsTo(User::class, 'modified_id');
    }

    public function comments () {
        return $this->hasMany(Comment::class, 'parent_id', 'id')->orderBy('created_at', 'desc');
    }
}
