<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //
    public function __construct()
    {
       $this->middleware('auth')->except(['index', 'show']); 
    }

    public function index (Request $request)
    {
        if ($request->search) {
            $posts = Post::where('title', 'like', '%' . $request->search . '%')->orWhere('content', 'like', '%' . $request->search . '%')->latest()->paginate(4);
        }
        else {
            $posts = Post::latest()->paginate(4);
        }
        $categories = Category::all();
        return view('blogPosts.blog', compact('posts', 'categories'));
    }

    public function create ()
    {
        $categories = Category::all();

        return view('blogPosts.create-blog-post', compact('categories'));
    }

    public function edit (Post $post)
    {
        if (auth()->user()->id !== $post->user->id)
        {
            abort(403);
        }
        return view('blogPosts.edit-blog-post', compact('post'));   
    }

    public function update (Request $request, Post $post)
    {
        if (auth()->user()->id !== $post->user->id)
        {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'content' => 'required'
        ]);


        $title = $request->input('title');
        $slug = Str::slug($title, '-') . '-' . $post->id;
        $content = $request->input('content');

        // file upload
        $imgPath = 'storage/' . $request->file('image')->store('postsImages', 'public');

        $post->title = $title;
        $post->slug = $slug;
        $post->content = $content;
        $post->imgPath = $imgPath;

        $post->save();

        return redirect()->back()->with('status', 'Post Edited Successfully');

    }

    public function store (Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'content' => 'required',
            'category_id' => 'required'
        ]);


        $title = $request->input('title');
        $category_id = $request->input('category_id');
        if (Post::latest()->first() !== null) {
            $postId = Post::latest()->first()->id + 1;
        }
        else {
            $postId = 1;
        }
        $postId = Post::latest()->take(1)->first()->id + 1;
        $slug = Str::slug($title, '-') . '-' . $postId;
        $user_id = Auth::user()->id;
        $content = $request->input('content');

        // file upload
        $imgPath = 'storage/' . $request->file('image')->store('postsImages', 'public');

        $post = new Post();
        $post->title = $title;
        $post->category_id = $category_id;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->content = $content;
        $post->imgPath = $imgPath;

        $post->save();

        return redirect()->back()->with('status', 'Post Created Successfully');
    }

    public function show (Post $post)
    {
        return view('blogPosts.single-blog-post', compact('post'));
    }

    public function destroy (Post $post)
    {
        $post->delete();

        return redirect()->back()->with('status', 'Post Delete Successfully');

    }
}
