<div class="col">
 <div class="card">
  @if(count($ad->media))
   <img src="{{$ad->media[0]}}"
        class="card-img-top"
        alt="...">
  @endif
  <span class="favorite_7636 bookmark"
        data-toggle="tooltip"
        data-placement="top"
        title=""></span>
  <span class="ad_visit">{{$ad->views}} بازدید</span>
  <h4 class="location">
   <a href="">{{$ad?->state?->name}}</a>
  </h4>
  <span class="price"><span>تماس بگیرید</span></span>
  <div class="card-body card-bg">
   <h5 class="card-title">{{$ad->title}}</h5>
   <div class="meta">
    <figure>
     <i class="fa fa-calendar-o"></i>{{jdate($ad->created_at)->ago()}}
    </figure>
    <figure>
     <i class="fa fa-folder-open-o"></i><a href="">انجام
      امور خرید و فروش و اجاره</a>
    </figure>
   </div>
  </div>
 </div>
</div>