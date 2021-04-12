<!doctype html>
<html @lang('en')>

<head>
    @include('components/head')
    @yield('header')

    {{-- @include('pages/css') --}}
</head>



<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    {{-- <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col=""> --}}

    <!-- BEGIN: Header-->
    @include('components/header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('components/sidebar')
    <!-- END: Main Menu-->


    <!-- BEGIN: Content-->
     
    <div class="app-content content ">
       <div class="content-wrapper">     
          <div class="content-body">  
        @yield('content')      
         </div>
       </div>
    </div>
    
    {{-- @include('components/content') --}}
    <!-- END: Content-->


    <!-- BEGIN: Customizer-->
    {{-- @include('components/customizer') --}}
    <!-- End: Customizer-->


    <!-- Buynow Button-->
    {{-- <div class="buy-now">
    <a href="https://1.envato.market/vuexy_admin" target="_blank" class="btn btn-danger">Buy Now</a>
  </div>
  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div> --}}

    <!-- BEGIN: Footer-->
    @include('components/footer')
    @yield('footer')
</body>


</html>
