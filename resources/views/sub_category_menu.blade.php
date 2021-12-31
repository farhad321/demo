<ul class="submenu submenu-left dropdown-menu">
 @foreach($children as $child)
  <li><a class="dropdown-item"
         href="{{route('index-ads-category',[$child->slug])}} "> {{$child->name}} </a>
   @php

    $children=\App\Models\Ad\Category::whereParentId($child->id)->orderBy('position')
  ->orderBy('name')->get();
   @endphp

   @includeWhen($children->count(),'sub_category_menu',['children'=>$children])
  </li>
 @endforeach
</ul>
