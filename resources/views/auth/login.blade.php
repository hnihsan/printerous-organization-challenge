<!DOCTYPE html>
<html lang='{!! app()->getLocale() !!}'>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/printerous_logo_square.png')}}">
    <title>Login</title>
    <!-- needed css -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-gradient-cyan" > <!-- style="background:url({{asset('assets/images/background/login-register.jpg')}}) no-repeat center center; background-size: 2000px 2000px;" -->
        <div class="auth-box">
            <div id="loginform">
                <div class="logo">
                    <span class="db"><img style="height: 40px; width: auto;" src="{{asset('assets/images/printerous_logo.png')}}" alt="logo" /></span>
                    <h5 class="font-medium mb-3">Login</h5>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3" action="" method="POST">
                            {{csrf_field()}}
                            <div class="form-group @if($errors->has('email')) has-danger @endif ">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" value="{{old('email')}}" class="form-control form-control-lg" name="email" placeholder="email" aria-label="email" aria-describedby="basic-addon1">
                                </div>
                                @if($errors->has('email'))<small class="form-control-feedback"> {{$errors->first('email')}} </small> @endif
                            </div>
                            <div class="form-group @if($errors->has('password')) has-danger @endif">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                                </div>
                                @if($errors->has('password'))<small class="form-control-feedback"> {{$errors->first('password')}} </small> @endif
                            </div>
                            <div class="form-group text-center">
                                <div class="col-xs-12 pb-3">
                                    <input type="submit" class="btn btn-block btn-lg btn-info" value="Login">
                                </div>
                                @if(Session::has('informasi'))<small class="form-control-feedback text-danger"> {{Session::get('informasi')}} </small> @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
</script>
<script>
    $(document).ready(function () {
        var isSuccess = "{{Session::has('success') ? "true" : "false"}}";
        if(isSuccess === "true"){
            Swal.fire("Success !", "{{Session::get('success')}}", "success")
        }

        var isFail = "{{Session::has('informasi') ? "true" : "false"}}";
        if(isFail === "true"){
            Swal.fire("Fail !", "{{Session::get('informasi')}}", "error")
        }
    });
</script>
</body>

</html>
