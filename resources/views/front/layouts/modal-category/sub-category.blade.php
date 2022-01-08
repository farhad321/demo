@foreach($children as $child)
 {{-- <li class="nav-item"><a href="{{route('front.ad.category.index.first.page',[$child->slug])}}">{{$child->name}}</a>--}}

 <li class="cat-item"><a href="{{route('front.ad.category.index.first.page',[$child->slug])}}">
   @if($loop->depth >2)&ldsh;@endif
   {{$child->name}}</a>
 </li>
 @php
  $children=\App\Models\Ad\Category::whereParentId($child->id)->orderBy('position')
   ->orderBy('name')->get();
 @endphp

 @includeWhen($children->count(),'front.layouts.modal-category.sub-category',['children'=>$children])
 {{-- </li>--}}
@endforeach















{{--<li class="cat-item"><a href="">وسایل--}}{{--  آشپزخانه</a>--}}{{--</li>--}}