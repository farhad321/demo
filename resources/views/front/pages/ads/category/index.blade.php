@extends('front.base')
@section('seo')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content')
 <section class=" blog-block m-0 p-4">
  <div class="container border-0 border-bottom">
  @include('front.pages.ads.layouts.advanceSearch')
  <!--  -->
   <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3 mt-5">
    @forelse ($ads as $ad)
     <livewire:front.ad.card :ad="$ad"
                             :wire:key="$ad['id']"/>
     {{--   {{$ad['id']}}--}}
     <br>
    @empty
     <div class="border-blue w-100">
      <p>هیچ آگهی پیدا نشده است.</p>
     </div>
    @endforelse
    <div class="mt-3 w-100 d-flex justify-content-center">
     <nav aria-label="Page navigation example">
      <ul class="pagination">
       {{-- <li class="page-item">
         <a class="page-link bg-transparent"
            href="#"
            aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
         </a>
        </li>
        <li class="page-item "><a class="page-link bg-transparent"
                                  href="#">1</a></li>
        <li class="page-item"><a class="page-link bg-transparent"
                                 href="#">2</a></li>
        <li class="page-item"><a class="page-link bg-transparent"
                                 href="#">3</a></li>
        <li class="page-item">
         <a class="page-link bg-transparent"
            href="#"
            aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
         </a>
        </li>--}}
       @foreach($urls as $url)
        <li class="page-item rounded @if($url['active']) active @endif  @if($url['disabled'] )disabled
@endif"><a class="page-link  bg-transparent"
           href="{{$url['url']}}">{!! $url['label'] !!}</a></li>

        {{--        <li class="page-item">--}}
        {{--         <a class="page-link bg-transparent"--}}
        {{--            href="#"--}}
        {{--            aria-label="Next">--}}
        {{--          <span aria-hidden="true">&raquo;</span>--}}
        {{--         </a>--}}
        {{--        </li>--}}
       @endforeach
      </ul>
     </nav>
    </div>
   </div>
  </div>
 </section>

@endsection