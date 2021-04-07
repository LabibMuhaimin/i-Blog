<?php

namespace iBlog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts()
    {
        return $this->belongsToMany('iBlog\Post')->withTimestamps();
    }
    
}
