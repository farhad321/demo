@extends('base')

@section('header')

@endsection
@section('content')



 <h1>وبلاگ</h1>
 <table class="table">
  <thead>
  <tr>
   <th scope="col">#</th>
   <th scope="col"> عنوان</th>
   <th scope="col">دیدن</th>
  </tr>
  </thead>
  <tbody>
  @foreach($posts as $post)
   <tr>
    <th scope="row">{{$loop->iteration}}</th>
    <td>{{$post->title}}</td>
    @php

     $t=jdate($post->created_at);

    @endphp
    <td><a href="{{route('blog-post',[$t->getYear(),$t->getMonth(),$t->getDay(),$post->slug])}}">دیدن</a></td>
   </tr>
  @endforeach
  </tbody>
 </table>

 @include('paginate',['urls'=>$urls])
@endsection