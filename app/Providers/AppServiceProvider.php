<?php

namespace App\Providers;

use App\Contracts\PostServiceContract;
use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

use function GuzzleHttp\Promise\queue;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PostServiceContract::class, PostService::class);

        Gate::define('update-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });
    }
}
