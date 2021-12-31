<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
 <div class="container-fluid">
  <a class="navbar-brand"
     href="{{route('home')}}">کیوسک</a>
  <button class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#main_nav"
          aria-expanded="false"
          aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse"
       id="main_nav">
   <ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link"
                            href="{{route('blog-index')}}">مقالات</a></li>
    <li class="nav-item"><a class="nav-link"
                            href="#"> اخبار</a></li>
    <li class="nav-item dropdown">
     <a class="nav-link  dropdown-toggle"
        href="#"
        data-bs-toggle="dropdown">دسته آگهی ها</a>
     <ul class="dropdown-menu dropdown-menu-right">
      @php


       $parents=\App\Models\Ad\Category::whereParentId(null)->orderBy('position')
  ->orderBy('name')
  ->get();


      @endphp

      @foreach($parents as $parent)

       <li><a class="dropdown-item"
              href="{{route('index-ads-category',[$parent->slug])}} "> {{$parent->name}} </a>
        @php

         $children=\App\Models\Ad\Category::whereParentId($parent->id)
 ->orderBy('position')
 ->orderBy('name')
 ->get();
        @endphp

        @includeWhen($children->count(),'sub_category_menu',['children'=>$children])
       </li>


      @endforeach
     </ul>
    </li>
   </ul>
  </div> <!-- navbar-collapse.// -->
 </div> <!-- container-fluid.// -->
</nav>