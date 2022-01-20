<div class="bg-dark">
 <div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-dark p-0">
   <div class="container-fluid">
    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false"
            aria-label="Toggle navigation">
     <span class=""><i class="fas fa-bars text-white"></i></span>
    </button>
    <div class="collapse navbar-collapse"
         id="navbarNavDropdown">
     <ul class="navbar-nav pt-1 pb-1">
      <li class="nav-item pt-1 pb-1">
       @auth
        <a href="#"
           class="nav-link text-white font">
         <i class="fa fa-user text-secondary"></i> خوش آمدید {{auth()->user()->name}} </a>
        <ul class="inner-ul p-0 profile">
         <li class="nav-item"><a href="{{route('front.panel.user.ad.index')}}">اگهی های من</a></li>
         <li class="nav-item"><a href="{{route('front.panel.user.favorite.index')}}">علاقه مندی ها</a></li>
         <li class="nav-item"><a href="{{route('front.panel.user.payment.index')}}">پرداخت های من</a></li>
         <li class="nav-item"><a href="{{route('front.panel.user.profile.edit')}}">اطلاعات کاربری</a></li>
         <li class="nav-item"><a href="{{route('front.panel.user.profile.show')}}">نمایش پروقایل</a></li>
         @livewire('logout')
        </ul>
       @endauth
       @guest
        <a href="{{route('front.panel.user.ad.index')}}"
           class="nav-link active text-white font">
         <i class="fa fa-sign-in text-secondary"></i> ورود / ثبت نام </a>
       @endguest
      </li>
      <li class="nav-item">
       <a href=""
          class="nav-link text-white font">
        <i class="fa fa-bookmark text-secondary"></i> علاقه‌مندی ها </a>
      </li>
     </ul>
    </div>
   </div>
  </nav>
 </div>
</div><!-- main navigation -->