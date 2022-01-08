<ul class="left-ul inner-ul p-0">
 @foreach($children as $child)
  <li class="nav-item"><a href="{{route('front.ad.category.index.first.page',[$child->slug])}}">{{$child->name}}</a>
   @php
    $children=$all->where('parent_id',$child->id)->sortBy('position')
  ->sortBy('name');
   @endphp

   @includeWhen($children->count(),'front.layouts.header.sub-category-menu',['children'=>$children,'all'=>$all])
  </li>
 @endforeach
</ul>