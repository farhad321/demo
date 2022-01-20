<div class="col-12 col-md-8">
 <div class="bg-white">
  <article>
   <div class="card text-white">
    <img src="{{$post->getFirstMediaUrl('SpecialImage')}}"
         class="card-img"
         alt="...">
    <div class="card-img-overlay d-flex align-items-end">
     <h5 class="card-title">{{$post->title}}</h5>
    </div>
   </div>
   <div class="p-3">
    <p class="p-3 ps-5">بازدیدها: {{$post->views}}</p>
    {!! $post->content !!}
    <div>
     @php

      $post2=\App\Models\Blog\Post::latest()->where('id','<',$post->id)->first();


     @endphp
     @if($post2)
      <div class="text-end d-flex justify-content-end">
       <div class="bg-light p-3 col-md-6">
        @php


         $t2=jdate($post2->created_at);

        @endphp
        <span class="text-secondary">مطلب قبلی</span>
        <p class="text-start mt-2">
        <a href="{{route('front.blog.show',[$t2->getYear(),$t2->getMonth(),$t2->getDay(),$post2->slug])}}">{{$post2->title}}</a>
       </p>
      </div>
     </div>
     @endif
    </div>
   </div>
  </article>
 </div>
 @php
  $posts=\App\Models\Blog\Post::with(['category','media' => function ($q) {
                 $q->whereCollectionName('SpecialImage');
                },])->latest()->limit(6)->get()->chunk(3);
 @endphp
 @include('front.pages.home.home.articles',['posts'=>$posts,'title'=>'وبلاگ','css'=>''])
 <div>
  <h3>دیدگاهتان را بنویسید </h3>
  @auth()
   <p>با عنوان {{auth()->user()->name}} وارد شده‌اید. </p>
  @endauth
  @guest()
   <p>برای ارسال دیدگاه ابتدا <b><a href="{{route('front.login-register')}}">وارد</a></b> شوید.</p>

  @endguest
  <form action="">
   <div class="mb-3">
    <label for="exampleFormControlTextarea1"
           class="form-label">دیدگاه </label>
    <textarea class="form-control"
              id="exampleFormControlTextarea1"
              rows="6"></textarea>
   </div>
   <button class="btn btn-primary">ارسال دیدگاه</button>
  </form>
 </div>
</div>