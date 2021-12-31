@extends('base')

@section('header')

@endsection
@section('content')



 <h1>کلمه کلیدی {{$tag->name}}</h1>
 <table class="table">
  <thead>
  <tr>
   <th scope="col">#</th>
   <th scope="col">عنوان</th>
   <th scope="col">دیدن</th>
  </tr>
  </thead>
  <tbody>
  @foreach($ads as $ad)
   <tr>
    <th scope="row">{{$loop->iteration}}</th>
    <td>{{$ad->title}}</td>
    <td><a href="{{route('ad',[$ad->slug])}}">دیدن</a></td>
   </tr>
  @endforeach
  </tbody>
 </table>

 @include('paginate',['urls'=>$urls])
@endsection