@extends('front.base')
@section('seo')
 {{-- <title>{{$ad->seo_title}}</title>--}}
 {{-- <meta name="description"--}}
 {{--       content="{{$ad->seo_description}}">--}}
@endsection
@section('content')
 <section class=" blog-block m-0 p-4  pt-5">
  <div class="container border-0 border-bottom  pt-5">
   <livewire:front.ad.advance-search/>
   <livewire:front.ad.search.list-search :ads="$ads"
                                         :urls="$urls"/>
  </div>
 </section>

@endsection