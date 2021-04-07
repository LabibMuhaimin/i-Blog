<?php

namespace iBlog\Http\Controllers\Admin;
use Brian2694\Toastr\Facades\Toastr;
use iBlog\User;

use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::Authors()
        ->withCount('posts')
        ->withCount('comments')
        ->withCount('favorite_posts')
        ->get();
        return view('admin.authors',compact('authors'));
    }
    public function destroy($id)
    {
        $author = User::findOrFail($id)->delete();
        Toastr::success('Author Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
    public function makeAdmin($id)
    {
        $user = User::findOrFail($id);
        $user->role_id = 1;
        $user->save();
        Toastr::success($user->name . ' is an admin now', 'Success');
        return redirect()->back();
    }
}
