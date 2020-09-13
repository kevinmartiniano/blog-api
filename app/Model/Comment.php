<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'created_id',
        'parent_id',
    ];

    public function created_by ()
    {
        return $this->belongsTo(User::class, 'created_id');
    }
}
