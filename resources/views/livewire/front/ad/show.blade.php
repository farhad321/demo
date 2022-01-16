<section class=" blog-block m-0 p-4">
 <div class="container border-0 border-bottom">
  <div class="row">
   <div class="col-12 col-md-7">
    <img src="{{$ad->getFirstMediaUrl('SpecialImage')}}"
         class="img-fluid"
         alt="{{$ad->title}}">
    <div class="accordion accordion-flush mt-3 rounded"
         id="accordionFlushExample">
     <div class="accordion-item">
      <h2 class="accordion-header"
          id="flush-headingOne">
       <button class="accordion-button pb-0 ps-0 collapsed border-bottom"
               type="button"
               data-bs-toggle="collapse"
               data-bs-target="#flush-collapseOne"
               aria-expanded="false"
               aria-controls="flush-collapseOne">
        <h4 class="heading-border">توضیحات آگهی</h4>
       </button>
      </h2>
      <div id="flush-collapseOne"
           class="accordion-collapse collapse show"
           aria-labelledby="flush-headingOne"
           data-bs-parent="#accordionFlushExample">
       <div class="accordion-body">
        {!! nl2br($ad->content) !!}
       </div>
      </div>
     </div>
    </div>
    <section class="box mt-4 mb-4">
     <img width="69"
          height="115"
          src="../images/4611.png"
          class=""
          alt="">
    </section>
    <div class="accordion accordion-flush mt-3 mb-4 rounded"
         id="accordionFlushExample">
     <div class="accordion-item">
      <h2 class="accordion-header"
          id="flush-headingOne">
       <button class="accordion-button collapsed border-bottom pb-0 ps-0"
               type="button"
               data-bs-toggle="collapse"
               data-bs-target="#flush-collapseTwo"
               aria-expanded="false"
               aria-controls="flush-collapseTwo">
        <h4 class="heading-border">دیدگاه خود را بیان کنید</h4>
       </button>
      </h2>
      <div id="flush-collapseTwo"
           class="accordion-collapse collapse show"
           aria-labelledby="flush-headingOne"
           data-bs-parent="#accordionFlushExample">
       <div class="accordion-body">
        <div>
         <p>هیچ دیدگاهی برای این محصول نوشته نشده است.</p>
         <p>اولین کسی باشید که برای “{{$ad->title}}” دیدگاهی می نویسد</p>
         <p>نشانی ایمیل شما منتشر نخواهد شد. بخش‌های موردنیاز علامت‌گذاری شده‌اند * </p>
        </div>
        <div>
         <form action="">
          <div class="mb-3">
           <label for="exampleFormControlTextarea1"
                  class="form-label">دیدگاه شما *
           </label>
           <textarea class="form-control"
                     id="exampleFormControlTextarea1"
                     wire:model="comment"
                     rows="6"></textarea>
          </div>
          <div class="mb-3">
           <label for="exampleFormControlInput1"
                  class="form-label">نام *
           </label>
           <input type="name"
                  class="form-control"
                  wire:model="name"
                  id="exampleFormControlInput1"
                  placeholder="name@example.com">
          </div>
          <div class="mb-3">
           <label for="exampleFormControlInput1"
                  class="form-label">ایمیل *</label>
           <input type="email"
                  class="form-control"
                  wire:model="email"
                  id="exampleFormControlInput1"
                  placeholder="name@example.com">
          </div>
          <div>
           <button class="btn btn-primary"
                   wire:click.prevent="storeComment">ثبت
           </button>
          </div>
         </form>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
   <!--  -->
   <div class="col-12 col-md-5">
    <aside>
     <div>
      <div class="box">
       <div class="row contact-box">
        <button type="button"
                wire:click="showContactInfo"
                class="btn btn-primary info-btn col-md-6 col-sm-12 pull-right contact_info">اطلاعات
         تماس
        </button>
        @if($local)
         <script !src="">
           document.cookie = 'favorites=@json($favorits); expires=Thu, 18 Dec 2045 12:00:00 UTC; path=/';
         </script>
        @endif
        <button data-toggle="tooltip"
                data-placement="top"
                title=""
                wire:click="favorite"
                type="button"
                onclick=""
                class="btn info-btn    @if($isFavorite)btn-primary
