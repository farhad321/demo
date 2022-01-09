<section class="ad-list-block m-0">
 <div class="container">
  <div class="section-title clearfix">
   <h2>آخرین آگهی‌ها</h2>
  </div>
  <!-- cards -->
  <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3">
   @forelse ($ads as $ad)
    <livewire:front.ad.card :ad="$ad"
                            :wire:key="$ad['id']"/>
    {{--   {{$ad['id']}}--}}
    <br>
   @empty
    <p>هیچ آگهی هنوز ثبت نشده است.</p>
   @endforelse
  </div>
  <!-- more loader-->
  @if($hasPage)
   <div class="text-center ad-load-more">
    <div class="ad-loading">
     <div class="ad-loader-show"></div>
    </div>
    <button class="btn btn-primary btn-framed btn-rounded loadmore"
            wire:click="nextPageaa">
     آگهی بیشتر...
     <div wire:loading>
      <div class="spinner-grow"
           style="width: 1rem; height: 1rem;"
           role="status">
       <span class="visually-hidden">Loading...</span>
      </div>
     </div>
    </button>
   </div>
 </div>
 @endif
</section>
