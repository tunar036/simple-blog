@extends('back.layouts.master')
@section('title','Update article "'.$article->title.'"')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
    <form method="post" action="{{route('admin.articles.update',$article->id)}}" enctype="multipart/form-data">
        @method('put')
        @csrf
            <div class="form-group">
                <label>Article Title</label>
            <input type="text" name="title" class="form-control" value="{{$article->title}}" required>
            </div>
            <div class="form-group">
                <label>Article Category</label>
                <select class="form-control" name="category" required>
                    <option value="">Please Choose</option>
                    @foreach ($categories as $category)
                     <option  @if ($article->category_id==$category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Article Photo</label>
            <img src="{{asset($article->image)}}" class="img-thumbnail rounded" width="300">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Article Content</label>
            <textarea id="editor" name="content" class="form-control" rows="4">{!!$article->content!!}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Update Article</button>
            </div>
        </form>
    </div>
 
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
$(document).ready(function() {
  $('#editor').summernote(
      {
          "height":300,
      }
  );
});
</script>

@endsection