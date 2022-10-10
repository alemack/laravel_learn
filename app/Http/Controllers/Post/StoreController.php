<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function __invoke()
    {
        $data = request()->validate([
            // ключ => правило (необязательно)
            // required - поле должно быть заполнено,
            // при не заполнении автоматиски создаст и покажет пользователю сообщение об ошибке
            'title'=>'required|string',
            'content'=>'string',
            'image'=>'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        $post = Post::create($data);

        // если () -то это запрос в базу данных, а если без то вернет  класса Tag
        // привязать к посту post такие в таблице tags такие теги $tags
        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

}
