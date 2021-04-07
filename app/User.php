<?php

namespace iBlog;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'username', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('iBlog\Role');
    }
    public function posts()
    {
        return $this->hasMany('iBlog\Post');
    }
    public function favorite_posts()
    {
        return $this->belongsToMany('iBlog\Post')->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany('iBlog\Comment');
    }

    public function scopeAuthors($query)
    {
        return $query->where('role_id',2);
    }
    public function scopeAdmins($query)
    {
        return $query->where('role_id',1);
    }

}
