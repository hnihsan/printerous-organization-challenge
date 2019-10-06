<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- apps -->
<script src="{{asset('dist/js/app.min.js')}}"></script>
<script src="{{asset('dist/js/app.init.material.js')}}"></script>
<script src="{{asset('dist/js/app-style-switcher.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('dist/js/custom.min.js')}}"></script>
<script src="{{asset('assets/libs/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
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
