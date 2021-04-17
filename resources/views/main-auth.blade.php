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
      
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script>
      // toastr.success('message', 'title', { "timeOut": 50000, "closeButton": true, positionClass: 'toast-top-right', containerId: 'toast-top-right' })
      @if(session('noty'))
        messageToast("{!! session('noty')['title'] !!}", "{!! session('noty')['message'] !!}", "{!! session('noty')['status'] !!}", 5000)
        <?php session()->forget('noty') ?>
        @endif
    </script>
</body>


</html>
