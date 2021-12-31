@extends('base')

@section('header')

@endsection
@section('content')



 <h1>{{$ad->title}}</h1>

 <div class="row align-items-start bg-info mt-4">
  <div class="col-1 ">متن</div>
  <div class="col">
   {!! $ad->content !!}
  </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">خلاصه</div>
  <div class="col">
   {{"$ad->excerpt"}}   </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">ایجاد کننده</div>
  <div class="col">
   {{$ad->user?->name}}   </div>
  <div class="col-1 "> تلفن</div>
  <div class="col">
   {{$ad->user?->phone}}   </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">استان</div>
  <div class="col">
   {{$ad->state?->name}}   </div>
  <div class="col-1 "> شهر</div>
  <div class="col">
   {{$ad->city?->name}}   </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">بازدید</div>
  <div class="col">
   {{$ad->views}}   </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">دسته بندی ها</div>
  <div class="col">
   @foreach($ad->categories as $category)
    <a href="{{route('index-ads-category',[$category->slug])}}">{{$category->name}}</a>
   @endforeach
  </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">کلمات کلیدی</div>
  <div class="col">
   @foreach($ad->tags as $tag)
    <a href="{{route('index-ads-tag',[$tag->slug])}}">{{$tag->name}}</a><br>
   @endforeach
  </div>
 </div>
@endsection