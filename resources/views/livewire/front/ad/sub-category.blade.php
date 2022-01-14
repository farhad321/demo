@foreach($children as $category)


 @php

  $perfix='';
  for ($x = 2; $x <= $loop->depth; $x++) {
   $perfix.='_';
 }


 @endphp


 <option value="{{$category->id}}">{{$perfix}}{{$category->name}}</option>

 @include('livewire.front.ad.sub-category',['children'=>$categories->where('parent_id',$category->id),'categories'=>$categories])
@endforeach