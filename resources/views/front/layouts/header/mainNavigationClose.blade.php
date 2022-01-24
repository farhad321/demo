<div class="main-navigation">
 <div class="container ">
  <nav class="navbar navbar-expand-lg navbar-light border-0">
   @include('front.layouts.header.menu')
  </nav>
 </div>
 <p class="d-flex justify-content-between col-12 border-top container colpas-button">
  <span class="mt-2 text-title">
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
    @case('front.ad.tag.index.first.page')
    /
    محصولات برچسب خورده “ {{request()->tag_page->name}}”
    @break
    @case('front.ad.tag.index')
    /  <a href="{{route('front.ad.tag.index.first.page',request()->tag_page->slug)}}">
     محصولات برچسب خورده “ {{request()->tag_page->name}}”
    </a> /
    برگه {{request()->page}}

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
   @if(count(request()->ad->mainCategory))
    @foreach($class->categoryAddress(request()->ad->mainCategory[0]) as $category)
     / <a href="{{route('front.ad.category.index.first.page',$category->slug)}}"> {{$category->name}}</a>
    @endforeach
    @endif
    / {{request()->ad->title}}
    @break
    @case('front.blog.show')
    / <a href="{{route('front.blog.category.blog.index.first.page')}}">وبلاگ</a>
    / {{request()->post->title}}
    @break
   @endswitch
  </span>
  <button class="btn btn-primary search-icon-btn"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapseExample"
          aria-expanded="false"
          aria-controls="collapseExample">
   <i class="far fa-search text-white"></i>
   <i class="fas fa-times text-white"></i>
  </button>
 </p>
 <div class="collapse"
      id="collapseExample">
  @livewire('front.ad.search')
 </div>
 <div class="container p-0 pt-5
            pb-5  flex-direction">
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

   <div class="d-flex justify-content-between pt-2">
    <span class="text-secondary"><i class="fal fa-map-marker-alt m-1"></i>
     @if(request()->ad?->state)
      <a href="{{route('front.ad.category.city.index.first.page',request()->ad?->state->slug)}}">
       {{request()->ad?->state->name}}
      </a>
     @elseif(request()->ad?->state && request()->ad?->city)
      <i class="fa fa-angle-left" aria-hidden="true"></i>
     @elseif( request()->ad?->city)
      <a href="{{route('front.ad.category.city.index.first.page',request()->ad?->city->slug)}}">
       {{request()->ad?->city->name}}
      </a>
     @endif
    </span>
    <h4 class="text-secondary"><a href=""
                                  class="text-secondary">تماس بگیرید</a></h4>
   </div>
   @break
   @case('front.blog.show')
   <h3><a href="{{route('front.blog.category.blog.index.first.page')}}">{{request()->post->title}}</a></h3>
   <div class="d-flex justify-content-between pt-2">
    <div class="text-secondary d-flex details align-items-center">
     <h5><i class="far fa-bookmark"></i>
      {{request()->post->category->name}}
     </h5>
     <span class="ms-4">
      <i class="fa fa-calendar-o"></i> {{jdate(request()->post->created_at)->ago()}}</span>
     </span><span><i class="fa fa-pie-chart"
                     aria-hidden="true"></i> {{request()->post->views}} بازدید</span>
    </div>
   </div>
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
