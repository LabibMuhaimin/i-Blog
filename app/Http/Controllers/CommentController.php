<?php

namespace iBlog\Http\Controllers;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use iBlog\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $post)
    {
        $this->validate($request,[
            'comment' => 'required'

        ]);
        $comment = new Comment();
        $comment->post_id= $post;
        $comment->user_id =Auth::id();
        $comment->Comment= $request->comment;
        $comment->save();

        Toastr::success('Comment Successfully Published :)','Success');
        return redirect()->back();

    }
}
