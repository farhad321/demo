<ul class="left-ul inner-ul p-0">
 @foreach($children as $child)
  <li class="nav-item"><a href="{{route('front.ad.category.index.first.page',[$child->slug])}}">{{$child->name}}</a>
   @php
    $children=\App\Models\Ad\Category::whereParentId($child->id)->orderBy('position')
     ->orderBy('name')->get();
   @endphp

   @includeWhen($children->count(),'front.layouts.header.category-menu.sub-category-menu2',['children'=>$children])
  </li>
 @endforeach
</ul>