@extends('layout')

@section('additional_css')
    <!-- Custom CSS -->
    <style>
        .center_content{
            display: block;
            margin-left: auto;
            margin-right: auto
        }
        .center_image{
            width: auto;
            max-height: 300px;
            display: block;
            margin-left: auto;
            margin-right: auto
        }
    </style>
@endsection

@section('breadcrumb_list')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{url('/organizations')}}">Organizations</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="material-card card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Add Organization</h4>
                </div>
                <form class="form_printerous" action="{{ url('/organizations/add') }}" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="card-body">
                            <div class="row pt-3">
                                <div class="col-md-4 center_content">
                                    <img src="{{asset('default/default.jpg')}}" class="center_image rounded-circle" id='img-upload'/>
                                    <br>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn-file">Image</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="organization_logo" class="custom-file-input" id="imgInp" >
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div> <br>
                                </div>
                            </div>
                            <hr>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Organization Email</label>
                                        <input type="email" required name="email" value="{{old('email')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number</label>
                                        <input type="text" required name="phone_number" value="{{old('phone_number')}}" class="form-control" placeholder="Enter Phone Number">
                                        {{-- <small class="form-control-feedback"> This is inline help </small>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Organization Name</label>
                                        <input type="text" required name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Organization Name">
                                        {{--                                        <small class="form-control-feedback"> This is inline help </small>--}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Organization Website</label>
                                        <input type="text" required name="website" value="{{old('website')}}" class="form-control" placeholder="Enter Organization Website">
                                        {{--                                        <small class="form-control-feedback"> This is inline help </small>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <a href="{{url('/organizations')}}" class="btn btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('additional_js')
    <script src="{{asset('assets/libs/moment/moment.js')}}"></script>
    <script>
        $(document).on('submit','.form_printerous',function(){
            $('#loading_screen').removeClass('d-none');
            // console.log('clicked kok')
        });

    </script>
    <script>
        $(document).ready( function() {
            function readURLImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function(){
                readURLImage(this);
            });
        });
    </script>
@endsection
