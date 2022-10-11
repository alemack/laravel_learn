<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // выведет в консоли 10 объектов
        Category::factory(20)->create();
        $posts = Post::factory(200)->create();
        $tags = Tag::factory(50)->create();

        foreach ($posts as $post) {
            // pluck - вернет массив из 5 id
            $tagsId = $tags->random(5)->pluck('id');
            $post->tags()->attach($tagsId);
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
