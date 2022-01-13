@extends('front.base')
@section('seo')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content')
 <section class=" blog-block m-0 p-4">
  <div class="container border-0 border-bottom">
   <div class="accordion bg-transparent filter"
        id="accordionExample">
    <div class="accordion-item bg-transparent position-relative">
     <h2 class="accordion-header bg-transparent"
         id="headingOne">
      <button class="accordion-button bg-transparent right-apprance"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseTen"
              aria-expanded="true"
              aria-controls="collapseTen">
       جستجو پیشرفته
      </button>
     </h2>
     <select class="form-select absolot">
      <option selected>Open this select menu</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
     </select>
     <div id="collapseTen"
          class="accordion-collapse collapse bg-transparent"
          aria-labelledby="headingTen"
          data-bs-parent="#accordionExample">
      <div class="accordion-body">
       <div class="row g-2 align-items-center">
        <div class="col-md-3">
         <input type="checkbox">
         <label for="">اگهی ویژه</label>
        </div>
        <form class="row g-3 col-md-9">
         <div class="col-md-4">
          <label class="form-label"
                 for="specificSizeSelect">Preference</label>
          <select class="form-select"
                  id="specificSizeSelect">
           <option selected>Choose...</option>
           <option value="1">One</option>
           <option value="2">Two</option>
           <option value="3">Three</option>
          </select>
         </div>
         <div class="col-md-4">
          <label for="inputEmail4"
                 class="form-label">Email</label>
          <input type="email"
                 class="form-control"
                 id="inputEmail4">
         </div>
         <div class="col-md-4">
          <label for="inputPassword4"
                 class="form-label">Password</label>
          <input type="password"
                 class="form-control"
                 id="inputPassword4">
         </div>
        </form>
       </div>
       <div>
        <button class="btn btn-primary mt-3 mt-md-0">جستجو</button>
       </div>
      </div>
     </div>
    </div>
   </div>
   <!--  -->
   <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3 mt-5">
    @forelse ($ads as $ad)
     <livewire:front.ad.card :ad="$ad"
                             :wire:key="$ad['id']"/>
     {{--   {{$ad['id']}}--}}
     <br>
    @empty
     <div class="border-blue">
      <p>هیچ آگهی هنوز ثبت نشده است.</p>
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
        <li class="page-item rounded @if($url['active']) active @endif@if($url['disabled'] )disabled
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