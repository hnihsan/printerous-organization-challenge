<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin4">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <a class="navbar-brand d-block d-md-none" href="{{url('/dasboard')}}">
                <span class="logo-text">
                     <!-- dark Logo text -->
                     <img src="{{asset('assets/images/printerous_logo.png')}}" alt="homepage" class="dark-logo" style="width: 139px; height: 30px" />
                        <!-- Light Logo text -->
                     <img src="{{asset('assets/images/printerous_logo.png')}}" class="light-logo" alt="homepage" style="width: 139px; height: 30px" />
                </span>
            </a>
            <div class="d-none d-md-block text-center">
                <a class="sidebartoggler waves-effect waves-light d-flex align-items-center side-start" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                    <i class="mdi mdi-menu"></i>
                    <span class="navigation-text ml-3"> Navigation</span>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <li class="nav-item">
                    <a class="nav-link navbar-brand d-none d-md-block"href="{{url('/dashboard')}}">
                        <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="{{asset('assets/images/printerous_logo.png')}}" alt="homepage" class="dark-logo" style="width: 139px; height: 30px" />
                             <!-- Light Logo text -->
                             <img src="{{asset('assets/images/printerous_logo.png')}}" class="light-logo" alt="homepage" style="width: 139px; height: 30px" />
                        </span>
                    </a>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('default/default.jpg')}}" alt="user" class="rounded-circle" width="31">
                        <span class="ml-2 user-text font-medium">{{Session::get('name')}}</span><span class="fas fa-angle-down ml-2 user-text"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                            <div class=""><img src="{{asset('default/default.jpg')}}" alt="user" class="rounded" width="80"></div>
                            <div class="ml-2">
                                <h4 class="mb-0">
                                    {{Session::get('name')}}
                                </h4>
                                <p class=" mb-0 text-muted">{{Session::get('email')}}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{url('auth/logout')}}" id="logout_btn"><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
