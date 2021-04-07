<?php

namespace iBlog\Http\Controllers\Author;

use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;
use Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->favorite_posts;
        return view('author.favorite',compact('posts'));
    }
}
