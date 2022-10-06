<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));    
    }

    public function store() 
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

    public function show(Post $post) 
    {
        // $post = Post::findOrFail($id);

        return view('post.show', compact('post'));
    }

    public function edit(Post $post) 
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));   
    }

    public function update(Post $post)
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

    public function destroy(Post $post) 
    {
        $post->delete();

        return redirect()->route('post.index');
    }

    /*
    public function create() 
        $postsArr = [
            [
                'title' => ' title of post',
                'content' => 'lorem impsum',
                'image' => 'image.jpg',
                'likes' => 20,
                'is_published' => 1,
            ],
            [
                'title' => ' title of another',
                'content' => 'Thwenke',
                'image' => 'nature.jpg',
                'likes' => 30,
                'is_published' => 1,
            ],
        ];

        
        // Post::create([ 'title' => ' title of post',
        // 'content' => 'lorem impsum',
        // 'image' => 'image.jpg',
        // 'likes' => 20,
        // 'is_published' => 1,]); // массив в качестве аргумента
               

        foreach ($postsArr as $item) {
            Post::create($item);
        }

        dd('created');
    } */



    /*
    public function update() {

        $post = Post::find(4);
        // dd($post->title);

        $post->update([
            'title' => 'updated',
                'content' => 'updated',
                'image' => 'updated',
                'likes' => 59,
                'is_published' => 1,
        ]);
        dd('updated');
    }
    */

    /*
    public function delete() {
        // так никто не делает при реальных проектах
        // hard delete

        
        // $post = Post::find(4);
        // $post->delete();
        // dd('del'); 
        

        // должна быть возможность восстановить данные
        // soft delete
  
        // $post = Post::find(2);
        // $post->delete();
        // dd('del');
        
        // восстановлени
        $post = Post::withTrashed()->find(2);
        $post->restore();
        dd('res');


    }
    */

    // firstOrCreate
    // достать какую-то запись, то создать такую запись
    
    // updateOrCreate 
    // обновить какую-то запись или создать 

    public function firstOrCreate() {
        $post = Post::find(1);
        $anotherPost = [
            'title' => 'some',
            'content' => 'some',
            'image' => 'some',
            'likes' => 50000,
            'is_published' => 1,

        ];

        // если найдет в базе запись с таким значением то вернет запись
        $myPost = Post::firstOrCreate([
            'title' => 'some PHP'
        ],[
            'title' => 'some PHP',
            'content' => 'some',
            'image' => 'some',
            'likes' => 50000,
            'is_published' => 1,
        ]); 
        dump($myPost->content);
        dd('end');
    }

    public function updateOrCreate() {
        $anotherPost = [
            'title' => 'update or create',
            'content' => 'update or create',
            'image' => 'update or create',
            'likes' => 500210,
            'is_published' => 1,

        ];

        $post = Post::updateOrCreate([
            'title' => 'update or create',
        ],[
            'title' => 'update or create 2212',
            'content' => 'update or create 2323',
            'image' => 'update or create',
            'likes' => 500210,
            'is_published' => 1,
        ]);

        dd('e');
    }
}
