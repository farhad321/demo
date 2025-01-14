<section class=" blog-block m-0 p-4">
 <div class="container border-0 border-bottom">
  <div class="row">
   <div class="col-12 col-md-7  pt-4">
    <img src="{{$ad->getFirstMediaUrl('SpecialImage')}}"
         class="img-fluid w-100"
         alt="{{$ad->title}}">
    <div class="accordion accordion-flush mt-4 rounded"
         id="accordionFlushExample">
     <div class="accordion-item">
      <h2 class="accordion-header"
          id="flush-headingOne">
       <button class="accordion-button pb-0 ps-0  border-bottom"
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
         id="accordionFlushExampleTwo">
     <div class="accordion-item">
      <h2 class="accordion-header"
          id="flush-headingTwo">
       <button class="accordion-button  border-bottom pb-0 ps-0"
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
           aria-labelledby="flush-headingTwo"
           data-bs-parent="#accordionFlushExampleTwo">
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
           <input type="text"
                  class="form-control"
                  wire:model="name"
                  id="exampleFormControlInput1"
                  placeholder="">
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
    <div>
     <div class="row align-items-center pb-3 pt-3">
      <div class="col-5 tag-topic">
       <i class="fas fa-tags"></i> برچسب ها:
      </div>
      <div class="col-7">
       <div class="rounded-tag">
        @foreach($ad->tags as $tag)
        <a href="{{route('front.ad.tag.index.first.page',$tag->slug)}}">#{{$tag->name}}</a>
        @endforeach
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
                class="btn info-btn btn-primary btn-icon btn-framed col-md-6 col-sm-12 pull-right">
         <i class="
         @if($isFavorite)fas
@else fal
         @endif fa-bookmark"></i></button>

       </div>
       <ul class="p-0">
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
           <a href="{{route('front.ad.category.city.index.first.page',['slug'=>$ad?->city->slug])}}">{{$ad?->city->name}}</a>
          @endif
         </span>
        </li>
        <li class="border-bottom d-flex justify-content-between pb-2"><span>تاریخ
          انتشار</span><span>{{jdate($ad['created_at'])->ago()}}</span></li>
        @foreach($ad->attrs as $attribute)
         @if($attribute->is_visible_on_front)
          @switch($attribute->type)
           @case('Text')
           <li class="border-bottom d-flex justify-content-between pb-2">
            <span>{{$attribute->name}}</span><span>{{$attribute->pivot->text}}</span></li>
           @break
          @endswitch
         @endif
        @endforeach
        <li class="d-flex justify-content-between pt-2 pb-2"><span>مبلغ</span><span><a href=""
                                                                                       class="text-success">تماس
           بگیرید</a></span></li>
       </ul>
       <div class="warning_ad">
        آدرس، شماره تلفن و ادرس سایت شغل های و بیزینس های ایرانی در کانادا
       </div>
       <section class="report_ad mt-3  text-end">
        <a href="#"
           wire:click.prevent="report"><i class="fa fa-flag"></i> گزارش مشکل آگهی</a>
       </section>
      </div>
      <section class="box  mb-5 mt-4"><img width="69"
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
               id="shortlink"
               placeholder="{{$ad->short_link}}">
       </div>
      </section>
      <div class="crunchify-social">
       <span>
        <i class="fa fa-share-alt"></i> اشتراک گذاری </span>
       <a href="https://telegram.me/share/url?text=&url={{route('front.ad.show',$ad->slug)}}"
          class="crunchify-link crunchify-telegram mt-2"><i class="fab fa-telegram-plane"></i></a>
       <a class="crunchify-link crunchify-facebook mt-2"
          href="https://www.facebook.com/sharer/sharer.php?u={{route('front.ad.show',$ad->slug)}}"
          target="_blank"><i class="fab fa-facebook-f"></i></a>
       <a class="crunchify-link crunchify-whatsapp mt-2"
          href="whatsapp://send?text={{$ad->title}} {{route('front.ad.show',$ad->slug)}}"
          target="_blank"><i class="fab fa-whatsapp"></i></a>
       <a class="crunchify-link crunchify-twitter mt-2"
          href="https://twitter.com/intent/tweet?text={{$ad->title}}&url={{route('front.ad.show',$ad->slug)}}&via=Crunchify"
          target="_blank"><i class="fab fa-twitter"></i></a>
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


@endphp @includeWhen(count($adsUser),'livewire.front.ad.layouts.ad-slider',['ads'=>$adsUser,'title'=>'سایر آگهی‌های این کاربر','id'=>1])@includeWhen(count($adsSimilar),'livewire.front.ad.layouts.ad-slider',['ads'=>$adsSimilar,'title'=>'آگهی‌های مشابه','id'=>2])