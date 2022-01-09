@extends('front.base')
@section('seo')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content')

 {{-- @include('front.pages.home.home.last-ads')--}}
 <livewire:front.ad.last-ads/>
 @include('front.pages.home.home.articles')
@endsection