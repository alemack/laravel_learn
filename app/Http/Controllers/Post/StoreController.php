<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);

        // если () -то это запрос в базу данных, а если без то вернет  класса Tag
        // привязать к посту post такие в таблице tags такие теги $tags
        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

}
