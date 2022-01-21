@extends('front.base')
@section('seo')
 @yield('seo.blog')
@endsection
@section('content')
 <section class=" blog-block m-0 pt-5">
  <div class="container">
   <article>
    {{--    <div>--}}
    {{--     <h2>وبلاگ</h2>--}}
    {{--    </div>--}}
    @if(request()->routeIs('front.blog.show'))
     <div class="row row-cols-1 row-cols-2 pt-4">
      <div class="col-12 col-md-4">
    @else
     <div class="row justify-content-center justify-content-md-between pt-4">
      <div class="col-5 hidden">
    @endif

      <div class="mb-3 rounded bg-white shadow">
       <div class="p-2">
        <h5 class="text-center border-bottom p-2  text-dark">آخرین ها</h5>
        <ul class="pe-2 ps-2 list-style-type">
         @php
          $posts=\App\Models\Blog\Post::latest()->limit(5)->get();
         @endphp
         @foreach($posts as $key=>$post0)
          <li>
           <a href="{{$post0->link}}">{{$post0->title}}</a>
          </li>
         @endforeach
        </ul>
       </div>
      </div>
      <div class="mb-3 rounded bg-white shadow">
       <div class="p-2  pe-3">
       <h5 class="text-center border-bottom p-3">آخرین آگهی‌ها</h5>
        <ul>
         @php
          $ads=\App\Models\Ad\Ad::with(['user', 'media' => function ($q) {
                    $q->whereCollectionName('SpecialImage');
                   },])->whereIsVisible(true)->latest()->limit(10)->get();
         @endphp
         @foreach($ads as $key=>$ad)
          <li class="border-bottom">
           <div class="d-flex  justify-content-between align-items-end">
            <div >
             <a href="{{route('front.ad.show',[$ad->slug])}}">{{$ad?->user->name}}</a>
             <p class="text-success text-little">تماس بگیرید</p>
            </div>
            <div class="p-2 pe-0 pb-0">
             <a href="{{route('front.ad.show',[$ad->slug])}}">
              <img src="{{$ad?->getFirstMedia('SpecialImage')?->getUrl('70_70')}}"
                   alt=""
                   width="55px"
                   height="55px"
                   class="border">
             </a>
            </div>

           </div>
          </li>
         @endforeach
        </ul>
       </div>
      </div>
      <div class="p-2 ps-3 shadow bg-white rounded">
       <h5 class="text-dark">برچسب ها</h5>
       <div class="tags">
        @php
         $tags=\App\Models\Tag:: withCount('posts')->orderBy('posts_count','desc')
                        ->limit(10)->get();
        @endphp
        @foreach($tags as $key=>$tag)
         <a href="{{route('front.blog.tag.index.first.page',$tag->slug)}}"
            >#{{$tag->name}}</a>
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