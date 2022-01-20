@foreach($children as $child)
 <li class="cat-item"><a href="{{route('front.ad.category.index.first.page',[$child->slug])}}">
   @if($loop->depth >2)&ldsh;@endif
   {{$child->name}}</a>
 </li>
 @php
  $children=$all->where('parent_id',$child->id)->sortBy('position')
    ->sortBy('name');
 @endphp

 @includeWhen($children->count(),'front.layouts.modal-category.sub-category2',['children'=>$children])

@endforeach

