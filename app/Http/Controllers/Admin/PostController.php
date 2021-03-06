<?php

namespace iBlog\Http\Controllers\Admin;

use iBlog\Category;
use iBlog\Subscriber;
use iBlog\Notifications\AuthorPostApproved;
use iBlog\Notifications\NewPostNotify;
use Carbon\Carbon;
use iBlog\Post;
use iBlog\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        $tags= Tag::all();
        return view('admin.post.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'image' => 'required',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        
        if(isset($image))
        {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // chack category directory is exist
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }
            //resize image for category and upload
            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }else{
            $imageName = "default.png";
        }
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status =  true;
        }else{
            $post->status =  false;
        }
        $post->is_approved =  true;
        
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber)
        {
            Notification::route('mail', $subscriber->email)
            ->notify(new NewPostNotify($post));
            // Adding Notifications 
            //$notif = new Notification;
            //$notif->user_id = $subscriber->user_id;
           // $notif->message = "A new post titled '" . $post->title . "' has been published";
            //$notif->save();
        }

        Toastr::success('Post Successfully Saved:)','Success');
        return redirect()->route('admin.post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \iBlog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {   
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \iBlog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories= Category::all();
        $tags= Tag::all();
        return view('admin.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \iBlog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title'=>'required',
            'image' => 'image',
            'categories'=>'required',
            'tags'=>'required',
            'body'=>'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        
        if(isset($image))
        {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // chack category directory is exist
            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('post');
            }

            //delete all post image
            
            if(Storage::disk('public')->exists('post/'.$post->image))
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }

            //resize image for category and upload
            $postImage = Image::make($image)->resize(1600,1066)->stream();
            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }else{
            $imageName = $post->image;
        }
        
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if(isset($request->status))
        {
            $post->status =  true;
        }else{
            $post->status =  false;
        }
        $post->is_approved =  true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post Successfully Updated:)','Success');
        return redirect()->route('admin.post.index');
    }
    public function pending()
    {
        $posts = Post::where('is_approved', false)->get();
        return view('admin.post.pending', compact('posts'));
    }
    public function approval($id)
    {
       $post = Post::find($id);
       if( $post->is_approved == false)
       {
           $post->is_approved = true;
           $post->save();

           // Adding Notifications 
            //$notification = new Notification;
            //$notification->user_id = $post->user_id;
            //$notification->message = "Your post titled '" . $post->title . "' has been approved";
           // $notification->save();
           $post->user->notify(new AuthorPostApproved($post));
           $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber)
            {
                Notification::route('mail', $subscriber->email)
                ->notify(new NewPostNotify($post));
                // Adding Notifications 
                //$notif = new Notification;
               // $notif->user_id = $subscriber->user_id;
                //$notif->message = "A new post titled '" . $post->title . "' has been published";
                //$notif->save();
            }

           Toastr::success('Post Successfully Approved :)','Success');
       }else{
        Toastr::info('This Post Is Already Approved.','Info');
       }
       return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \iBlog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::success('Post Successfully Deleted :)', 'Success');
        return redirect()->back();

    }
}
