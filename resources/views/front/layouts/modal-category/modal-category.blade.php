<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="offcanvasRight"
     aria-labelledby="offcanvasRightLabel">
 <div class="offcanvas-header border-bottom">
  <h5 id="offcanvasRightLabel">دسته بندی ها</h5>
  <button type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"></button>
 </div>
 <div class="offcanvas-body">
  <div class="accordion"
       id="accordionExample">
   @php


    $parents=\App\Models\Ad\Category::whereParentId(null)->orderBy('position')
 ->orderBy('name')
 ->get();
   @endphp

   @foreach($parents as $parent)





    <div class="accordion-item">
     <h2 class="accordion-header"
         id="headingOne">
      <button class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapse{{$parent->id}}"
              aria-expanded="true"
              aria-controls="collapse{{$parent->id}}">
       <a href="{{route('front.ad.category.index.first.page',[$parent->slug])}}">
        {{$parent->name}}
       </a>
      </button>
     </h2>
     <div id="collapse{{$parent->id}}"
          class="accordion-collapse collapse"
          aria-labelledby="heading{{$parent->id}}"
          data-bs-parent="#accordionExample">
      <div class="accordion-body">
       <ul class="children">
        @php
         $children=\App\Models\Ad\Category::whereParentId($parent->id)
    ->orderBy('position')
    ->orderBy('name')
    ->get();
        @endphp
        @includeWhen($children->count(),'front.layouts.modal-category.sub-category',['children'=>$children])
       </ul>
      </div>
     </div>
    </div>






   @endforeach
  </div>
 </div>
</div>