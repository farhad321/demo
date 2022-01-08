<form action=""
      class="bg-white p-4 shadow rounded">
 @error('all') <span class=" text-danger">{{ $message }}</span> @enderror
 <div class="form-floating mb-3">
  <input type="text"
         class="form-control @error('username') is-invalid  @enderror"
         id="floatingInput"
         wire:model="username"
         placeholder="name@example.com">
  <label for="floatingInput">ایمیل یا شماره موبایل *
  </label>
  @error('username') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 <div class="form-floating">
  <input type="password"
         class="form-control @error('username') is-invalid  @enderror"
         id="floatingPassword"
         wire:model="password"
         placeholder="Password">
  <label for="floatingPassword">کلمه عبور *
  </label>
  @error('password') <span class=" text-danger">{{ $message }}</span> @enderror
 </div>
 <div>
  <button class="btn mt-2 mb-2 btn-primary"
          wire:click.prevent="authUser">ورود
  </button>
 </div>
 <div>
  <input type="checkbox"
         wire:model="remember"
         name=""
         id="">
  <label for="">مرا به خاطر بسپار</label>
 </div>
 <div>
  <span>فراموشی کلمه عبور؟</span>
 </div>
</form>