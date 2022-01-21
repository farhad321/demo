<div class="col">
 <div class="card">
  <a href="{{$post->link}}">
   <img src="{{$post->getFirstMedia('SpecialImage')?->getUrl('thumb')}}"
        class="card-img-top"
        alt="...">
  </a>
  <p class="blog-detail">
   <span>
    <i class="fa fa-calendar-o"></i> {{jdate($post->created_at)->ago()}}</span>
   <span>
    <i class="fa fa-bookmark-o"></i>{{$post?->category?->name}} </span>
   <span><i class="fa fa-pie-chart"
            aria-hidden="true"></i> {{$post->views}} بازدید</span>
  </p>
  <div class="card-body card-bg  p-1 pt-2">
   <a href="{{$post->link}}"
      class="card-title">
    <h4 class="blog-item">{!! strip_tags(Str::padRight($post->title, 100))  !!}</h4>
   </a>
   <p class="cart-text blog-meta">{!! $post->limit_content!!}</p>
  </div>
 </div>
</div>