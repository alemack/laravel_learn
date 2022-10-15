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

        return $post;
    }

    public function update($post, $data) {

        $tags = $data['tags'];
        unset($data['tags']);


        $post->update($data);
        $post->tags()->sync($tags);
        //принудительное обновление
        return $post->fresh();
    }
}
