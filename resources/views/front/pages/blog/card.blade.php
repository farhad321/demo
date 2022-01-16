@php

 $t=jdate($post->created_at);

@endphp
<div class="col">
 <div class="card">
  <a href="{{route('front.blog.show',[$t->getYear(),$t->getMonth(),$t->getDay(),$post->slug])}}">
   <img src="{{$post->getFirstMedia('SpecialImage')?->getUrl('thumb')}}"
        class="card-img-top"
        alt="...">
  </a>
  <p class="blog-detail">
   <span>
    <i class="fa fa-calendar-o"></i>{{jdate($post->created_at)->ago()}}</span>
   <span>
    <i class="fa fa-bookmark-o"></i>
    {{$post->category->name}} </span>
   <span><i class="fa fa-pie-chart"
            aria-hidden="true"></i>{{$post->views}}</span>
  </p>
  <div class="card-body card-bg">
   <a href="{{route('front.blog.show',[$t->getYear(),$t->getMonth(),$t->getDay(),$post->slug])}}"
      class="card-title">
    <h4 class="blog-item">{!! strip_tags(Str::padRight($post->title, 100))  !!}</h4>
   </a>
   @php

    $content= Str::replace($post->title, '', $post->content);
   $content= strip_tags($content);
   @endphp
   <p class="cart-text blog-meta">{!!  Str::limit($content) !!}</p>
  </div>
 </div>
</div>