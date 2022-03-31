<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function getImage(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }

        $image_path = $post->image_path;
        $image_type = $post->image_type;

        if (!$image_path) {
            abort(404);
        }

        if (!Storage::exists($image_path)) {
            abort(404);
        }

        $image = Storage::get($image_path);

        return response($image, 200, [
            'Content-Type' => $image_type,
        ]);
    }
}
