@extends('layout')

@section('additional_css')
    <!-- Custom CSS -->
    <link href="{{asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('breadcrumb_list')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{url('/organizations')}}">Organizations</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 detail_card">
            <div class="card material-card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Detail Organization</h4>
                </div>
                <div class="p-4">
                    <div class="d-flex flex-row">
                        <div class=""><img src="{{$data['logo'] != null ? url('storage').'/'.$data['logo'] : asset('default/default.jpg')}}" alt="organization" class="rounded-circle" width="100"></div>
                        <div class="pl-4">
                            <h3><b>{{$data['name']}}</b></h3>
                            <h4><i class="fa fa-envelope"></i> {{$data['email']}}</h4>
                            <h4><i class="fa fa-phone"></i> {{$data['phone']}}</h4>
                            <a href="{{$data['website']}}"><i class="fa fa-link"></i> {{$data['website']}}</a>
                            <br>
                            @if($data['user_id'] == Session::get('id'))
                                <a href="{{url('organizations/edit/'.$data['id'])}}" class="btn btn-outline-warning btn-circle btn-lg"><i class="ti-pencil-alt"></i></a>
                                <button data-toggle="modal" data-target="#prompt_delete" class="btn btn-outline-danger btn-circle btn-lg"><i class="ti-trash"></i></button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h4 class="font-medium text-center border-bottom">
                        List Contact Person &nbsp;
                        @if($data['user_id'] == Session::get('id'))
                        <a href="{{url('persons/add/'.$data['id'])}}" class="btn btn-outline-info btn-circle btn-sm"><i class="ti-plus"></i></a>
                        @endif
                    </h4>
                    <div class="table-responsive">
                        <table id="persons_table" class="table table-striped border">
                            <thead>
                            <tr>
                                <td>Avatar</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Phone</td>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <td>Avatar</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td></td>
                            </tr>
                            </tfoot>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    Modal here--}}
    <div id="prompt_delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="prompt_delete_label">Confirm Question Deletion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Are you sure to delete this organization ?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{url('organizations/delete/'.$data['id'])}}" type="button" class="btn btn-info waves-effect float-right" id="delete_the_question_btn" >Yes</a>
                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
@endsection

@section('additional_js')
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script>
        $('#persons_table').DataTable({
            "bAutoWidth" : false,
            "ordering": false,
            "paging" : false,
            "searching" : false,
            // "processing": true,
            "ajax": {
                "url": "{{url('/api/person/'.$data['id'])}}",
                "type": "GET",
                "dataType": "json"
            },
            "columns" : [
                null,
                {"data" : "name"},
                {"data" : "email"},
                {"data" : "phone"}
            ],
            "columnDefs": [
                {
                    targets:0,
                    render: function ( data, type, row ) {
                        var image = '{{asset('default/default.jpg')}}';
                        if(row.avatar != null){
                            image = '{{asset('storage')}}/'+row.avatar;
                        }
                        return `<img width="80" src="`+image+`">`
                    }

                },
                {
                    targets: 4,
                    render: function (data, type, row) {
                        if('{{$data['user_id']}}' == '{{Session::get('id')}}'){
                            return `
                                <a href="{{url('persons/edit/'.$data['id'])}}/`+row.id+`" class="float-right  btn btn-outline-warning btn-circle btn-lg btn-circle ml-2"><i class="ti-pencil-alt"></i> </a>
                                <a href="{{url('persons/delete/')}}/`+row.id+`" class="float-right btn btn-outline-danger btn-circle btn-lg btn-circle"><i class="ti-trash"></i> </a>
                            `
                        }else{
                            return ``;
                        }
                    }
                }
            ]
        });
    </script>
@endsection
