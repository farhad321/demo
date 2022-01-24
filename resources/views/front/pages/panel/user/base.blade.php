@extends('front.base')

@section('content')
 <section class=" blog-block m-0 pt-5">
  <div class="container ">
   {{--   <p>بازدیدها: 719</p>--}}
   <section class="row justify-content-between">
    <div class="col-12 col-md-3">
     <ul class="list-group">
      <li class="list-group-item">
       <a href="{{route('front.panel.user.ad.index')}}"
          class="nav-link {{!request()->routeIs('front.panel.user.ad.index')?:'active-link-primary'}}">
        <i class="fas fa-bullhorn m-2"></i>آگهی‌های من
        @if(request()->routeIs('front.panel.user.ad.index'))
         <i class="far fa-chevron-left"></i>
        @endif
       </a>
      </li>
      <li class="list-group-item">
       <a href="{{route('front.panel.user.favorite.index')}}"
          class="nav-link {{!request()->routeIs('front.panel.user.favorite.index')?:'active-link-primary'}}"><i class="fa fa-bookmark m-2"></i>علاقه‌مندی
        ها
        @if(request()->routeIs('front.panel.user.favorite.index'))
         <i class="far fa-chevron-left"></i>
        @endif</a>
      </li>
      <li class="list-group-item">
       <a href=""
          class="nav-link"><i class="far fa-credit-card m-2"></i>پرداخت‌های
        من
        @if(false)
         <i class="far fa-chevron-left"></i>
        @endif
       </a>
      </li>
      <li class="list-group-item">
       <a href="{{route('front.panel.user.profile.edit')}}"
          class="nav-link {{!request()->routeIs('front.panel.user.profile.edit')?:'active-link-primary'}}"><i class="fas fa-edit m-2"></i>اطلاعات
        کاربری
        @if(request()->routeIs('front.panel.user.profile.edit'))
         <i class="far fa-chevron-left"></i>
        @endif
       </a>
      </li>
      <li class="list-group-item">
       <a href="{{route('front.panel.user.profile.show')}}"
          class="nav-link {{!request()->routeIs('front.panel.user.profile.show')?:'active-link-primary'}}"><i class="fas fa-edit m-2"></i>نمایش
        پروفایل
        @if(request()->routeIs('front.panel.user.profile.show'))
         <i class="far fa-chevron-left"></i>
        @endif
       </a>
      </li>
      @livewire('front.panel.user.panel-logout')
      {{--      <li class="list-group-item"><i class="fa fa-bookmark m-2"></i>علاقه‌مندی ها</li>--}}
      {{--      <li class="list-group-item"><i class="far fa-credit-card m-2"></i>پرداخت‌های--}}
      {{--       من<i class="far fa-chevron-left"></i></li>--}}
      {{--      <li class="list-group-item"><i class="fas fa-edit m-2"></i>اطلاعات کاربری</li>--}}
      {{--      <li class="list-group-item"><i class="fa fa-sign-in m-2"></i> خروج</li>--}}
     </ul>
    </div>
    <div class="col-12 col-md-8">
     @yield('user_panel_content')
    </div>
   </section>
  </div>
 </section>
@endsection