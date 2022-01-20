@extends('front.pages.blog.base')
@section('seo.blog')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content.blog')
 <livewire:front.blog.show :post="$post"/>
@endsection

@section('script.blog')

 <script>
   $(document).ready(function () {
     Livewire.emit('viewed')
   })
 </script>
@endsection