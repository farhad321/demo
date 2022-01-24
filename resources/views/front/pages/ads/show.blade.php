@extends('front.base')
@section('seo')
 <title>{{$ad->seo_title}}</title>
 <meta name="description"
       content="{{$ad->seo_description}}">
@endsection
@section('content')
 <livewire:front.ad.show :ad="$ad"/>
@endsection

@section('script')

 <script>
   $(document).ready(function () {
     Livewire.emit('viewed')
   })
 </script>
@endsection