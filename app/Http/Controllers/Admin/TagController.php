<?php

namespace iBlog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use iBlog\Http\Controllers\Controller;
use iBlog\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->get();
        return view('admin.tag.index', compact('tags'));
    }


    public function create()
    {
        
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required'
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();
        Toastr::success('Tag Successfully Saved :)' ,'Success');
        return redirect()->route('admin.tag.index');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.edit', compact('tag'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->save();
        Toastr::success('Tag Succsfully Updated :)', 'Success');
        return redirect()->route('admin.tag.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::find($id)->delete();
        Toastr::success('Tag Sucessfully Deleted :)','Sucess' );
        return redirect()->back();
    }
}