@elsebtn-danger
                  @endif btn-icon btn-framed col-md-6 col-sm-12 pull-right">
         <i class="fa fa-bookmark-o"></i></button>
        {{-- <button data-toggle="tooltip"
                 data-placement="top"
                 title=""
                 type="button"
                 class="btn  info-btn
                  @if($isFavorite)
                  btn-primary
                  @else
                   btn-danger
                   @endif
                    btn-icon btn-framed col-md-6 col-sm-12 pull-right favorite_7632"
                 data-original-title="افزودن به علاقه‌مندی"><i class="fa fa-bookmark-o"
                                                               aria-hidden="true"></i></button>--}}
       </div>
       <ul>
        <li class="border-bottom d-flex justify-content-between pb-2"><span>دسته
          بندی</span>
         @foreach($ad->categories as $category)
          <span><a href="{{route('front.ad.category.index.first.page',['slug'=>$category->slug])}}">{{$category->name}}</a></span>
         @endforeach
        </li>
        <li class="border-bottom d-flex justify-content-between pb-2">
         <span>شهر/محله</span>
         <span>
          @if($ad?->city)
           <a href="{{route('front.ad.category.city.index.first.page',['slug'=>$ad?->city->name])}}">{{$ad?->city->name}}</a>
          @endif
         </span>
        </li>
        <li class="border-bottom d-flex justify-content-between pb-2"><span>تاریخ
          انتشار</span><span>{{jdate($ad['created_at'])->ago()}}</span></li>
        <li class="d-flex justify-content-between pt-2 pb-2"><span>مبلغ</span><span><a href=""
                                                                                       class="text-success">تماس
           بگیرید</a></span></li>
       </ul>
       <div class="warning_ad">
        آدرس، شماره تلفن و ادرس سایت شغل های و بیزینس های ایرانی در کانادا
       </div>
       <section class="report_ad mt-3">
        <a href="#"
           wire:click.prevent="report"><i class="fa fa-flag"></i> گزارش مشکل آگهی</a>
       </section>
      </div>
      <section class="box"><img width="69"
                                height="115"
                                src="../images/4611.png"
                                alt=""
                                style="max-width: 100%; height: auto;"></section>
      <section>
       <div class="share">
        <span class="post-link__button"><i class="fa fa-files-o"
                                           aria-hidden="true"></i>
         لینک اشتراک گذاری</span>
        <input type="text"
               id="shortlink">
       </div>
      </section>
      <div class="crunchify-social">
       <span>
        <i class="fa fa-share-alt"></i> اشتراک گذاری </span>
       <a class="crunchify-link crunchify-telegram"><i class="fa fa-telegram"></i></a>
       <a class="crunchify-link crunchify-facebook"
          href=""
          target="_blank"><i class="fa fa-facebook-f"></i></a>
       <a class="crunchify-link crunchify-whatsapp"
          href=""
          target="_blank"><i class="fa fa-whatsapp"></i></a>
       <a class="crunchify-link crunchify-twitter"
          href=""
          target="_blank"><i class="fa fa-twitter"></i></a>
      </div>
     </div>
    </aside>
   </div>
  </div>
 </div>
</section>@php
 $adsUser=App\Models\Ad\Ad::with([
                   'state',
                      'city',
                   'media' => function ($q) {
                    $q->whereCollectionName('SpecialImage');
                   },
                   'mainCategory',
                   'favorites' => function ($q) {
                    if (auth()->check()) {
                     $q->whereUserId(auth()->id());
                    }
                   }
                  ])->whereUserId($ad->user_id)->inRandomOrder()->whereNotIn('id',[$ad->id])->limit(8)->get();

$adsUserIds=$adsUser->pluck('id');
$adsUser=$adsUser->chunk(4);


 $adsSimilar=App\Models\Ad\Ad::with([
                   'state',
                   'city',

                   'media' => function ($q) {
                    $q->whereCollectionName('SpecialImage');
                   },
                   'mainCategory',
                   'favorites' => function ($q) {
                    if (auth()->check()) {
                     $q->whereUserId(auth()->id());
                    }
                   }
                  ])->whereHas('categories',function ($q) use($ad){
 $q->whereIn('ad_categories.id',$ad->categories->pluck('id'));
 })
->orWhere('city_id',$ad->city_id)
->orWhere('state_id',$ad->state_id)
->inRandomOrder()->whereNotIn('id',[$ad->id,...$adsUserIds])->limit(8)->get()->chunk(4);


@endphp@includeWhen(count($adsUser),'livewire.front.ad.layouts.ad-slider',['ads'=>$adsUser,'title'=>'سایر آگهی‌های این کاربر','id'=>1])@includeWhen(count($adsSimilar),'livewire.front.ad.layouts.ad-slider',['ads'=>$adsSimilar,'title'=>'آگهی‌های مشابه','id'=>2])