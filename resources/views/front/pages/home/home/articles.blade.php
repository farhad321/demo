<section class="index-blog blog-block pt-5 pb-5">
 <div class="container">
  <div class="section-title clearfix">
   <h2>{{$title}}</h2>
  </div>
  <div id="carouselExampleControls"
       class="carousel slide"
       data-bs-ride="carousel">
   <div class="carousel-inner">
    @foreach($posts as $key=>$group)



     <div class="carousel-item @if($loop->first) active @endif">
      <div class="row row-cols-1 row-cols-md-3 {{$css}}  g-3 flex-nowrap flex-md-wrap">
       @foreach($group as $key=>$post)
        @include('front.pages.blog.card',['post'=>$post])
       @endforeach
      </div>
     </div>







    @endforeach
   </div>
   <button class="carousel-control-prev prev"
           type="button"
           data-bs-target="#carouselExampleControls"
           data-bs-slide="prev">
    <span class="carousel-control-prev-icon"
          aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
   </button>
   <button class="carousel-control-next next"
           type="button"
           data-bs-target="#carouselExampleControls"
           data-bs-slide="next">
    <span class="carousel-control-next-icon"
          aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
   </button>
  </div>
 </div>
</section>