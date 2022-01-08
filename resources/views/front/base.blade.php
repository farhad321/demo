<!DOCTYPE html>
<html lang="fa"
      dir="rtl">
<head>
 @include('front.layouts.head')
 @include('front.layouts.Seo')
 @yield('seo')
</head>
<body>
<header class="bg-white"
        id="header">
 @include('front.layouts.header.header')
</header>
<!-- header -->
<!-- main -->
<main class="content">
 @yield('content')
</main>
<!-- footre -->
<footer class="footer">
 @include('front.layouts.footer')
</footer>
<!-- modal -->
@include('front.layouts.modal-category.modal-category')
@include('front.layouts.returnToTop')
<!-- script -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
@livewireScripts
</body>
</html>