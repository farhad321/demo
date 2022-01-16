@extends('front.pages.blog.base')
@section('seo.blog')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content.blog')
 <div class="col-9 col-md-7">
  <div>
   @foreach($posts as $post)

    @php

     $t=jdate($post->created_at);

    @endphp




    <article class="rounded shadow d-flex p-3 mb-3 bg-white">
     <a href="{{route('front.blog.show',[$t->getYear(),$t->getMonth(),$t->getDay(),$post->slug])}}">
      <img src="{{$post->getFirstMediaUrl('frontBlogCategoryIndexBlog')}}"
           alt=""
           class="poster"
           width="150px"
           height="150px">
     </a>
     <div class="ms-3">
      <h2>{{$post->title}}</h2>
      @php

       $content= Str::replace($post->title, '', $post->content);
      $content= strip_tags($content);
      @endphp
      <p class="cart-text blog-meta"></p>
      <p>بازدیدها: {{$post->views}}{!!  Str::limit($content) !!}</p>
      <a href="{{route('front.blog.show',[$t->getYear(),$t->getMonth(),$t->getDay(),$post->slug])}}"
         class="text-success">بیشتر بخوانید</a>
     </div>
    </article>

   @endforeach

   {{--<nav aria-label="Page navigation example">
    <ul class="pagination">
     <li class="page-item">
      <a class="page-link bg-transparent"
         href="#"
         aria-label="Previous">
       <span aria-hidden="true">&laquo;</span>
      </a>
     </li>
     <li class="page-item "><a class="page-link bg-transparent"
                               href="#">1</a></li>
     <li class="page-item"><a class="page-link bg-transparent"
                              href="#">2</a></li>
     <li class="page-item"><a class="page-link bg-transparent"
                              href="#">3</a></li>
     <li class="page-item">
      <a class="page-link bg-transparent"
         href="#"
         aria-label="Next">
       <span aria-hidden="true">&raquo;</span>
      </a>
     </li>
    </ul>
   </nav>--}}
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
  </div>
 </div>

@endsection