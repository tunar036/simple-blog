@extends('front.layouts.master')
@section('title','Home')
@section('content')
      <div class="col-md-9 mx-auto">
        @foreach ($articles as $article)
          <div class="post-preview">
          <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
              <h2 class="post-title">
                {{$article->title}}
              </h2>
                <img src="{{$article->image}}" >
              <h3 class="post-subtitle">
                {{-- {{ substr(strip_tags($article->content), 0, 50,'..') }} --}}
                {!! \Illuminate\Support\Str::limit($article->content, 75, '...') !!}
              </h3>
            </a>
            <p class="post-meta">Category: <a href="#">{{ $article->getCategory->name}}</a>
              <span class="float-right">{{$article->created_at->diffForHumans()}}</span></p>
        </div>
         @if (!$loop->last)
             <hr>
         @endif
        @endforeach 
      </div>
      @include('front.widgets.categoryWidget')
@endsection
