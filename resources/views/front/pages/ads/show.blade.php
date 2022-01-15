@extends('front.base')
@section('seo')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content')
 <livewire:front.ad.show :ad="$ad"/>
@endsection

@section('script')


@endsection