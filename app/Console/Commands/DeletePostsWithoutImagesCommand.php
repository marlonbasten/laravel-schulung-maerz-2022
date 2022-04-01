<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class DeletePostsWithoutImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:delete-without-images {--days=30}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all posts without images';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $posts = Post::whereNull('image_path')
            ->where('created_at', '>', now()->subDays($this->option('days')))
            ->get();

        foreach ($posts as $post) {
            if ($post->image_path === null) {
                $post->delete();
            }
        }

        return 0;
    }
}
