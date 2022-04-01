<?php

namespace App\Http\Controllers;

use App\Contracts\PostServiceContract;
use App\Events\Post\PostDeletedEvent;
use App\Http\Requests\Post\DeletePostRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        private PostServiceContract $postService
    )
    {
    }

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

    public function store(StorePostRequest $request): RedirectResponse
    {
        $post = $this->postService->create($request);

        if (!$post) {
            return redirect()->route('post.index')->with('status', 'Der Post konnte nicht erstellt werden');
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
        $categories = Category::where('active', true)->get();
        return view('post.edit', compact('post', 'categories'));
    }
}
