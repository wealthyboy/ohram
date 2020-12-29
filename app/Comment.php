<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{   

    protected $fillable = [
        'body',
        'author',
        'email',
    ];
    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
