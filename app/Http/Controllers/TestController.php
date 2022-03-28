<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(string $name, int $age = null)
    {
        return view('test', compact('name', 'age'));
    }

    public function test2()
    {
        $users = ['Nutzer1', 'Nutzer2', 'Nutzer3', 'Nutzer4'];
        $age = 20;

        return view('test2', compact('users', 'age'));
    }

    public function test3()
    {
        // $posts = Post::all();

        // foreach ($posts as $post) {
        //     echo $post->id . '<br>';
        // }

        $posts = Post::where('title', 'test')
            ->orderBy('id', 'desc')
            ->get()
            ->reject(fn ($post) => $post->content === 'test')
            ->map(fn ($post) => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content
                ])
            ->count();


        dump($posts);

    }
}
