<div class="d-flex flex-row  flex-wrap justify-content-between mb-3">
 @foreach($formAttributes as $key=>$attribute )

  @switch($attribute['type'])


   @case('Text')
   <div class="col-md-6">
    <label for="inputEmail4"
           class="form-label">{{$attribute['name']}}</label>
    <input type="text"
           wire:model="formAttributes.{{$key}}.text"
           class="form-control @error("formAttributes.".$key.".text") is-invalid @enderror"
           id="inputEmail4">
    @error("formAttributes.".$key.".text") <span class=" text-danger">{{ $message }}</span> @enderror
   </div>
   @break
   @case('Select')
   <div class="col-md-6 ">
    <label for="inputEmail4"
           class="form-label">{{$attribute['name']}}</label>
    <select class="form-select @error("formAttributes.".$key.".text") is-invalid @enderror"
            wire:model="formAttributes.{{$key}}.text"
            aria-label="Default select example">
     @foreach($attribute['options_array'] as $option)
      {{--     <option selected>شهر</option>--}}
      <option value="{{$option}}">{{$option}}</option>
     @endforeach
    </select>
    @error("formAttributes.".$key.".text") <span class=" text-danger">{{ $message }}</span> @enderror
   </div>
   @break
  @endswitch

  {{-- --}}
  {{--   <div class="col-md-4">--}}
  {{--    <label for="inputPassword4"--}}
  {{--           class="form-label">مبلغ</label>--}}
  {{--    <input type="number"--}}
  {{--           wire:model="ad.price"--}}
  {{--           disabled--}}
  {{--           class="form-control"--}}
  {{--           id="inputPassword4">--}}
  {{--   </div>--}}

 @endforeach
</div>