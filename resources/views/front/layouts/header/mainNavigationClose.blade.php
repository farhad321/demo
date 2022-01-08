<div class="main-navigation">
 <div class="container ">
  <nav class="navbar navbar-expand-lg navbar-light border-0">
   @include('front.layouts.header.menu')
  </nav>
 </div>
 <p class="d-flex justify-content-between col-12 border-top container">
  <span><a href="">خانه</a><span>/قوانین و مقررات</span></span>
  <button class="btn btn-primary"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#collapseExample"
          aria-expanded="false"
          aria-controls="collapseExample">
   <i class="far fa-search text-white"></i>
  </button>
 </p>
 <div class="collapse"
      id="collapseExample">
  <form action=""
        class="mt-5 mb-5 pb-5">
   <div class="container">
    <div class="row align-items-center">
     <div class="col-md-5 col-sm-3">
      <input type="text"
             class="form-control"
             placeholder="جستجو در تمام آگهی‌ها"
             aria-label="First name">
     </div>
     <div class="row g-2 col-md-5 col-sm-3">
      <div class="col-md-5">
       <div class="form-floating">
        <select class="form-select"
                id="floatingSelectGrid"
                aria-label="Floating label select example">
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
                id="floatingSelectGrid"
                aria-label="Floating label select example">
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
 <div class="container p-0 pt-5
            pb-5">
  <h3>آخرین آگهی‌ها</h3>
 </div>
</div>