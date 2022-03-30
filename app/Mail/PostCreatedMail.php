<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private Post $post
    ){

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $post = $this->post;
        return $this->view('emails.postCreated', compact('post'))->subject('Es wurde ein Post erstellt!');
    }
}
