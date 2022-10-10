<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdateRequest;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        $tags = $data['tags'];
        unset($data['tags']);


        $post->update($data);
        // $post = $post->fresh();
        // удаляет все привязки, до этого момента которые,
        // были в бд и добавляет новые , которые пришли в массиве
        $post->tags()->sync($tags);

        return redirect()->route('post.show', $post->id);
    }
}
