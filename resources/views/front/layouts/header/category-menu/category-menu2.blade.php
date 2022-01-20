<li class="nav-item">
 <a href=""
    class="nav-link child {{!request()->routeIs('front.ad.category.index*')?'':'active-link-primary'}}">دسته بندی ها<i class="far fa-chevron-down"></i></a>
 <ul class="inner-ul p-0">
  @php
   $parents=\App\Models\Ad\Category::whereParentId(null)->orderBy('position')
->orderBy('name')
->get();
  @endphp

  @foreach($parents as $parent)


   <li class="nav-item"><a href="{{route('front.ad.category.index.first.page',[$parent->slug])}}">{{$parent->name}}</a>
    @php
     $children=\App\Models\Ad\Category::whereParentId($parent->id)
->orderBy('position')
->orderBy('name')
->get();
    @endphp

    @includeWhen($children->count(),'front.layouts.header.category-menu.sub-category-menu2',['children'=>$children])
   </li>
  @endforeach
 </ul>
</li>