<section class="index-blog blog-block pt-5 pb-5">
 <div class="container">
  <div class="section-title clearfix">
   <h2>وبلاگ</h2>
  </div>
  <div id="carouselExampleControls"
       class="carousel slide"
       data-bs-ride="carousel">
   <div class="carousel-inner">
    @php
     $posts=\App\Models\Blog\Post::with('category')->latest()->limit(8)->get()->chunk(4);
    @endphp
    @foreach($posts as $key=>$group)



     <div class="carousel-item @if($loop->first) active @endif">
      <div class="row row-cols-1 row-cols-md-3 row-cols-md-4 g-3 flex-nowrap flex-md-wrap">
       @foreach($group as $key=>$post)
        @php

         $t=jdate($post->created_at);

        @endphp



        <div class="col">
         <div class="card">
          <a href="{{route('front.blog.show',[$t->getYear(),$t->getMonth(),$t->getDay(),$post->slug])}}">
           <img src="{{$post->getFirstMediaUrl('thumb')}}"
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
       @endforeach
      </div>
     </div>







    @endforeach
   </div>
   <button class="carousel-control-prev prev"
           type="button"
           data-bs-target="#carouselExampleControls"
           data-bs-slide="prev">
    <span class="carousel-control-prev-icon"
          aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
   </button>
   <button class="carousel-control-next next"
           type="button"
           data-bs-target="#carouselExampleControls"
           data-bs-slide="next">
    <span class="carousel-control-next-icon"
          aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
   </button>
  </div>
 </div>
</section>