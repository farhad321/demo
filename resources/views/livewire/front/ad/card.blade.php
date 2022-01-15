<div class="col
@if(request()->routeIs('front.home'))more-content
@endif">
 <div class="card">
  @if(count($ad->media))
   <a href="{{route('front.ad.show',['slug'=>$ad->slug])}}">
    <img src="{{$ad->media->where('collection_name','SpecialImage')?->first()?->getUrl('thumb')}}"
         class="card-img-top "
         alt="...">
   </a>

  @endif
  <span class="favorite_7636 bookmark   @if($isFavorite)btn-primary
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
  <span class="ad_visit">{{$ad->views}} بازدید</span>
  @if($ad?->state)
   <h4 class="location">
    <a href="">{{$ad?->state?->name}}</a>
   </h4>
  @endif
  <span class="price"><span>تماس بگیرید</span></span>
  <div class="card-body card-bg">
   <h5 class="card-title">{{$ad->title}}</h5>
   {{--   <div id="app_basic">--}}
   {{-- <div
      id="aa"

      @input="dd"
         v-bind:title="timestamp"
         class="experiment-block"
         @click="ee"
         :key="{{$ad->id}}"
         wire:model="ddd">@{{ message }}
    </div>--}}
   {{--    <input type="text"--}}
   {{--           wire:model="rrr.aa">--}}
   {{--    <input type="text"--}}
   {{--           wire:model="ad.title">--}}
   {{--   </div>--}}
   <div class="meta">
    <figure>
     <i class="fa fa-calendar-o"></i>{{jdate($ad->created_at)->ago()}}
    </figure>
    @if($ad?->mainCategory->count())
     <figure>
      <i class="fa fa-folder-open-o"></i><a href="">{{$ad?->mainCategory->first()->name}}</a>
     </figure>
    @endif
   </div>
  </div>
 </div>
</div>