@extends('front.base')
@section('seo')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content')
 <section class=" blog-block m-0">
  <div class="container">
   <p class="p-3 ps-5">بازدیدها: 719</p>
   <div class="row">
    <div class="col-12 col-md">
     <div class="section-title clearfix">
      <h2>ورود</h2>
     </div>
     @livewire('login')
    </div>
    <div class="col-12 col-md">
     <div class="section-title clearfix">
      <h2>ثبت نام</h2>
     </div>
     @livewire('register')
    </div>
   </div>
  </div>
 </section>


@endsection