@extends('front.base')
@section('seo')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content')
 <section class=" blog-block m-0 p-4">
  <div class="container border-0 border-bottom">
   <div class="accordion bg-transparent filter"
        id="accordionExample">
    <div class="accordion-item bg-transparent position-relative">
     <h2 class="accordion-header bg-transparent"
         id="headingOne">
      <button class="accordion-button bg-transparent right-apprance"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseTen"
              aria-expanded="true"
              aria-controls="collapseTen">
       جستجو پیشرفته
      </button>
     </h2>
     <select class="form-select absolot">
      <option selected>Open this select menu</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
     </select>
     <div id="collapseTen"
          class="accordion-collapse collapse bg-transparent"
          aria-labelledby="headingTen"
          data-bs-parent="#accordionExample">
      <div class="accordion-body">
       <div class="row g-2 align-items-center">
        <div class="col-md-3">
         <input type="checkbox">
         <label for="">اگهی ویژه</label>
        </div>
        <form class="row g-3 col-md-9">
         <div class="col-md-4">
          <label class="form-label"
                 for="specificSizeSelect">Preference</label>
          <select class="form-select"
                  id="specificSizeSelect">
           <option selected>Choose...</option>
           <option value="1">One</option>
           <option value="2">Two</option>
           <option value="3">Three</option>
          </select>
         </div>
         <div class="col-md-4">
          <label for="inputEmail4"
                 class="form-label">Email</label>
          <input type="email"
                 class="form-control"
                 id="inputEmail4">
         </div>
         <div class="col-md-4">
          <label for="inputPassword4"
                 class="form-label">Password</label>
          <input type="password"
                 class="form-control"
                 id="inputPassword4">
         </div>
        </form>
       </div>
       <div>
        <button class="btn btn-primary mt-3 mt-md-0">جستجو</button>
       </div>
      </div>
     </div>
    </div>
   </div>
   <!--  -->
   <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-3 mt-5">
    <div class="col">
     <div class="card">
      <img src="../images/fashion-model-man-portrait-handsome-guy-closeup-70413209.jpg"
           class="card-img-top"
           alt="...">
      <span class="favorite_7636 bookmark"
            data-toggle="tooltip"
            data-placement="top"
            title=""><i class="far fa-bookmark text-white fs-6"></i></span>
      <span class="ad_visit">78 بازدید</span>
      <h4 class="location">
       <a href="" class="">انتاریو</a>
      </h4>
      <span class="price"><span>تماس بگیرید</span></span>
      <div class="card-body  pt-2 pb-1 card-bg">
       <div class="meta">
       <h5 class="card-title text-dark">Card title</h5>
        <figure>
         <i class="fa fa-calendar-o"></i>2 ماه قبل
        </figure>
        <figure>
         <i class="fa fa-folder-open"></i><a href="">انجام
          امور خرید و فروش و اجاره</a>
        </figure>
       </div>
      </div>
     </div>
    </div>
    <div class="col">
     <div class="card">
      <img src="../images/fashion-model-man-portrait-handsome-guy-closeup-70413209.jpg"
           class="card-img-top"
           alt="...">
      <span class="favorite_7636 bookmark"
            data-toggle="tooltip"
            data-placement="top"
            title=""></span>
      <span class="ad_visit">78 بازدید</span>
      <h4 class="location">
       <a href="">انتاریو</a>
      </h4>
      <span class="price"><span>تماس بگیرید</span></span>
      <div class="card-body card-bg">
       <h5 class="card-title">Card title</h5>
       <div class="meta">
        <figure>
         <i class="fa fa-calendar-o"></i>2 ماه قبل
        </figure>
        <figure>
         <i class="fa fa-folder-open-o"></i><a href="">انجام
          امور خرید و فروش و اجاره</a>
        </figure>
       </div>
      </div>
     </div>
    </div>
    <div class="col">
     <div class="card">
      <img src="../images/fashion-model-man-portrait-handsome-guy-closeup-70413209.jpg"
           class="card-img-top"
           alt="...">
      <span class="favorite_7636 bookmark"
            data-toggle="tooltip"
            data-placement="top"
            title=""></span>
      <span class="ad_visit">78 بازدید</span>
      <h4 class="location">
       <a href="">انتاریو</a>
      </h4>
      <span class="price"><span>تماس بگیرید</span></span>
      <div class="card-body card-bg">
       <h5 class="card-title">Card title</h5>
       <div class="meta">
        <figure>
         <i class="fa fa-calendar-o"></i>2 ماه قبل
        </figure>
        <figure>
         <i class="fa fa-folder-open-o"></i><a href="">انجام
          امور خرید و فروش و اجاره</a>
        </figure>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>

@endsection