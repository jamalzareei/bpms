<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html">
                    <img src="{{ asset('images/logo.svg') }}" alt="سرام پخش" class="m-auto" width="100">


                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-info toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-info" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('pages.dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span>
                    <span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span>
                </a>
                <ul class="menu-content">
                    
                    <li><a class="d-flex align-items-center" href="dashboard-analytics.html"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Analytics">Analytics</span></a>
                    </li>
                    <li class=""><a class="d-flex align-items-center" href="dashboard-ecommerce.html"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="eCommerce">eCommerce</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('pages.dashboard') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Analytics">Dashboards</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('pages.user.list') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Analytics">Users List</span>
                </a>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('pages.role.list') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Analytics">Roles List</span>
                </a>
            </li>
            
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('pages.link.list') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Analytics">Links List</span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="PI">PI</span>
                    {{-- <span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span> --}}
                </a>
                <ul class="menu-content">
                    
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.pis.list') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">List Pis </span>
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.pi.create') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">Create Pi </span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="currencies">currencies</span>
                </a>
                <ul class="menu-content">
                    
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.currencies.list') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">List currencies </span>
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.currencies.list') }}?create=true">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">Create currency </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="countries">countries</span>
                    {{-- <span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span> --}}
                </a>
                <ul class="menu-content">
                    
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.countries.list') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">List countries </span>
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.countries.list') }}?create=true">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">Create country </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Customers">Customers</span>
                    {{-- <span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span> --}}
                </a>
                <ul class="menu-content">
                    
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.customers.list') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">List Customer </span>
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.customers.list') }}?create=true">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">Create Customer </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Products">Products</span>
                    {{-- <span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span> --}}
                </a>
                <ul class="menu-content">
                    
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.products.list') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">List Product </span>
                        </a>
                    </li>
                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="{{ route('pages.products.list') }}?create=true">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Analytics">Create Product </span>
                        </a>
                    </li>
                </ul>
            </li>

            

            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>
            
        </ul>
    </div>
</div>