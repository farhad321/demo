<div class="main-navigation">
 <div class="container ">
  <nav class="navbar navbar-expand-lg navbar-light border-0">
   @include('front.layouts.header.menu')
  </nav>
 </div>
 <p class="d-flex justify-content-between col-12 border-top container">
  <span>
   <a href="">خانه</a>
   @switch(request()->route()->getName())
    @case('front.rules')
    / قوانین و مقررات
    @break
    @case('front.contact-us')
    / تماس با ما
    @break
    @case('front.ad.category.index.first.page')
    @case('front.ad.category.index')
    @php
     $class=new App\Services\AdCategory\AdCategory();
    @endphp
    @foreach($class->categoryAddress(request()->category_page) as $category)
     @if($loop->last)
      @if(request()->page && request()->page >1)
       /  <a href="{{route('front.ad.category.index.first.page',$category->slug)}}"> {{$category->name}}</a> /
       برگه {{request()->page}}

      @else
       /  {{$category->name}}
      @endif
     @else
      / <a href="{{route('front.ad.category.index.first.page',$category->slug)}}"> {{$category->name}}</a>
     @endif
    @endforeach
    @break
    @case('front.ad.index')
    @if(request()->page && request()->page >1)
     <a href="{{route('front.ad.index')}}">/ آگهی ها</a>
     / برگه {{request()->page}}
    @else
     / آگهی ها
    @endif
    @break
    @case('front.ad.show')
    @php
     $class=new App\Services\AdCategory\AdCategory();
    @endphp
    @foreach($class->categoryAddress(request()->ad->mainCategory[0]) as $category)
     / <a href="{{route('front.ad.category.index.first.page',$category->slug)}}"> {{$category->name}}</a>
    @endforeach
    / {{request()->ad->title}}
    @break
    @case('front.blog.show')
    / <a href="{{route('front.blog.category.blog.index.first.page')}}">وبلاگ</a>
    / {{request()->post->title}}
    @break
   @endswitch
  </span>
  <button class="btn btn-primary"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapseExample"
          aria-expanded="false"
          aria-controls="collapseExample">
   <i class="far fa-search text-white"></i>
  </button>
 </p>
 <div class="collapse"
      id="collapseExample">
  @livewire('front.ad.search')
 </div>
 <div class="container p-0 pt-5
            pb-5">
  {{--  <h3>آخرین آگهی‌ها</h3>--}}
  @switch(request()->route()->getName())
   @case('front.rules')
   <h3><a href="{{route('front.rules')}}"> قوانین و مقررات</a></h3>
   @break
   @case('front.contact-us')
   <h3><a href="{{route('front.contact-us')}}">تماس با ما</a></h3>
   @break
   @case('front.ad.category.index.first.page')
   @case('front.ad.category.index')
   <h3>
    {{ request()->category_page->name .' |'}}
    @if(request()->page &&  request()->page>1)
     صفحه {{request()->page}} از {{request()->total_page}} |
    @endif
    {{' کیوسک | ثبت اگهی رایگان بیزینس های ایرانی کانادا | تورنتو | ونکوور | مونترال'}}
   </h3>
   @break
   @case('front.ad.show')
   <h3><a href="{{route('front.ad.show',request()->ad->slug)}}">{{request()->ad->title}}</a></h3>


   @break
   @case('front.blog.show')
   <h3><a href="{{route('front.blog.category.blog.index.first.page')}}">{{request()->post->title}}</a></h3>
   @break
  @endswitch
 </div>
 <div class="d-none d-lg-block">eqhtqt</div>
 <div class="background">
  <div class="background-image original-size"
       style="background-image: url({{asset('images/hero-background-icons (1).jpg')}});">
   <img src="{{asset('./images/hero-background-icons (1).jpg')}}"
        alt="کیوسک | نیازمندی های ایرانیان کانادا | آگهی رایگان نیازمندی ها">
  </div>
 </div>
</div>
