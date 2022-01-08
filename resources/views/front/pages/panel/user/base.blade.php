@extends('front.base')

@section('content')
 <section class=" blog-block m-0 p-4">
  <div class="container border-0 border-bottom p-5">
   <p>بازدیدها: 719</p>
   <section class="row justify-content-between">
    <div class="col-12 col-md-3">
     <ul class="list-group">
      <li class="list-group-item">آگهی‌های من</li>
      <li class="list-group-item">علاقه‌مندی ها</li>
      <li class="list-group-item">پرداخت‌های من</li>
      <li class="list-group-item">اطلاعات کاربری</li>
      <li class="list-group-item">خروج</li>
     </ul>
    </div>
    @yield('user_panel_content')
   </section>
  </div>
 </section>
@endsection