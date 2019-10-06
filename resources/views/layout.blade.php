<!DOCTYPE html>
<html lang='{!! app()->getLocale() !!}'>
<head>
    @include('components.header')
    @yield('additional_css')
    <style>
        .loading_bg{
            background-color: black;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div class="preloader loading_bg d-none" id="loading_screen">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">
        @include('components.topnav')
        @include('components.sidenav')

        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">

                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0 bg-white">
                                @yield('breadcrumb_list')
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-content container-fluid">
                @yield('content')
            </div>

            <footer class="footer text-center">
                All Rights Reserved by Inlingua International Ltd. Designed and Developed by
                <a href="#">OpSign</a>.
            </footer>
        </div>
    </div>
@include('components.footer')
@yield('additional_js')
</body>
</html>
