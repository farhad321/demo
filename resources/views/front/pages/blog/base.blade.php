@extends('front.base')
@section('seo')
 @yield('seo.blog')
@endsection
@section('content')
 <section class=" blog-block m-0">
  <div class="container">
   <article>
    <div>
     <h2>وبلاگ</h2>
    </div>
    <div class="row row-cols-1 row-cols-2">
     <div class="col-12 col-md-4">
      <div class="mb-3 rounded bg-white shadow">
       <div class="p-2">
        <h5 class="text-center border-bottom p-2">آخرین ها</h5>
        <ul class="pe-2 ps-2 list-style-type">
         @php
          $posts=\App\Models\Blog\Post::latest()->limit(5)->get();
         @endphp
         @foreach($posts as $key=>$post0)
          @php
           $t=jdate($post0->created_at);
          @endphp
          <li>
           <a href="{{route('front.blog.show',[$t->getYear(),$t->getMonth(),$t->getDay(),$post0->slug])}}">{{$post0->title}}</a>
          </li>
         @endforeach
        </ul>
       </div>
      </div>
      <div class="mb-3 rounded bg-white shadow">
       <h5 class="text-center border-bottom p-3">آخرین آگهی‌ها</h5>
       <div class="p-2">
        <ul class="p-1">
         @php
          $ads=\App\Models\Ad\Ad::with('user')->whereIsVisible(true)->latest()->limit(10)->get();
         @endphp
         @foreach($ads as $key=>$ad)
          <li class="border-bottom">
           <div class="d-flex">
            <div>
             <a href="{{route('front.ad.show',[$ad->slug])}}">
              <img src="{{$ad->getFirstMedia('SpecialImage')->getUrl('70_70')}}"
                   alt=""
                   width="70px"
                   height="70px">
             </a>
            </div>
            <div class="ms-2">
             <a href="{{route('front.ad.show',[$ad->slug])}}">{{$ad?->user->name}}</a>
             <p class="text-success">تماس بگیرید</p>
            </div>
           </div>
          </li>
         @endforeach
        </ul>
       </div>
      </div>
      <div class="p-2 shadow bg-white rounded">
       <h5>برچسب ها</h5>
       <div class="tags">
        @php
         $tags=\App\Models\Tag:: withCount('posts')->orderBy('posts_count','desc')
                        ->limit(10)->get();
        @endphp
        @foreach($tags as $key=>$tag)
         <a href="{{route('front.blog.tag.index',$tag->slug)}}"
            class="border">#{{$tag->name}}</a>

        @endforeach
       </div>
      </div>
     </div>
     <!--  -->
     @yield('content.blog')
    </div>
   </article>
  </div>
 </section>
@endsection
@section('script')
 @yield('script.blog')
@endsection