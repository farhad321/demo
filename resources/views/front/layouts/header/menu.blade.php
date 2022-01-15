<a class="navbar-brand"
   href="{{route('front.home')}}">
 <img src="{{asset('images/4611.png')}}">
</a>
<button class="navbar-toggler border-0"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbar"
        aria-controls="navbar"
        aria-expanded="false"
        aria-label="Toggle navigation">
 <span class="navbar-toggler-icon bg-white"></span>
</button><!-- navigation -->
<div class="navbar navbar-expand-lg navbar-light navigation collapse navbar-collapse"
     id="navbar">
 <ul class="navbar-nav">
  <li class="nav-item">
   <a href="{{route('front.home')}}"
      class="nav-link {{!request()->routeIs('front.home')?:'active-link-primary'}}">صفحه اصلی</a>
  </li>
  <li class="nav-item">
   <a href="{{route('front.blog.category.blog.index')}}"
      class="nav-link {{!request()->routeIs('front.blog.category.blog.index')?:'active-link-primary'}} ">وبلاگ</a>
  </li>
  <li class="nav-item">
   <a href="{{route('front.blog.category.news.index.first.page')}}"
      class="nav-link {{!request()->routeIs('front.blog.category.news.index*')?:'active-link-primary'}}">اخبار</a>
  </li>
  @include('front.layouts.header.category-menu.category-menu')
  {{--  @include('front.layouts.header.category-menu.category-menu2')--}}
  <li class="nav-item">
   <a href="{{route('front.rules')}}"
      class="nav-link {{!request()->routeIs('front.rules')?:'active-link-primary'}}">قوانین و مقررات</a>
  </li>
  <li class="nav-item">
   <a href="{{route('front.contact-us')}}"
      class="nav-link {{!request()->routeIs('front.contact-us')?:'active-link-primary'}}">تماس با ما</a>
  </li>
 </ul>
</div><!-- buttons -->
<ol class="nav-btn">
 <li class="top-category-btn">
  <button type="button"
          class="btn btn-primary text-caps btn-rounded btn-framed"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasRight"
          aria-controls="offcanvasRight">
   <i class="fa fa-align-justify"
      aria-hidden="true"></i>
   دسته‌بندی‌ها
  </button>
  <!--  -->
 </li>
 <li class="nav-item submit_ad">
  <a href="{{route('front.ad.create')}}"
     class="btn btn-primary text-caps btn-rounded btn-framed">
   <i class="fa fa-plus"
      aria-hidden="true"></i> ثبت آگهی </a>
 </li>
</ol>