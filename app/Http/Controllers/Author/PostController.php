<?php

namespace iBlog\Http\Controllers\Author;

use iBlog\Post;
use iBlog\Category;
use iBlog\User;
use Carbon\Carbon;
use iBlog\Tag;
use iBlog\Notifications\NewAuthorPost;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use iBlog\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index',compact('posts'));
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
        return view('author.post.create',compact('categories','tags'));
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
        $post->is_approved =  false;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        
        $users = User::where('role_id', '1')->get();
        Notification::send($users,new NewAuthorPost($post));
        $postBy = User::where('id',$post->user_id)->first();
        /** 
       * foreach($users as $user)
       * {
       *     $notif = new Notification;
      *      $notif->user_id = $user->id;
      *      $notif->message = $postBy->name . " has a new pending post";
       *     $notif->save();
       * }
        */

        Toastr::success('Post Successfully Saved:)','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \iBlog\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        return view('author.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \iBlog\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access post.','Error');
        return redirect()->back();
        }
        $categories= Category::all();
        $tags= Tag::all();
        return view('author.post.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \iBlog\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access post.','Error');
        return redirect()->back();
        }
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
        $post->is_approved =  false;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post Successfully Updated:)','Success');
        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \iBlog\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        if($post->user_id != Auth::id())
        {
            Toastr::error('You are not authorized to access post.','Error');
        return redirect()->back();
        }
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
