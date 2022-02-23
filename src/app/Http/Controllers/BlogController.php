<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //
    public function index ()
    {
        $posts = Post::all();
        return view('blogPosts.blog', compact('posts'));
    }

    public function create ()
    {
        return view('blogPosts.create-blog-post');
    }

    public function store (Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'content' => 'required'
        ]);


        $title = $request->input('title');
        $slug = Str::slug($title, '-');
        $user_id = Auth::user()->id;
        $content = $request->input('content');

        // file upload
        $imgPath = 'storage/' . $request->file('image')->store('postsImages', 'public');

        $post = new Post();
        $post->title = $title;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->content = $content;
        $post->imgPath = $imgPath;

        $post->save();

        return redirect()->back()->with('status', 'Post Created Successfully');
    }

    public function show ($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('blogPosts.single-blog-post', compact('post'));
    }
}
