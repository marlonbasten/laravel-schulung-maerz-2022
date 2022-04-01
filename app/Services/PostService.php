<?php

namespace App\Services;

use App\Contracts\PostServiceContract;
use App\Mail\PostCreatedMail;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostService implements PostServiceContract
{
    public function create(Request $request): ?Post
    {
        $image = $request->file('image');

        $post = new Post($request->validated());
        $post->user_id = auth()->id();

        if ($image) {
            $filename = uniqid('', true) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $filepath = Storage::putFileAs('/images', $image, $filename);

            $post->image_path = $filepath;
            $post->image_type = $image->getMimeType();
        }

        try {
            $post->save();
        } catch (QueryException $e) {
            return null;
        }

        if ($request->has('sendMail')) {
            Mail::to('admin@webseite.de')->queue(new PostCreatedMail($post));
        }

        return $post;
    }
}
