<section class="blog-block m-0 p-4">
 <div class="container">
  <div class="section-title clearfix">
   <h2>{{$title}}</h2>
  </div>
  <div id="carouselExampleControls{{$id}}"
       class="carousel slide"
       data-bs-ride="carousel">
   <div class="carousel-inner">
    @foreach($ads as $group)
     <div class="carousel-item
    @if($loop->first)active
@endif">
      <div class="row row-cols-1 row-cols-md-3 row-cols-md-4 g-3 flex-nowrap flex-md-wrap">
       @foreach($group as $ad)
        <livewire:front.ad.card :ad="$ad"/>
       @endforeach
      </div>
     </div>

    @endforeach
   </div>
   <button class="carousel-control-prev ads-prev"
           type="button"
           data-bs-target="#carouselExampleControls{{$id}}"
           data-bs-slide="prev">
    <span class="carousel-control-prev-icon"
          aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
   </button>
   <button class="carousel-control-next ads-next"
           type="button"
           data-bs-target="#carouselExampleControls{{$id}}"
           data-bs-slide="next">
    <span class="carousel-control-next-icon"
          aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
   </button>
  </div>
 </div>
</section>