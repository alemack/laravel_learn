@extends('layouts.admin')


@section('content')
    <div>
        <div>
            <a href="{{route('post.create')}}" class="btn btn-success mb-3">Add one</a>
        </div>
        <div>
            @foreach($posts as $post)
                <div> <a href="{{route('post.show', $post->id)}}">{{$post->id}}. {{$post->title}}</a></div>
            @endforeach

            <div class="mt-3">
                {{ $posts->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
