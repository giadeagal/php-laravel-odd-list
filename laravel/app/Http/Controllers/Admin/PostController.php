<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Tag;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:50|',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->all();

        $storedPost = new Post;

        $slug = Str::slug($data['title'], '-');
        $slug_base = $slug;

        $present_slug = Post::where('slug', $slug)->first();

        $counter = 1;

        while($present_slug){
            $slug =$slug_base . "-" . $counter;

            $present_slug = Post::where('slug', $slug)->first();

            $counter++;
        }

        $storedPost->slug = $slug;
        $storedPost->fill($data);

        $storedPost->save();

        if(array_key_exists('tags', $data)){
           $storedPost->tags()->attach($data['tags']); 
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.show', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => 'required|max:50|',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->all();

        if($data['title'] != $post->title ){
           $slug = Str::slug($data['title'], '-'); 
           $slug_base = $slug;

           $present_slug = Post::where('slug', $slug)->first();

           $counter = 1;
           while($present_slug) {
            $slug = $slug_base . "-" . $counter;
            $present_slug = Post::where('slug', $slug)->first();
            $counter++;
           }

           $data['slug'] = $slug;
        }
        
        $post->update($data);

        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with ('updated', "Post n. " . $post->id . " modificato con successo");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $post->tags()->detach();
        return redirect()->route('admin.posts.index');
    }
}
