<!DOCTYPE html>
<html lang="fa"
      dir="rtl">
<head>
 {!! SEO::generate() !!}
 @include('front.layouts.head')
 @yield('head')
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
@include('front.layouts.returnToTop')
<!-- modal -->
@include('front.layouts.modal-category.modal-category2')
<!-- script -->
@include('front.layouts.script')
@yield('script')
@livewireScripts
<livewire:front.sweet-alert/>
</body>
</html>