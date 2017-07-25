<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([
            'index',
            'show'
        ]);
    }

    public function index()
    {
        $posts = Post::latest()->filter(request(['month', 'year']))->get();

        return view('posts.index', compact('posts'));
    }
//    public function show($adfas)
//    {
//        $post = Post::find($adfas);
//        return view('posts.show', compact('post'));
//    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
//        Validate the request
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);
//        Create a new post using the request data
        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id()
        ]); //Make sure to allow fillable from anywhere
//        And then redirect somewhere
        session()->flash(
            'message', 'Your post has now been published');

        return redirect('/');
    }
}
