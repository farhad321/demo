<div class="main-navigation">
 <div class="container">
  <nav class="navbar navbar-expand-lg navbar-light">
   @include('front.layouts.header.menu')
  </nav>
  @switch(request()->route()->getName())
   @case('front.home')
   @if(request()->query('s') || request()->query('city_categories') || request()->query('category'))
    <p class="d-flex justify-content-between col-12  container">
     <span>
      <a href="{{route('front.home')}}">خانه</a> /
      <a href="{{route('front.ad.index')}}"> آگهی‌ها</a>
      / نتیجه جستجو برای “{{request()->s}}”
     </span>
    </p>
   @endif
   @break
  @endswitch
 </div>
 <div class="page-title">
  <div class="container">
   <div class="text-center website_header_slogan">
    کیوسک | نیازمندی های ایرانیان کانادا | آگهی رایگان نیازمندی ها
   </div>
  </div>
 </div>
 @livewire('front.ad.search')
 <div class="d-none d-lg-block">eqhtqt</div>
 <div class="background">
  <div class="background-image original-size"
       style="background-image: url({{asset('images/hero-background-icons (1).jpg')}});">
   <img src="{{asset('./images/hero-background-icons (1).jpg')}}"
        alt="کیوسک | نیازمندی های ایرانیان کانادا | آگهی رایگان نیازمندی ها">
  </div>
 </div>
</div>@dump(request()->route()->action)