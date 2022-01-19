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
         alt="...">
   </a>

  @endif
  <span class="favorite_7636 bookmark @if($isFavorite)btn-primary
@elsebtn-danger
@endif"
        data-toggle="tooltip"
        data-placement="top"
        wire:click="favorite"
        title=""></span>
  @if($local)
   <script !src="">
     document.cookie = 'favorites=@json($favorits); expires=Thu, 18 Dec 2045 12:00:00 UTC; path=/';
   </script>
  @endif
  <span class="ad_visit">{{$ad['views']}} بازدید</span>
  @if($ad['state'])
   <h4 class="location">
    <a href="">{{$ad['state']['name']}}</a>
   </h4>
  @endif
  <span class="price"><span>تماس بگیرید</span></span>
  <div class="card-body card-bg">
   <a href="{{route('front.ad.show',['slug'=>$ad['slug']])}}">
    <h5 class="card-title">{{$ad['title']}}</h5>
   </a>
   <div class="meta">
    <figure>
     <i class="fa fa-calendar-o"></i> {{jdate($ad['created_at'])->ago()}}
    </figure>
    @if(count($ad['main_category']))
     <figure>
      <i class="fa fa-folder-open-o"></i><a href="">{{$ad['main_category'][0]['name']}}</a>
     </figure>
    @endif
   </div>
  </div>
 </div>
</div>