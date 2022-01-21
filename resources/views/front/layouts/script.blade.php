<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(request()->routeIs('front.blog.category.news.index.first.page','front.blog.category.news.index','front.blog.category.blog.index','front.home'))
@else
 <script>
   let colaps = document.querySelector('.colpas-button').addEventListener("click", () => {
     document.querySelector(".fa-search").classList.toggle('d-none')
     document.querySelector(".fa-times").classList.toggle('disply')
   })
 </script>
@endif

