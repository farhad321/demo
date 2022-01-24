<div class="col
@if(request()->routeIs('front.home'))more-content
@endif">
 <div class="card">
  @if(count($ad['media']))
   @php
    foreach ($ad['media'] as $item){
if ($item['collection_name'] ==='SpecialImage'){
 $m=new \Spatie\MediaLibrary\MediaCollections\Models\Media($item);
    $src=$m->getUrl('thumb');
}
}
   @endphp
   <a href="{{route('front.ad.show',['slug'=>$ad['slug']])}}">
    <img src="{{$src}}"
         class="card-img-top "
         title="{{$ad['title']}}"
         alt="...">
   </a>

  @endif
  <span class=" bookmark @if($isFavorite)btn-primary
@elsebtn-danger
@endif"
        data-toggle="tooltip"
        data-placement="top"
        wire:click="favorite"
        title=""><i class="far fa-bookmark text-white fs-6"></i></span>
  @if($local)
   <script !src="">
     document.cookie = 'favorites=@json($favorits); expires=Thu, 18 Dec 2045 12:00:00 UTC; path=/';
   </script>
  @endif
  <span class="ad_visit">{{$ad['views']}} بازدید</span>
  @if($ad['state'])
   <h4 class="location">
    <a class=""
       href="">{{$ad['state']['name']}}</a>
   </h4>
  @endif
  <span class="price"><span>تماس بگیرید</span></span>
  <div class="card-body   pt-2 pb-1 card-bg">
   <div class="meta">
    <a href="{{route('front.ad.show',['slug'=>$ad['slug']])}}">
     <h5 class="card-title text-dark"
         title="{{$ad['title']}}">{{$ad['title']}}</h5>
    </a>
    <figure>
     <i class="fa fa-calendar-o"></i> {{jdate($ad['created_at'])->ago()}}
    </figure>
    @if(count($ad['main_category']))
     <figure>
      <i class="fa fa-folder-open"></i><a href=""> {{$ad['main_category'][0]['name']}}</a>
     </figure>
    @endif
   </div>
  </div>
 </div>
</div>