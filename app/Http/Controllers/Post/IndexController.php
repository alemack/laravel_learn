<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Http\Controllers\Controller;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $posts = Post::paginate(10);
        return view('post.index', compact('posts'));
    }
}
