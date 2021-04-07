<?php

namespace iBlog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;
use iBlog\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->get();
        return view('admin.subscriber', compact('subscribers'));

    }
    public function destroy($subscriber)
    {
        $subscriber = Subscriber::findOrFail($subscriber)->delete();
        Toastr::success('Subscriber Successfully Deleted :) ','Success');
        return redirect()->back();
    }
}
