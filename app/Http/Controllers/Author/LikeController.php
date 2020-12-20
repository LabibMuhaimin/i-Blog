<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Post;
use App\User;

class LikeController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('author.likes', compact('posts'));
    }
}
