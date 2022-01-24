<form class="row g-3">
 <div class="col-md-6">
  <label for="inputEmail4"
         class="form-label">نام</label>
  <input type="text"
         class="form-control @error('user.first_name') is-invalid @enderror"
         wire:model="user.first_name"
         id="inputEmail4">
  @error('user.first_name') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 <div class="col-md-6">
  <label for="inputPassword4"
         class="form-label">نام خانوادگی</label>
  <input type="text"
         wire:model="user.last_name"
         class="form-control @error('user.last_name') is-invalid @enderror"
         id="inputPassword4">
  @error('user.last_name') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 <div class="col-12">
  <label for="inputuserdress"
         class="form-label ">نام نمایشی</label>
  <input type="text"
         class="form-control @error('user.name') is-invalid @enderror"
         wire:model="user.name"
         id="inputuserdress"
         placeholder="">
  @error('user.name') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 <div class="col-12">
  <label for="inputuserdress2"
         class="form-label">آدرس ایمیل</label>
  <input type="email"
         class="form-control @error('user.email') is-invalid @enderror"
         wire:model="user.email"
         id="inputuserdress2"
         placeholder="">
  @error('user.email') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 <div class="col-12">
  <label for="inputuserdress2"
         class="form-label">آدرس</label>
  <input type="text"
         class="form-control @error('user.address') is-invalid @enderror"
         wire:model="user.address"
         id="inputuserdress2"
         placeholder="">
  @error('user.address') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 <div class="form-floating">
                                <textarea class="form-control @error('user.description') is-invalid @enderror"
                                          wire:model="user.description"
                                          placeholder=""
                                          id="floatingTextarea24"
                                          style="height: 100px"></textarea>
  @error('user.description') <span class=" text-danger">{{ $message }}</span> @enderror
  <label for="floatingTextarea24">توضیحات</label>
 </div>
 <label for="floatingTextarea24">عکس پروفایل</label>
 <div class="input-group mb-3">
  <input type="file"
         wire:model="avatar"
         placeholder="عکس پروفایل"
         class="form-control @error('avatar') is-invalid @enderror">
  <img class="img-thumbnail"
       src="{{$previewAvatar}}"
       alt="">
  @if($previewAvatar)
   <span class="position-absolute top-0 start-100 translate-middle p-2   rounded-circle">
    <i class="fa fa-trash"
       aria-hidden="true"
       wire:click="mediaDelete"></i>
    <span class="visually-hidden">New alerts</span>
   </span>
  @endif
 </div>
 @error('avatar') <span class=" text-danger">{{ $message }}</span> @enderror
 <div class="spinner-border text-success"
      wire:loading
      wire:target="avatar"></div>
{{--  <div class="col-12 mt-5 mb-5">--}}
{{--   <div class="form-check">--}}
{{--    <input class="form-check-input"--}}
{{--           type="checkbox"--}}
{{--           id="gridCheck">--}}
{{--    <label class="form-check-label"--}}
{{--           for="gridCheck">--}}
{{--     Check me out--}}
{{--    </label>--}}
{{--   </div>--}}
{{--  </div>--}}
<!--  -->
 <fieldset>
  <legend>تغییر گذرواژه</legend>
  <p class="">
   <label for="password_current">گذرواژه پیشین (در صورتی که قصد تغییر ندارید خالی
    بگذارید)</label>
   <span class="password-input @error('password') is-invalid @enderror"><span class="show-password-input"></span><input type="password"
                                                                                                                        wire:model="password"
                                                                                                                        autocomplete="off"></span>
   @error('password') <span class=" text-danger">{{ $message }}</span> @enderror
  </p>
  <p class="">
   <label for="password_1">گذرواژه جدید (در صورتی که قصد تغییر ندارید خالی
    بگذارید)</label>
   <span class="password-input @error('newPassword') is-invalid @enderror"><span class="show-password-input"></span><input type="password"
                                                                                                                           wire:model="newPassword"
                                                                                                                           autocomplete="off"></span>
   @error('newPassword') <span class=" text-danger">{{ $message }}</span> @enderror
  </p>
  <p class="">
   <label for="password_2">تکرار گذرواژه جدید</label>
   <span class="password-input @error('newPassword_confirmation') is-invalid @enderror"><span class="show-password-input"></span><input type="password"
                                                                                                                                        wire:model="newPassword_confirmation"
                                                                                                                                        autocomplete="off"></span>
   @error('newPassword_confirmation') <span class=" text-danger">{{ $message }}</span> @enderror
  </p>
 </fieldset>
 <!--  -->
 <div class="col-12">
  <button type="submit"
          wire:click.prevent="store"
          class="btn btn-primary">ذخیره تغییرات
  </button>
 </div>
</form>
