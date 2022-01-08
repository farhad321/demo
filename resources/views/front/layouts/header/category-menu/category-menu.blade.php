<li class="nav-item">
 <a href=""
    class="nav-link child {{!request()->routeIs('front.ad.category.index*')?:'active-link-primary'}}">دسته بندی ها</a>
 <ul class="inner-ul p-0">
  @php
   $all=\App\Models\Ad\Category::all('name','slug','position','id','parent_id');
   $parents=$all->where('parent_id',null)->sortBy('position')
   ->sortBy('name');
  @endphp

  @foreach($parents as $parent)


   <li class="nav-item"><a href="{{route('front.ad.category.index.first.page',[$parent->slug])}}">{{$parent->name}}</a>
    @php
     $children=$all->where('parent_id',$parent->id)
   ->sortBy('position')
   ->sortBy('name');
    @endphp

    @includeWhen($children->count(),'front.layouts.header.sub-category-menu',['children'=>$children,'all'=>$all])
   </li>
  @endforeach
 </ul>
</li>