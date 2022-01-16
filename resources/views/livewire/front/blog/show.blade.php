<div class="col-12 col-md-8">
 <div class="bg-white">
  <article>
   <div class="card text-white">
    <img src="{{$post->getFirstMediaUrl('SpecialImage')}}"
         class="card-img"
         alt="...">
    <div class="card-img-overlay d-flex align-items-end">
     <h5 class="card-title">{{$post->title}}</h5>
    </div>
   </div>
   <div class="p-3">
    <p class="p-3 ps-5">بازدیدها: {{$post->views}}</p>
    {!! $post->content !!}
    <div>
     <div class="text-end d-flex justify-content-end">
      <div class="bg-light p-3 col-md-6">
       @php

        $post2=\App\Models\Blog\Post::latest()->where('id','<',$post->id)->first();
      $t2=jdate($post2->created_at);

       @endphp
       <span class="text-secondary">مطلب قبلی</span>
       <p class="text-start mt-2">
        <a href="{{route('front.blog.show',[$t2->getYear(),$t2->getMonth(),$t2->getDay(),$post2->slug])}}">{{$post2->title}}</a>
       </p>
      </div>
     </div>
    </div>
   </div>
  </article>
 </div>
 <section class="index-blog blog-block pt-5 pb-5">
  <div class="container">
   <div class="section-title clearfix">
    <h2>وبلاگ</h2>
   </div>
   <div id="carouselExampleControls"
        class="carousel slide"
        data-bs-ride="carousel">
    <div class="carousel-inner">
     <div class="carousel-item active">
      <div class="row row-cols-1 row-cols-md-3 g-3 flex-nowrap flex-md-wrap">
       <div class="col">
        <div class="card">
         <img src="../images/fashion-model-man-portrait-handsome-guy-closeup-70413209.jpg"
              class="card-img-top"
              alt="...">
         <p class="blog-detail">
          <span>
           <i class="fa fa-calendar-o"></i> 1 هفته قبل </span>
          <span>
           <i class="fa fa-bookmark-o"></i>
           وبلاگ </span>
          <span><i class="fa fa-pie-chart"
                   aria-hidden="true"></i>
           33 بازدید</span>
         </p>
         <div class="card-body card-bg">
          <a href=""
             class="card-title">
           <h4 class="blog-item">اجاره خانه در کانادا و انواع
            خانه اجاره ای</h4>
          </a>
          <p class="cart-text blog-meta">
           بازدیدها: 12یکی از عمده‌ترین مشکلاتی که ممکن است در
           ابتدای امر، تازه
           واردین به کشور کانادا... </p>
         </div>
        </div>
       </div>
       <div class="col">
        <div class="card">
         <img src="../images/fashion-model-man-portrait-handsome-guy-closeup-70413209.jpg"
              class="card-img-top"
              alt="...">
         <p class="blog-detail">
          <span>
           <i class="fa fa-calendar-o"></i> 1 هفته قبل </span>
          <span>
           <i class="fa fa-bookmark-o"></i>
           وبلاگ </span>
          <span><i class="fa fa-pie-chart"
                   aria-hidden="true"></i>
           33 بازدید</span>
         </p>
         <div class="card-body card-bg">
          <a href=""
             class="card-title">
           <h4 class="blog-item">اجاره خانه در کانادا و انواع
            خانه اجاره ای</h4>
          </a>
          <p class="cart-text blog-meta">
           بازدیدها: 12یکی از عمده‌ترین مشکلاتی که ممکن است در
           ابتدای امر، تازه
           واردین به کشور کانادا... </p>
         </div>
        </div>
       </div>
       <div class="col">
        <div class="card">
         <img src="../images/fashion-model-man-portrait-handsome-guy-closeup-70413209.jpg"
              class="card-img-top"
              alt="...">
         <p class="blog-detail">
          <span>
           <i class="fa fa-calendar-o"></i> 1 هفته قبل </span>
          <span>
           <i class="fa fa-bookmark-o"></i>
           وبلاگ </span>
          <span><i class="fa fa-pie-chart"
                   aria-hidden="true"></i>
           33 بازدید</span>
         </p>
         <div class="card-body card-bg">
          <a href=""
             class="card-title">
           <h4 class="blog-item">اجاره خانه در کانادا و انواع
            خانه اجاره ای</h4>
          </a>
          <p class="cart-text blog-meta">
           بازدیدها: 12یکی از عمده‌ترین مشکلاتی که ممکن است در
           ابتدای امر، تازه
           واردین به کشور کانادا... </p>
         </div>
        </div>
       </div>
      </div>
      <div class="carousel-item">
       <div class="row row-cols-1 row-cols-md-3 g-3 flex-nowrap flex-md-wrap">
        <div class="col">
         <div class="card">
          <img src="../images/fashion-model-man-portrait-handsome-guy-closeup-70413209.jpg"
               class="card-img-top"
               alt="...">
          <p class="blog-detail">
           <span>
            <i class="fa fa-calendar-o"></i> 1 هفته قبل </span>
           <span>
            <i class="fa fa-bookmark-o"></i>
            وبلاگ </span>
           <span><i class="fa fa-pie-chart"
                    aria-hidden="true"></i>
            33 بازدید</span>
          </p>
          <div class="card-body card-bg">
           <a href=""
              class="card-title">
            <h4 class="blog-item">اجاره خانه در کانادا و انواع
             خانه اجاره ای</h4>
           </a>
           <p class="cart-text blog-meta">
            بازدیدها: 12یکی از عمده‌ترین مشکلاتی که ممکن است در
            ابتدای امر، تازه
            واردین به کشور کانادا... </p>
          </div>
         </div>
        </div>
        <div class="col">
         <div class="card">
          <img src="../images/fashion-model-man-portrait-handsome-guy-closeup-70413209.jpg"
               class="card-img-top"
               alt="...">
          <p class="blog-detail">
           <span>
            <i class="fa fa-calendar-o"></i> 1 هفته قبل </span>
           <span>
            <i class="fa fa-bookmark-o"></i>
            وبلاگ </span>
           <span><i class="fa fa-pie-chart"
                    aria-hidden="true"></i>
            33 بازدید</span>
          </p>
          <div class="card-body card-bg">
           <a href=""
              class="card-title">
            <h4 class="blog-item">اجاره خانه در کانادا و انواع
             خانه اجاره ای</h4>
           </a>
           <p class="cart-text blog-meta">
            بازدیدها: 12یکی از عمده‌ترین مشکلاتی که ممکن است در
            ابتدای امر، تازه
            واردین به کشور کانادا... </p>
          </div>
         </div>
        </div>
        <div class="col">
         <div class="card">
          <img src="../images/fashion-model-man-portrait-handsome-guy-closeup-70413209.jpg"
               class="card-img-top"
               alt="...">
          <p class="blog-detail">
           <span>
            <i class="fa fa-calendar-o"></i> 1 هفته قبل </span>
           <span>
            <i class="fa fa-bookmark-o"></i>
            وبلاگ </span>
           <span><i class="fa fa-pie-chart"
                    aria-hidden="true"></i>
            33 بازدید</span>
          </p>
          <div class="card-body card-bg">
           <a href=""
              class="card-title">
            <h4 class="blog-item">اجاره خانه در کانادا و انواع
             خانه اجاره ای</h4>
           </a>
           <p class="cart-text blog-meta">
            بازدیدها: 12یکی از عمده‌ترین مشکلاتی که ممکن است در
            ابتدای امر، تازه
            واردین به کشور کانادا... </p>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
     <button class="carousel-control-prev prev"
             type="button"
             data-bs-target="#carouselExampleControls"
             data-bs-slide="prev">
      <span class="carousel-control-prev-icon"
            aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
     </button>
     <button class="carousel-control-next next"
             type="button"
             data-bs-target="#carouselExampleControls"
             data-bs-slide="next">
      <span class="carousel-control-next-icon"
            aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
     </button>
    </div>
   </div>
  </div>
 </section>
 <div>
  <h3>دیدگاهتان را بنویسید </h3>
  @auth()
   <p>با عنوان {{auth()->user()->name}} وارد شده‌اید. </p>
  @endauth
  @guest()
   <p>برای ارسال دیدگاه ابتدا <b><a href="{{route('front.login-register')}}">وارد</a></b> شوید.</p>

  @endguest
  <form action="">
   <div class="mb-3">
    <label for="exampleFormControlTextarea1"
           class="form-label">دیدگاه </label>
    <textarea class="form-control"
              id="exampleFormControlTextarea1"
              rows="6"></textarea>
   </div>
   <button class="btn btn-primary">ارسال دیدگاه</button>
  </form>
 </div>
</div>