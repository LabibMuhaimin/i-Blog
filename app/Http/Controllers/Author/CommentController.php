<?php

namespace iBlog\Http\Controllers\Author;

use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;
use iBlog\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class CommentController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('author.comments', compact('posts'));
    }
    public function destroy($id)
    {

        $comment = Comment::findOrFail($id);
        if($comment->post->user->id == Auth::id())
        {
            $comment->delete();
            Toastr::success('Comment Successfully Removed:)','Success');
        }else{

            Toastr::error('You are not authorized','Access Denied !!!');
        }
        
        return redirect()->back();

    }
}
