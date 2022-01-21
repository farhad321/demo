{{--<div class="d-flex flex-row  flex-wrap justify-content-between mb-3">--}}
 @foreach($attributes as $key=>$attribute )
  @if($attribute['is_filterable'])
   @switch($attribute['type'])






{{--    <div class="col-md-4">--}}
{{--     <label class="form-label"--}}
{{--            for="specificSizeSelect">Preference</label>--}}
{{--     <select class="form-select"--}}
{{--             id="specificSizeSelect">--}}
{{--      <option selected>Choose...</option>--}}
{{--      <option value="1">One</option>--}}
{{--      <option value="2">Two</option>--}}
{{--      <option value="3">Three</option>--}}
{{--     </select>--}}
{{--    </div>--}}



















    @case('Text')
    <div class="col-md-4">
     <label class="form-label"
            for="specificSizeSelect">{{$attribute['name']}}</label>
     <select class="form-select @error("attributes.".$key.".value") is-invalid @enderror"
             wire:model="attributes.{{$key}}.value"
             id="specificSizeSelect">
      @php

       $options= \App\Models\Ad\AdAttribute::whereAdAttributeId(1)
                             ->distinct()->pluck('text');
      @endphp
      <option selected>انتخاب کنید</option>
      @foreach($options as $option)
       <option value="{{$option}}">{{$option}}</option>
      @endforeach
       <option value="all">همه</option>
     </select>
     @error("attributes.".$key.".value") <span class=" text-danger">{{ $message }}</span> @enderror
    </div>
    @break
{{--    @case('Select')
    <div class="col-md-4 ">
     <label for="inputEmail4"
            class="form-label">{{$attribute['name']}}</label>
     <select class="form-select @error("attributes.".$key.".value") is-invalid @enderror"
             wire:model="attributes.{{$key}}.value"
             aria-label="Default select example">
      @foreach($attribute['options_array'] as $option)
       --}}{{--     <option selected>شهر</option>--}}{{--
       <option value="{{$option}}">{{$option}}</option>
      @endforeach
     </select>
     @error("attributes.".$key.".value") <span class=" text-danger">{{ $message }}</span> @enderror
    </div>
    @break--}}
   @endswitch

  @endif
 @endforeach
{{--</div>--}}