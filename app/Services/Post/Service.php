<?php

namespace App\Services\Post;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\CatalogueMetadataAwareInterface;

class Service
{
    public function store($data) {

        try {
            // обязательно нужно начать транзакцию, чтобы вся магия сработала
            Db::beginTransaction();

            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $tagIds = $this->getTagIds($tags);
            $data['category_id'] = $this->getCategoryId($category);

            $post = Post::create($data);

            // если () -то это запрос в базу данных, а если без то вернет  класса Tag
            // привязать к посту post такие в таблице tags такие теги $tags
            $post->tags()->attach($tagIds);

            // все, что выше совершили, запускай
            DB::commit();
        } catch (\Exception $exeption) {

            // если в блоке try во время выполнения была ошибка, тогда верни все в исходное положение
            DB::rollBack();

            return $exeption->getMessage();
        }

        return $post;
    }

    public function update($post, $data) {

        try {
            // обязательно нужно начать транзакцию, чтобы вся магия сработала
            Db::beginTransaction();

            $tags = $data['tags'];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $tagIds = $this->getTagIdsWithUpdate($tags);
            $data['category_id'] = $this->getCategoryIdWithUpdate($category);


            $post->update($data);
            $post->tags()->sync($tagIds);

            DB::commit();
        } catch (\Exception $exeption) {
            DB::rollBack();
            return $exeption->getMessage();
        }

        //принудительное обновление
        return $post->fresh();
    }

    private function getCategoryId($item) {
        $category = !isset($item['id']) ? Category::create($item) : Category::find($item['id']);
        return $category->id;
    }

    private function getTagIds($tags) {
        $tagIds = [];

        foreach ($tags as $tag) {
            // тернарный оператор
            //если такого нет, то создай, если есть, то найди
            $tag = !isset($tag['id']) ? Tag::create($tag) : Tag::find($tag['id']);
            $tagIds[] = $tag->id;
        }
        return $tagIds;
    }

    private function getCategoryIdWithUpdate($item) {

        if (!isset($item['id'])) {
            $category = Category::create($item);
        } else {
            $category = Category::find($item['id']);
            $category->update($item);
            $category = $category->fresh();

        }

        return $category->id;
    }

    private function getTagIdsWithUpdate($tags) {

        $tagIds = [];

        foreach ($tags as $tag) {
            // $tag = '';

            if (!isset($tag['id'])) {
                $tag = Tag::create($tag);
            } else {
                $currentTag = Tag::find($tag['id']);
                $currentTag->update($tag);
                $tag = $currentTag->fresh();
            }
            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }
}
