@extends('front.pages.blog.base')
@section('seo.blog')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content.blog')
 <div class="col-10 col-md-7">
  <div>
   @forelse($posts as $post)
    <article class="rounded shadow d-flex p-4 mb-3 bg-white">
     <a href="{{$post->link}}">
      <img src="{{$post?->getFirstMedia('SpecialImage')?->getUrl('150_150')}}"
           alt=""
           class="poster"
           width="200px"
           height="150px">
     </a>
     <div class="ms-3">
      <a href="{{$post->link}}">
       <h2 class="text-dark">{{$post->title}}</h2></a>
      <p class="cart-text blog-meta"></p>
      <p class="article-para">بازدیدها: {{$post->views}}{!!  $post->limit_content !!}</p>
      <a href="{{$post->link}}"
         class="text-success text-little">بیشتر بخوانید</a>
     </div>
    </article>
   @empty
    <article class="rounded shadow d-flex p-3 mb-3 bg-white text-center">
     مقاله ای یافت نشد.
    </article>
   @endforelse
   @if($posts->count())
    <div class="mt-3 w-100 d-flex justify-content-center">
     <nav aria-label="Page navigation example">
      <ul class="pagination">
       @foreach($urls as $url)
        <li class="page-item rounded @if($url['active']) active @endif  @if(!$url['url'] )disabled
@endif"><a class="page-link  bg-transparent"
           href="{{$url['url']}}">{!! $url['label'] !!}</a></li>
       @endforeach
      </ul>
     </nav>
    </div>
   @endif
  </div>
 </div>

@endsection