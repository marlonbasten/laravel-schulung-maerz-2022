<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $user = User::find(1);

        // $posts = $user
        //     ->posts()
        //     ->where('created_at', '>=', now()->subYear())
        //     ->get();

        $posts = Post::with('user')->paginate(10);

        // $post = Post::onlyTrashed()->find(16);
        // $post->restore();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = auth()->id();
        $post->save();

        return redirect()->back()->withSuccess('Post wurde erfolgreich erstellt!');
    }
}
