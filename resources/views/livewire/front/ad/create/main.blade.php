<section class=" blog-block m-0">
 <div class="container pt-5">
  <div>
   <div class="container-step">
    <div class="stepper-wrapper">
     <div class="progress"></div>
     <div class="screen-indicator @if($step ==='category')completed @endif">1
     </div>
     <div class="screen-indicator @if($step ==='form')completed @endif ">2
     </div>
     <div class="screen-indicator @if($step ==='review')completed @endif">3
     </div>
    </div>
   </div>
  </div>
  @if($step ==='category')
   <div>
    <ul class="list-group">
     @if($backToCategory)
      <li class="list-group-item"
          wire:click="getChildrenBack()"><i class="fas fa-chevron-right C"></i> بازگشت
      </li>
     @endif
     @foreach($categories as $category)

      @if($category['children_count'])
       <li class="list-group-item"
           wire:click="getChildren({{$category['id']}})">{{$category['name']}} <i class="fas fa-chevron-left C"></i>
       </li>
      @else
       <li class="list-group-item"
           wire:click="selectCategory({{$category['id']}})">{{$category['name']}} <i class="fas fa-chevron-left C"></i>
       </li>

      @endif
     @endforeach



     {{--     <li class="list-group-item">A second item</li>--}}
     {{--     <li class="list-group-item">A third item</li>--}}
     {{--     <li class="list-group-item">A fourth item</li>--}}
     {{--     <li class="list-group-item">And a fifth one</li>--}}
     {{--     <li class="list-group-item">An item</li>--}}
     {{--     <li class="list-group-item">A second item</li>--}}
     {{--     <li class="list-group-item">A third item</li>--}}
     {{--     <li class="list-group-item">A fourth item</li>--}}
     {{--     <li class="list-group-item">And a fifth one</li>--}}
    </ul>
   </div>
   {{--   <ul class="list-group"--}}
   {{--       id="list-group-id">--}}
   {{--    <template v-for="c in computedCategory">--}}
   {{--     <li class="list-group-item"--}}
   {{--         :key="c.id"--}}
   {{--         wire:model="selectedCategory"--}}
   {{--         @click="selectParentCategory($event,c)"--}}
   {{--         v-if="c.children_count"--}}
   {{--         :value="c.id">@{{c.name}} <i class="fas fa-chevron-left C"></i>--}}
   {{--     </li>--}}
   {{--     <li class="list-group-item"--}}
   {{--         :key="c.id"--}}
   {{--         wire:model="selectedCategory"--}}
   {{--         @click="selectCategory($event,c)"--}}
   {{--         v-if="!c.children_count"--}}
   {{--         :value="c.id">@{{c.name}}--}}
   {{--     </li>--}}
   {{--    </template>--}}
   {{--    <li class="list-group-item"--}}
   {{--        :key="'back'"--}}
   {{--        v-if="parentCategory !==null"--}}
   {{--        @click="backToParent()">بازگشت <i class="fas fa-chevron-left C"></i>--}}
   {{--    </li>--}}
   {{--   </ul>--}}
   {{--   <categories wire:model="selectedCategory"></categories>--}}
  @endif
  @if($step ==='form')
   <div>
    <div class="alert alert-primary"
         role="alert">
     <div class="d-flex justify-content-between">
      <p> شما در حال ارسال آگهی در دسته‌بندی {{\App\Models\Ad\Category::find($selectedCategory)->name}} هستید.</p>
      <button class="btn-primary p-1"
              wire:click="goTo('category')">تغیر دسته بندی
      </button>
     </div>
    </div>
   </div>
   <div>
    <div class="section-title clearfix">
     <h2>اطلاعات آگهی </h2>
    </div>
    <form class="row g-3">
     <div class="col-md-8">
      <label for="inputEmail4"
             class="form-label">عنوان آگهی</label>
      <input type="text"
             wire:model="ad.title"
             class="form-control  @error('ad.title') is-invalid @enderror"
             id="inputEmail4">
      @error('ad.title') <span class=" text-danger">{{ $message }}</span> @enderror
     </div>
     <div class="col-md-4">
      <label for="inputPassword4"
             class="form-label">مبلغ</label>
      <input type="number"
             wire:model="ad.price"
             class="form-control @error('ad.price') is-invalid @enderror"
             id="inputPassword4">
      @error('ad.price') <span class=" text-danger">{{ $message }}</span> @enderror
     </div>
     <div class="col-md-6">
      <label for="formGroupExampleInput2"
             class="form-label">ایمیل</label>
      <input type="email"
             disabled
             value="{{auth()->user()->email}}"
             class="form-control "
             id="formGroupExampleInput2"
             placeholder="Another input placeholder">
     </div>
     <div class="col-md-6">
      <label for="formGroupExampleInput2"
             class="form-label">شماره تماس</label>
      <input type="text"
             disabled
             value="{{auth()->user()->phone}}"
             class="form-control "
             id="formGroupExampleInput2"
             placeholder="Another input placeholder">
     </div>
     <div class="col-12">
      <div class="form-check">
       <input class="form-check-input"
              type="checkbox"
              id="gridCheck">
       <label class="form-check-label"
              for="gridCheck">
        ایمیل در آگهی نمایش داده نشود
       </label>
      </div>
     </div>
     <div class="form-floating">
                            <textarea class="form-control @error('ad.content') is-invalid @enderror"
                                      wire:model="ad.content"
                                      placeholder="Leave a comment here"
                                      id="floatingTextarea2"
                                      style="height: 100px"></textarea>
      <label for="floatingTextarea2">توضیحات آگهی</label>
      @error('ad.content') <span class=" text-danger">{{ $message }}</span> @enderror
     </div>
     <div class="row g-3">
      <div class="col">
       <select class="form-select @error('ad.state_id') is-invalid @enderror"
               wire:model="ad.state_id"
               aria-label="Default select example">
        <option selected>استان</option>
        @foreach(\App\Models\Address\State::all() as $state )
         <option value="{{$state->id}}">{{$state->name}}</option>
        @endforeach
       </select>
       @error('ad.state_id') <span class=" text-danger">{{ $message }}</span> @enderror
      </div>
      <div class="col">
       <select class="form-select @error('ad.city_id') is-invalid @enderror"
               wire:model="ad.city_id"
               aria-label="Default select example">
        <option selected>شهر</option>
        @foreach(\App\Models\Address\City::whereStateId($ad->state_id)->get() as $state )
         <option value="{{$state->id}}">{{$state->name}}</option>
        @endforeach
       </select>
       @error('ad.city_id') <span class=" text-danger">{{ $message }}</span> @enderror
      </div>
      <div class="section-title clearfix ">
       <h2>تصاویر آگهی</h2>
      </div>
      <p class="text-center">افزودنِ عکس بازدید آگهی شما را تا سه برابر افزایش می‌دهد.</p>
      <div class="container-file ">
       <div class="dropzone">
        <label for="files"
               class="dropzone-container">
         <div class="file-icon">+</div>
         <div class="dropzone-title">
          جهت بارگذاری تصویر کلیک کنید
         </div>
         <div class="spinner-border"
              role="status"
              wire:loading
              wire:target="photos">
          <span class="visually-hidden">Loading...</span>
         </div>
        </label>
        <div class="d-flex flex-wrap justify-content-around">
         @foreach($previewPhotos as $photo)
          <div class="position-relative mb-1">
           <img class="img-thumbnail "
                height="200"
                width="200"
                src="{{$photo->original_url}}">
           <span class="position-absolute top-0 start-100 translate-middle p-2   rounded-circle">
            <i class="fa fa-trash"
               aria-hidden="true"
               wire:click="mediaDelete({{$photo->id}})"></i>
            <span class="visually-hidden">New alerts</span>
           </span>
          </div>
         @endforeach
        </div>
        <input id="files"
               type="file"
               class="file-input"
               multiple
               wire:model="photos"/>
       </div>
      </div>
      @php
       $message='';
      @endphp
      @foreach($errors->getMessageBag()->messages() as $key=>$error)
       @dump($key,$errors->getMessageBag()->messages())
       @if (Str::is('photos*',$key))
        @foreach ($error as $e)
         @php
          $message.=$e;
         @endphp
        @endforeach
       @endif
      @endforeach

      @if($message)
       <span class=" text-danger">{{ $message }}</span>
      @endif
     </div>
     <div class="row g-3">
      @include('front.pages.ads.create.attributes',['formAttributes'=>$formAttributes])
     </div>
    </form>
   </div>
   <div class="col-12 mt-5 d-flex justify-content-between">
    <button type="submit"
            class="btn btn-primary"
            wire:click="goTo('category')">مرحله قبل
    </button>
    <button type="submit"
            class="btn btn-success"
            wire:click="goTo('review')">مرحله بعد
    </button>
   </div>
  @endif
  @if($step ==='review')

   <div>
    <div class="section-title clearfix">
     <h2>تایید و انتشار</h2>
    </div>
    <form class="row g-3">
     <div class="col-md-8">
      <label for="inputEmail4"
             class="form-label">عنوان آگهی</label>
      <input type="text"
             disabled
             wire:model="ad.title"
             class="form-control"
             id="inputEmail4">
     </div>
     <div class="col-md-4">
      <label for="inputPassword4"
             class="form-label">مبلغ</label>
      <input type="number"
             wire:model="ad.price"
             disabled
             class="form-control"
             id="inputPassword4">
     </div>
     <div class="col-md-6">
      <label for="formGroupExampleInput2"
             class="form-label">ایمیل</label>
      <input type="email"
             disabled
             value="{{auth()->user()->email}}"
             class="form-control"
             id="formGroupExampleInput2"
             placeholder="Another input placeholder">
     </div>
     <div class="col-md-6">
      <label for="formGroupExampleInput2"
             class="form-label">شماره تماس</label>
      <input type="text"
             disabled
             value="{{auth()->user()->phone}}"
             class="form-control"
             id="formGroupExampleInput2"
             placeholder="Another input placeholder">
     </div>
     <div class="col-12">
      <div class="form-check">
       <input class="form-check-input"
              type="checkbox"
              disabled
              id="gridCheck">
       <label class="form-check-label"
              for="gridCheck">
        ایمیل در آگهی نمایش داده نشود
       </label>
      </div>
     </div>
     <div class="form-floating">
                            <textarea class="form-control"
                                      wire:model="ad.content"
                                      placeholder="Leave a comment here"
                                      disabled
                                      id="floatingTextarea2"
                                      style="height: 100px"></textarea>
      <label for="floatingTextarea2">توضیحات آگهی</label>
     </div>
     <div class="row g-3">
      <div class="col">
       <select class="form-select"
               disabled
               wire:model="ad.state_id"
               aria-label="Default select example">
        <option selected>استان</option>
        @foreach(\App\Models\Address\State::all() as $state )
         <option value="{{$state->id}}">{{$state->name}}</option>
        @endforeach
       </select>
      </div>
      <div class="col">
       <select class="form-select"
               wire:model="ad.city_id"
               disabled
               aria-label="Default select example">
        <option selected>شهر</option>
        @foreach(\App\Models\Address\City::whereStateId($ad->state_id)->get() as $state )
         <option value="{{$state->id}}">{{$state->name}}</option>
        @endforeach
       </select>
      </div>
      <div class="section-title clearfix is-invalid">
       <h2>تصاویر آگهی</h2>
      </div>
      <div class="container-file">
       <div class="dropzone"
            style="height: auto ;min-height: 200px">
        {{--        <label for="files"--}}
        {{--               class="dropzone-container">--}}
        {{--         <div class="file-icon">+</div>--}}
        {{--         <div class="dropzone-title">--}}
        {{--          جهت بارگذاری تصویر کلیک کنید--}}
        {{--         </div>--}}
        {{--        </label>--}}
        <div class="d-flex flex-wrap justify-content-around">
         @foreach($previewPhotos as $photo)
          <div class="position-relative ">
           <img class="img-thumbnail m-1"
                height="200"
                width="200"
                src="{{$photo->original_url}}">
          </div>
         @endforeach
        </div>
        <input id="files"
               {{--               name="files[]"--}}type="file"
               class="file-input"
               multiple
               wire:model="photos"/>
       </div>
      </div>
      @error('photos') <span class=" text-danger">{{ $message }}</span> @enderror
     </div>
     <div class="row g-3">
      @include('front.pages.ads.create.review-attributes',['formAttributes'=>$formAttributes])
     </div>
    </form>
   </div>
   <div class="col-12 mt-5 d-flex justify-content-between">
    <button type="submit"
            class="btn btn-primary"
            wire:click="goTo('form')">مرحله قبل
    </button>
    <button type="submit"
            class="btn btn-success"
            wire:click="store">تایید و انتشار
    </button>
   </div>
 @endif
 {{--  <div wire:loading wire:target="step">--}}
 {{--   <script>--}}
 {{--     window.scrollTo({--}}
 {{--       top: 0,--}}
 {{--       behavior: 'smooth'--}}
 {{--     });--}}
 {{--   </script>  </div>--}}
 {{-- </div>--}}
</section>