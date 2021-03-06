@extends('layout')

@section('additional_css')
    <!-- Custom CSS -->
    <link href="{{asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('breadcrumb_list')
    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Organizations</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="material-card card">
                <div class="card-body">
                    <h4 class="card-title">List Organizations</h4>
                    <h6 class="card-subtitle">List of all registered organizations.</h6>
                    <div class="row card-subtitle">
                        <div class="col-10">
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Search</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="query_organization" placeholder="Search by Organization's or PIC's Name">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="text" class="btn btn-circle btn-outline-info" id="search_organization" >
                                            <i class="ti-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="{{url('/organizations/add')}}" class=" btn btn-outline-info btn-circle btn-lg btn-circle float-right" >
                                <i class="ti-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="organizations_table" class="table table-striped border">
                            <thead>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_js')
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script>
        function initOrganizationTable(query){
            $('#organizations_table').DataTable().clear().destroy();
            $('#organizations_table').DataTable({
                "bAutoWidth" : false,
                "ordering": true,
                "paging" : false,
                "searching" : false,
                // "processing": true,
                "ajax": {
                    "url": "{{url('/api/organization?query=')}}"+query,
                    "type": "GET",
                    "dataType": "json"
                },

                "columnDefs": [
                    {
                        targets:0,
                        render: function ( data, type, row ) {
                            var image = '{{asset('default/default.jpg')}}';
                            if(row.logo != null){
                                image = '{{asset('storage')}}/'+row.logo;
                            }
                            return `<img width="80" src="`+image+`">`
                        }

                    },
                    {
                        targets:1,
                        render: function ( data, type, row ) {
                            return `
                                <h3><b>`+row.name+`</b></h3>
                                <h4><i class="fa fa-envelope"></i> `+row.email+`</h4>
                                <h4><i class="fa fa-phone"></i> `+row.phone+`</h4>
                                <a href="`+row.website+`"><i class="fa fa-link"></i> `+row.website+`</a>
                            `
                        }
                    },
                    {
                        targets:2,
                        render: function ( data, type, row ) {
                            var id = '{{Session::get('id')}}';
                            if(row.user_id == id){
                                return `
                                <a href="{{url('organizations/edit/')}}/`+row.id+`" class="float-right  btn btn-outline-warning btn-circle btn-lg btn-circle ml-2"><i class="ti-pencil-alt"></i> </a>
                                <a href="{{url('organizations/detail/')}}/`+row.id+`" class="float-right btn btn-outline-info btn-circle btn-lg btn-circle"><i class="ti-eye"></i> </a>
                            `
                            }else{
                                return `
                                <a href="{{url('organizations/detail/')}}/`+row.id+`" class="float-right btn btn-outline-info btn-circle btn-lg btn-circle"><i class="ti-eye"></i> </a>
                            `
                            }
                        }
                    }
                ]
            });
        }

        $(document).ready(function () {
            initOrganizationTable('')
        });

        $('#search_organization').click(function () {
            var query = $('#query_organization').val();
            initOrganizationTable(query)
        });
    </script>
@endsection
