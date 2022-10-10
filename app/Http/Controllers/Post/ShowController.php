<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Http\Controllers\Controller;

class ShowController extends BaseController
{
    public function __invoke(Post $post)
    {
        // $post = Post::findOrFail($id);

        return view('post.show', compact('post'));
    }
}
