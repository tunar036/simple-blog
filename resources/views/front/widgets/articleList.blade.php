@if (count($articles)>0)
              
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
  {{-- paginate --}}
{{$articles -> links()}}
@else
    <div class="alert alert-danger">
        <h1>No articles found in this category</h1>
    </div>
@endif
