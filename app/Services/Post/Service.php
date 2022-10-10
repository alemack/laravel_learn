<?php

namespace App\Services\Post;

use App\Models\Post;



class Service
{
    public function store($data) {
        $tags = $data['tags'];
        unset($data['tags']);


        $post = Post::create($data);

        // если () -то это запрос в базу данных, а если без то вернет  класса Tag
        // привязать к посту post такие в таблице tags такие теги $tags
        $post->tags()->attach($tags);
    }

    public function update($post, $data) {

        $tags = $data['tags'];
        unset($data['tags']);


        $post->update($data);
        // $post = $post->fresh();
        // удаляет все привязки, до этого момента которые,
        // были в бд и добавляет новые , которые пришли в массиве
        $post->tags()->sync($tags);
    }
}
