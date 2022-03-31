<?php

namespace App\Http\Controllers\Api;

use App\Contracts\PostServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Mail\PostCreatedMail;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(
        private PostServiceContract $postService
    ) {

    }

    public function index()
    {
        if(!auth()->user()->tokenCan('show_posts')) {
            abort(403);
        }

        return Post::select([
            'id',
            'title',
            'content',
            'user_id'
        ])->get();
    }

    public function store(StorePostRequest $request)
    {
        $post = $this->postService->create($request);

        if (!$post) {
            return [
                'success' => false,
                'message' => 'Post konnte nicht angelegt werden.',
                'data' => [],
            ];
        }

        return [
            'success' => true,
            'message' => 'Der Post wurde erfolgreich erstellt!',
            'data' => $post,
        ];
    }
}
