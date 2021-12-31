@extends('base')

@section('header')

@endsection
@section('content')



 <h1>{{$post->title}}</h1>

 <div class="row align-items-start bg-info mt-4">
  <div class="col-1 ">متن</div>
  <div class="col">
   {!! $post->content !!}
  </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">خلاصه</div>
  <div class="col">
   {{"$post->excerpt"}}   </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">ایجاد کننده</div>
  <div class="col">
   {{$post->user?->name}}   </div>
  <div class="col-1 "> تلفن</div>
  <div class="col">
   {{$post->user?->phone}}   </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">استان</div>
  <div class="col">
   {{$post->state?->name}}   </div>
  <div class="col-1 "> شهر</div>
  <div class="col">
   {{$post->city?->name}}   </div>
 </div>
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">بازدید</div>
  <div class="col">
   {{$post->views}}   </div>
 </div>
 {{-- <div class="row align-items-start bg-light mt-4">--}}
 {{--  <div class="col-1 ">دسته بندی ها</div>--}}
 {{--  <div class="col">--}}
 {{--   @foreach($post->categories as $category)--}}
 {{--    <a href="{{route('index-posts-category',[$category->slug])}}">{{$category->name}}</a>--}}
 {{--   @endforeach--}}
 {{--  </div>--}}
 {{-- </div>--}}
 <div class="row align-items-start bg-light mt-4">
  <div class="col-1 ">کلمات کلیدی</div>
  <div class="col">
   @foreach($post->tags as $tag)
    <a href="{{route('post-tags',[$tag->slug])}}">{{$tag->name}}</a><br>
   @endforeach
  </div>
 </div>
@endsection