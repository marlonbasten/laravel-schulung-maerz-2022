<?php

namespace App\Http\Controllers;

use App\Events\Post\PostDeletedEvent;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Mail\PostCreatedMail;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // $user = User::find(1);

        // $posts = $user
        //     ->posts()
        //     ->where('created_at', '>=', now()->subYear())
        //     ->get();

        $posts = Post::with(['user', 'categories'])->paginate(10);

        // $post = Post::onlyTrashed()->find(16);
        // $post->restore();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function test(Request $request)
    {
        // ...
    }

    public function store(StorePostRequest $request)
    {
        $image = $request->file('image');

        $post = new Post($request->validated());
        $post->user_id = auth()->id();

        if ($image) {
            $filename = uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
            $filepath = Storage::putFileAs('/images', $image, $filename);

            $post->image_path = $filepath;
            $post->image_type = $image->getMimeType();
        }

        try {
            $post->save();
        } catch (QueryException $e) {
            return redirect()->back()->withStatus($e->getMessage());
        }

        if($request->has('sendMail')) {
            Mail::to('admin@webseite.de')->queue(new PostCreatedMail($post));
        }

        if ($request->expectsJson()) {
            return [
                'success' => true,
                'message' => 'Der Post wurde erfolgreich erstellt!'
            ];
        }

        return redirect()->route('post.index')->with('status', 'Post wurde erfolgreich erstellt');
    }

    public function destroy(DeletePostRequest $request)
    {
        $post = Post::find($request->id);

        event(new PostDeletedEvent($post));

        $post->delete();

        return redirect()->back();
    }

    public function edit(int $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::where('active', true)->get();

        return view('post.edit', compact('post', 'categories'));
    }

    public function update(StorePostRequest $request, int $id)
    {
        $post = Post::findOrFail($id);

        if (!auth()->user()->can('update', $post)) {
            abort(403);
        }

        if (Post::where('title', $request->title)->whereNot('id', $post->id)->first()) {
            return redirect()->back()->withStatus('Ein Post mit diesem Titel existiert bereits!');
        }

        $post->categories()->sync($request->categories);
        $post->update($request->validated());

        return redirect()->back()->withStatus('Der Post wurde erfolgreich geupdatet!');
    }

    public function show(Post $post)
    {
        return view('post.edit', compact('post'));
    }
}
