<?php

namespace iBlog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;
use Auth;
use iBlog\Post;
use iBlog\User;

class LikeController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('admin.likes', compact('posts'));
    }
}
