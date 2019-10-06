@extends('layout')

@section('additional_css')
    <!-- Custom CSS -->
    <link href="{{asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('breadcrumb_list')
    <li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card material-card">
                <div class="card-body">
                    <h2>Welcome, {{Session::get('name')}}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_js')

@endsection


