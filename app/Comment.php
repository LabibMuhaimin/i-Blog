<?php

namespace iBlog;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function post()
    {
        return $this ->belongsTo('iBlog\Post');
    }
    public function user()
    {
        return $this ->belongsTo('iBlog\User');
    }
}
