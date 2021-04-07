<?php

namespace iBlog\Http\Controllers;

use Illuminate\Http\Request;

use iBlog\Notification;

class NotifController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id',auth()->id())->orderBy('created_at','desc')->paginate(15);
        return view('author.notifications')->with('notifications',$notifications);
    }
}
