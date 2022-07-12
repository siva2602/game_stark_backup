@extends('layouts.main') 
@section('title', 'Search User')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Users')}}</h5>
                            <span>{{ __('List of users')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Users')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                <div class="card p-3">
                       <!--<form class="forms-sample" method="POST" action="/user/search" enctype= "multipart/form-data">-->
                        @csrf
                            <div class="form-group row" style="margin-top:20px;">
                                 <div class="col-sm-2"> </div>
                                <label for="exampleInputUsername2" class="col-sm-1 col-form-label">{{ __('Search User')}}</label>
                                <div class="col-sm-6">
                                     <input type="text" class="form-control" id="name" name="names" placeholder="Search User by email , name , Ip , Refer Code , Country Iso Code" required>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-dark search" >{{ __('Search')}}</button>
                                </div>
                            </div>
                        <!--</form>     -->
                    <div class="card-body">
                        <table id="search_table" class="table">
                            <thead>
                                <tr>
                                    <th style="width:20px;">{{ __('s no.')}}</th>
                                    <th>{{ __('Profile')}}</th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Email')}}</th>
                                    <th style="width:50px;">{{ __('Balance')}}</th>
                                    <th style="width:30px;">{{ __('Country')}}</th>
                                    <th>{{ __('IP')}}</th>
                                    <th style="width:50px;">{{ __('Status')}}</th>
                                    <th style="width:50px;">{{ __('Registration')}}</th>
                                    <th style="width:400px;" >{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="justify-content-center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('model')

    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/layouts.js') }}"></script>
    <script>
    $(document).ready(function()
        {
            table = $('#search_table').DataTable();
            table.destroy();
        });
        
    </script>

    @endpush
@endsection
