<?php

namespace iBlog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;
use Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->favorite_posts;
        return view('admin.favorite',compact('posts'));
    }
}
