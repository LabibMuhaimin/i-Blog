<?php

namespace iBlog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('iBlog\User');
    }
    public function categories()
    {
        return $this->belongsToMany('iBlog\Category')->withTimestamps();
    }
    public function tags()
    {
        return $this->belongsToMany('iBlog\Tag')->withTimestamps();
    }
    public function favorite_to_users()
    {
        return $this->belongsToMany('iBlog\User')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('iBlog\Comment');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved',1);
    }

    public function scopePublished($query)
    {
        return $query->where('status',1);
    }



}
