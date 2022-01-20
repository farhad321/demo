<form action=""
      class="mt-5 mb-5 pb-5">
 <div class="container">
  <div class="row row-cols-3 align-items-center">
   <div class="col-12 col-lg-5"><input type="text"
                                       class="form-control"
                                       wire:model="text"
                                       placeholder="جستجو در تمام آگهی‌ها"></div>
   <div class="row   ps-2 g-2 col-12 col-lg-5  ps-2 ps-md-0">
    <div class="col-lg-5">
     <div class="form-floating  p-0 ps-1">
      <select class="form-select"
              wire:model="city_id">
       <option value="0"
               selected>تمام شهر‌ها
       </option>
       @foreach($cities as $city)
        <option value="{{$city->id}}">{{$city->name}}</option>
       @endforeach
      </select>
     </div>
    </div>
    <div class="col-lg-7">
     <div class="form-floating p-0 ps-1">
      <select class="form-select"
              wire:model="category_id">
       <option value="0"
               selected>همه دسته‌بندی‌ها
       </option>
       {{--       @foreach($categories->where('parent_id',null) as $category)--}}

       {{--        <option value="{{$category->id}}">{{$category->name}}</option>--}}

       {{--        @include('livewire.front.ad.sub-category',['children'=>$categories->where('parent_id',$category->id),'categories'=>$categories])--}}
       {{--       @endforeach--}}
      </select>
     </div>
    </div>
   </div>
   <div class="col-12 col-lg-2 mt-3">
    <button type="submit"
            class="btn btn-primary w-100 hover-shadow"
            wire:click="startSearch()">جستجو
    </button>
   </div>
  </div>
 </div>
</form>