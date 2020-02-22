<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all blog post
        $blogPosts = BlogPost::all();
        return view('blog.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $blogpost = new BlogPost();
        $blogpost->title = $request->input('blogTitle');
        $blogpost->details = $request->input('blogDetail');
        $blogpost->category_id = $request->input('category');
        $blogpost->user_id = 0;

        if($blogpost->save()){
            $photo = $request->file('featuredPhoto');
            if($photo != null){
                $ext = $photo->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($photo->move(public_path(), $fileName)){
                        $blogpost = BlogPost::find($blogpost->id);
                        $blogpost->featured_image_url = url('/') . '/' . $fileName;
                        $blogpost->save();
                    }
                }

         }
            return redirect()->back()->with('success', 'blog post information saved successfully!!');
        }

        return redirect()->back()->with('failed', 'blog post information could not save');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $blogpost = BlogPost::find($id);
        $categories = Category::all();
        return view('blog.update', compact('blogpost', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $blogPost = BlogPost::find($id);
        $blogPost->title = $request->input('blogTitle');
        $blogPost->details = $request->input('blogDetail');
        $blogPost->category_id = $request->input('category');
        $blogPost->user_id = 0;
        if($blogPost->save()){
            $photo = $request->file('featuredPhoto');
            if($photo != null){
                $ext = $photo->getClientOriginalExtension();
                $fileName = rand(10000, 50000) . '.' . $ext;
                if($ext == 'jpg' || $ext == 'png'){
                    if($photo->move(public_path(), $fileName)){
                        $blogPost = BlogPost::find($blogPost->id);
                        $blogPost->featured_image_url = url('/') . '/' . $fileName;
                        $blogPost->save();
                    }
                }

            }
            return redirect()->back()->with('success', 'Blog post information updated successfully!');
        }
        return redirect()->back()->with('failed', 'Blog post information could not update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(BlogPost::destroy($id))
        {
            return redirect()->back()->with('deleted', 'Deleted successfully');
        }
        return redirect()->back()->with('delete-failed', 'Could not delete');
    }
}
