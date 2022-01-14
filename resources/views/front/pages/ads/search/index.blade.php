@extends('front.base')
@section('seo')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content')
 <section class=" blog-block m-0 p-4">
  <div class="container border-0 border-bottom">
   <livewire:front.ad.advance-search/>
   <livewire:front.ad.search.list-search :ads="$ads"
                                         :urls="$urls"/>
  </div>
 </section>

@endsection