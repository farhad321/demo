<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3 mt-5">
 @forelse ($ads as $ad)
  <livewire:front.ad.search.card-search :ad="$ad"
                                        :wire:key="$ad['id']"/>
  {{--  <livewire:front.ad.card :ad="$ad"--}}
  {{--                          :wire:key="$ad['id']"/>--}}
  <br>
 @empty
  <div class="border-blue w-100">
   <p>هیچ آگهی پیدا نشده است.</p>
  </div>
 @endforelse
 @if(count($ads))
  <div class="mt-3 w-100 d-flex justify-content-center">
   <nav aria-label="Page navigation example">
    <ul class="pagination">
     @foreach($urls as $url)
      <li class="page-item rounded @if($url['active']) active @endif  @if($url['disabled'] )disabled
@endif"><a class="page-link  bg-transparent"
           href="{{$url['url']}}">{!! $url['label'] !!}</a></li>
     @endforeach
    </ul>
   </nav>
  </div>
 @endif
</div>