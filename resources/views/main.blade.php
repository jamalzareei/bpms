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
    
    <!-- BEGIN: Footer-->
    @include('components/footer')
    @yield('footer')
    
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script>
        @if(session('noty'))
        messageToast("{!! session('noty')['title'] !!}", "{!! session('noty')['message'] !!}", "{!! session('noty')['status'] !!}", 5000)
        <?php session()->forget('noty') ?>
        @endif
    </script>
</body>


</html>
