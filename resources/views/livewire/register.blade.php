<form action=""
      class="bg-white p-4 shadow rounded">
 <div class="form-floating mb-3">
  <input type="email"
         class="form-control @error('email') is-invalid  @enderror"
         id="floatingInput"
         wire:model="email"
         placeholder="name@example.com">
  <label for="floatingInput">آدرس ایمیل *
  </label>
  @error('email') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 <div class="form-floating mb-3">
  <input type="tel"
         class="form-control @error('phone') is-invalid  @enderror"
         id="floatingPassword"
         wire:model="phone"
         pattern="[0-9]*"
         placeholder="Password">
  <label for="floatingPassword">شماره تماس*
  </label>
  @error('phone') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 <div class="form-floating">
  <input type="password"
         class="form-control @error('password') is-invalid  @enderror"
         id="floatingPassword"
         wire:model="password"
         placeholder="Password">
  <label for="floatingPassword">کلمه عبور *
  </label>
  @error('password') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 {{-- <div class="form-floating">--}}
 {{--  <input type="password"--}}
 {{--         class="form-control @error('password_confirmation') is-invalid  @enderror"--}}
 {{--         id="floatingPassword"--}}
 {{--         wire:model="password_confirmation"--}}
 {{--         placeholder="Password">--}}
 {{--  <label for="floatingPassword">تایید کلمه عبور *--}}
 {{--  </label>--}}
 {{--  @error('password_confirmation') <span class=" text-danger">{{ $message }}</span> @enderror--}}
 {{-- </div>--}}
 <p class="mt-2 mb-2">اطلاعات شخصی شما برای پردازش سفارش شما استفاده می‌شود، و پشتیبانی از تجربه شما در این وبسایت، و
  برای اهداف دیگری که در سیاست حفظ حریم خصوصی توضیح داده شده است. </p>
 <div>
  <button class="btn btn-primary mt-2 mb-2"
          wire:click.prevent="register">ثبت نام
  </button>
 </div>
</form>