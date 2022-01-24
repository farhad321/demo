@extends('front.base')
@section('seo')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content')
 <section class=" blog-block m-0">
  <div class="container p-4">
   <section class="row justify-content-between">
    <div class="col-12 col-md-3">
     <div class="shadow">
      <div class="top-nav-head">
       @php
        $user=auth()->user();
       @endphp
       <img src="{{$user?->getFirstMedia('profile')?->getUrl('avatar')}}"
            alt="{{Str::mask($user->phone,'*',3,4)}}">
       <h3>{{Str::mask($user->phone,'*',3,4)}}</h3>
      </div>
      <ul class="profile">
       <li><strong><i class="fa fa-phone"
                      aria-hidden="true"></i> شماره تماس: </strong>
        <p><a href="tel:{{$user->phone}}">{{$user->phone}}</a></p>
       </li>
       <li><strong><i class="fa fa-envelope-open"
                      aria-hidden="true"></i> ایمیل: </strong>
        <p><a href="mailto:{{$user->email}}">{{$user->email}}</a></p>
       </li>
      </ul>
     </div>
    </div>
    <div class="col-12 col-md-8">
     <p>متأسفیم ، آگهی موجود نیست . </p>
    </div>
   </section>
   <p>بازدیدها: 719</p>
  </div>
 </section>
@endsection