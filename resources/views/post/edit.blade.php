@extends('layouts.main')
@section('content')
<form action="{{route('post.update', $post->id)}}" method="post">
    <!-- чтобы был хоть какой-то уровень защиты нужен @csrf -->
    @csrf 
    <!-- для изменений обязательно указать метода path -->
    @method('patch') 
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="Title"  placeholder="Title" value="{{$post->title}}">
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea name="content" class="form-control" id="content"  placeholder="Content">{{$post->content}}</textarea>
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input type="text" name="image" class="form-control" id="image"  placeholder="Image" value="{{$post->image}}">
  </div>

  <div class="form_group">
    <label for="category">Category</label>
    <select class="form-control" id="category" name="category_id">
      @foreach($categories as $category)
      <option
      {{$category->id === $post->category->id ? 'selected': ''}}
      value="{{$category->id}}">{{$category->title}}</option>
      @endforeach
    </select>
  </div>


  <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
