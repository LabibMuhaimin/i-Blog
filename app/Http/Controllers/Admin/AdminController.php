<?php

namespace iBlog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use iBlog\User;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::Admins()
        ->withCount('posts')
        ->withCount('comments')
        ->withCount('favorite_posts')
        ->get();
        return view('admin.admins',compact('admins'));
    }
    public function destroy($id)
    {
        $admin = User::findOrFail($id)->delete();
        Toastr::success('Admin Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
    public function makeAuthor($id)
    {
        $user = User::findOrFail($id);
        $user->role_id = 2;
        $user->save();
        Toastr::success($user->name . ' is an Author now', 'Success');
        return redirect()->back();
    }
}
