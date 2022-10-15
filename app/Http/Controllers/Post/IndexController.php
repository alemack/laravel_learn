<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Resources\Post\PostResource;

class IndexController extends BaseController
{

    public function __invoke(FilterRequest $request)
    {
       $data = $request->validated();

       $page = $data['page'] ?? 1;
       // исли значение пришло, тогда берем его, если нет,  тогда 10
       $perPage = $data['per_page'] ?? 10;

        $filter = app()->make(PostFilter::class, ['queryParams'=>array_filter($data)]);


        $posts = Post::filter($filter)->paginate($perPage, ['*'], 'page', $page);

        // $posts = Post::all();

        // collection - зарезервированный метод, возращающий коллекцию постов
        return PostResource::collection($posts);

        // return view('post.index', compact('posts'));
    }
}
