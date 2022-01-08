<div class="main-navigation">
 <div class="container">
  <nav class="navbar navbar-expand-lg navbar-light">
   @include('front.layouts.header.menu')
  </nav>
 </div>
 <div class="page-title">
  <div class="container">
   <div class="text-center website_header_slogan">
    کیوسک | نیازمندی های ایرانیان کانادا | آگهی رایگان نیازمندی ها
   </div>
  </div>
 </div>
 <div class="collapse show"
      id="collapseExample">
  <form action=""
        class="mt-5 mb-5 pb-5">
   <div class="container">
    <div class="row align-items-center">
     <div class="col-md-5 col-sm-3 ">
      <input type="text"
             class="form-control"
             placeholder="جستجو در تمام آگهی‌ها">
     </div>
     <div class="row g-2 col-md-5 col-sm-3">
      <div class="col-md-5">
       <div class="form-floating">
        <select class="form-select"
                id="floatingSelectGrid">
         <option selected>تمام شهر‌ها</option>
         <option value="1">One</option>
         <option value="2">Two</option>
         <option value="3">Three</option>
        </select>
       </div>
      </div>
      <div class="col-md-6">
       <div class="form-floating">
        <select class="form-select"
                id="floatingSelectGrid">
         <option selected>همه دسته‌بندی‌ها</option>
         <option value="1">One</option>
         <option value="2">Two</option>
         <option value="3">Three</option>
        </select>
       </div>
      </div>
     </div>
     <div class="col-md-2 col-sm-2 mt-3">
      <button type="submit"
              class="btn btn-primary w-100">جستجو
      </button>
     </div>
    </div>
   </div>
  </form>
 </div>
</div>