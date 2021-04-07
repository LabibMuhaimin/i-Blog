<?php

namespace iBlog\Http\Controllers\Author;

use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts;
        $popular_posts = $user->posts()
        ->withCount('Comments')
        ->withCount('favorite_to_users')
        ->orderBy('view_count', 'desc')
        ->orderBy('comments_count')
        ->orderBy('favorite_to_users_count')
        ->take(5)->get();
        $total_pending_posts = $posts->where('is_approved', false)->count();
        $all_view_count = $posts->sum('view_count');


        return view('author.dashboard', 
        compact('posts', 'popular_posts','total_pending_posts','all_view_count'));
    }
}
