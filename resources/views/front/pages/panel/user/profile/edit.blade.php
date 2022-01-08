@extends('front.pages.panel.user.base')

@section('user_panel_content')
 <div class="col-12 col-md-8">
  <form class="row g-3">
   <div class="col-md-6">
    <label for="inputEmail4"
           class="form-label">Email</label>
    <input type="email"
           class="form-control"
           id="inputEmail4">
   </div>
   <div class="col-md-6">
    <label for="inputPassword4"
           class="form-label">Password</label>
    <input type="password"
           class="form-control"
           id="inputPassword4">
   </div>
   <div class="col-12">
    <label for="inputAddress"
           class="form-label">Address</label>
    <input type="text"
           class="form-control"
           id="inputAddress"
           placeholder="1234 Main St">
   </div>
   <div class="col-12">
    <label for="inputAddress2"
           class="form-label">Address 2</label>
    <input type="text"
           class="form-control"
           id="inputAddress2"
           placeholder="Apartment, studio, or floor">
   </div>
   <div class="col-12">
    <label for="inputAddress2"
           class="form-label">Address 2</label>
    <input type="text"
           class="form-control"
           id="inputAddress2"
           placeholder="Apartment, studio, or floor">
   </div>
   <div class="form-floating">
                                <textarea class="form-control"
                                          placeholder="Leave a comment here"
                                          id="floatingTextarea2"
                                          style="height: 100px"></textarea>
    <label for="floatingTextarea2">Comments</label>
   </div>
   <div class="input-group mb-3">
    <input type="file"
           class="form-control">
   </div>
   <div class="col-12 mt-5 mb-5">
    <div class="form-check">
     <input class="form-check-input"
            type="checkbox"
            id="gridCheck">
     <label class="form-check-label"
            for="gridCheck">
      Check me out
     </label>
    </div>
   </div>
   <!--  -->
   <fieldset>
    <legend>تغییر گذرواژه</legend>
    <p class="">
     <label for="password_current">گذرواژه پیشین (در صورتی که قصد تغییر ندارید خالی
      بگذارید)</label>
     <span class="password-input"><span class="show-password-input"></span><input type="password"
                                                                                  autocomplete="off"></span>
    </p>
    <p class="">
     <label for="password_1">گذرواژه جدید (در صورتی که قصد تغییر ندارید خالی
      بگذارید)</label>
     <span class="password-input"><span class="show-password-input"></span><input type="password"
                                                                                  autocomplete="off"></span>
    </p>
    <p class="">
     <label for="password_2">تکرار گذرواژه جدید</label>
     <span class="password-input"><span class="show-password-input"></span><input type="password"
                                                                                  autocomplete="off"></span>
    </p>
   </fieldset>
   <!--  -->
   <div class="col-12">
    <button type="submit"
            class="btn btn-primary">Sign in
    </button>
   </div>
  </form>
 </div>
@endsection