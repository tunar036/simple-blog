@extends('back.layouts.master')
@section('title','All Articles')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">@yield('title')
          <span class="float-right">{{$articles->count()}} articles found</strong>
          <a href="{{route('admin.articles.index')}}" class="btn btn-sm"><i class="fa fa-newspaper" style="font-size:35px;color:#4D72DE"></i></a>
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>İmage</th>
              <th>Article Title</th>
              <th>Category</th>
              <th>Hit</th>
              <th>Created</th>
              <th>Transactions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($articles as $article)
                  
            <tr>
              <td>
                <img src="{{asset($article->image)}}" width="200" >
              </td>
              <td>{{$article->title}}</td>
              <td>{{$article->getCategory->name}}</td>
              <td>{{$article->hit}}</td>
              <td>{{$article->created_at->diffForHumans()}}</td>
              <td>
              <a href="{{route('admin.recover.article',$article->id)}}" title="Recovery" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
              <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            @endforeach
        </tbody>
        </table>
      </div>
    </div>
 
@endsection

