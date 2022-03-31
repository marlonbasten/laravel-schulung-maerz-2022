<?php

namespace App\Listeners\Post;

use App\Events\Post\PostDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class DeletePostImageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Post\PostDeletedEvent  $event
     * @return void
     */
    public function handle(PostDeletedEvent $event)
    {
        $post = $event->post;

        if($post->image_path) {
            Storage::delete($post->image_path);
        }
    }
}
