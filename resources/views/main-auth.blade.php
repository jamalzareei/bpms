<!doctype html>
<html @lang('en')>

<head>
    @include('components/head')
    @yield('header')
    {{-- @include('pages/css') --}}
</head>

{{-- @include('pages/nav')

<div >
  @yield('content')
</div>

  @include('pages/footer')
  @include('pages/script')

@yield('script') --}}

{{-- <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col=""> --}}

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static   menu-collapsed" data-open="click"
    data-menu="vertical-menu-modern" data-col="">


    <!-- BEGIN: Content-->
 
        @yield('content')
  
    {{-- @include('components/content') --}}
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    @include('components/footer')
    
      @yield('footer')
</body>


</html>
