<?php

namespace App\Contracts;

use App\Models\Post;
use Illuminate\Http\Request;

interface PostServiceContract
{
    public function create(Request $request): ?Post;
}
