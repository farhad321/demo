@include('front.layouts.header.header-black')
@if(request()->routeIs('front.blog.category.news.index.first.page','front.blog.category.news.index','front.blog.category.blog.index','front.home'))
 @include('front.layouts.header.mainNavigationOpen')
@else
 @include('front.layouts.header.mainNavigationClose')
@endif
<div class="background">
 <div class="background-image original-size"
      style="background-image: url({{asset('images/hero-background-icons (1).jpg')}});">
  <img src="{{asset('./images/hero-background-icons (1).jpg')}}"
       alt="کیوسک | نیازمندی های ایرانیان کانادا | آگهی رایگان نیازمندی ها">
 </div>
</div>
