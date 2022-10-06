@extends('layouts.main')
@section('content')
<form action="{{route('post.store')}}" method="post">
    <!-- чтобы был хоть какой-то уровень защиты нужен @csrf -->
    @csrf 
  <div class="form-group">
    <label for="title">Title</label>
    <!-- value="{{old('title')}}" -позволяет правильные значения в полях оставлять

    выводит сообщение об ошибке заполнения поля
    @error('title')
    <p class="text-danger">{{$message}}</p>
    @enderror
   -->
    <input
    value="{{old('title')}}"
    type="text" name="title" class="form-control" id="Title"  placeholder="Title">
    @error('title')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group">
    <label for="content">Content</label>
    <textarea name="content" class="form-control" id="content"  placeholder="Content"></textarea>
    @error('content')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group">
    <label for="image">Image</label>
    <input 
    value="{{old('image')}}"
    type="text" name="image" class="form-control" id="image"  placeholder="Image">
    @error('image')
    <p class="text-danger">{{$message}}</p>
    @enderror
  </div>

  <div class="form_group">
    <label for="category">Category</label>
    <select class="form-control" id="category" name="category_id">
      @foreach($categories as $category)
      <option 
      {{old('category_id') == $category->id ? 'selected' : ''}}
      value="{{$category->id}}">{{$category->title}}</option>
      @endforeach
    </select>
  </div>

  
  <div class="form_group">
  <label for="tags">Tags</label>
  <!-- tags[] даем понять, что мы хотим получить массив тегов -->
    <select multiple class="form-select" id="tags" name="tags[]">
    @foreach($tags as $tag)
      <option value="{{$tag->id}}">{{$tag->title}}</option>
      @endforeach
    </select>
  </div>


  <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
