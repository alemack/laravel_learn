<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    public function __invoke(Post $post)
    {
        $data = request()->validate([
            // ключ => правило (необязательно)
            'title'=>'string',
            'content'=>'string',
            'image'=>'string',
            'category_id' => '',
            'tags' => '',
        ]);

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
