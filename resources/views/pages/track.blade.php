@extends('layouts.main') 
@section('title', 'User Transaction')
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
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Transaction')}}</a>
                                <input type="hidden" id="id" value="{{$user->cust_id}}"/>
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
              <div class="col-xl-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                         @if($user->type=="email")
                                <a target="blank" href="{{url('images/user/'.$user->profile)}}" class="rounded-circle"><img src="{{url('images/user/'.$user->profile)}}" alt="user image" class="rounded-circle img-60 align-top mr-15"></a>  
                           @else
                               <a target="blank" href="{{$user->profile}}" class="rounded-circle"><img src="{{$user->profile}}" alt="user image" class="rounded-circle img-60 align-top mr-15"></a>  
                            @endif
                        </div>
                    </div>
                    <hr class="mb-0"> 
                    <div class="card-body"> 
                       
                        <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label"><span class="badge badge-dark" >User Name </spn></label>
                                <div class="col-sm-9">
                                     <input  type="text" class="form-control" value="{{$user->name}}">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label"><span class="badge badge-dark" >Email </spn></label>
                                <div class="col-sm-9">
                                     <input  type="text" class="form-control" value="{{$user->email}}">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label"><span class="badge badge-dark" >Signed up IP </spn></label>
                                <div class="col-sm-9">
                                     <input  type="text" class="form-control" value="{{$user->ip}}">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label"><span class="badge badge-dark" >Coin </spn></label>
                                <div class="col-sm-9">
                                     <input  type="text" class="form-control" value="{{$user->balance}}">
                                </div>
                        </div>
                        <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label"><span class="badge badge-dark" >Country </spn></label>
                                <div class="col-sm-9">
                                     <input  type="text" class="form-control" value="{{$user->country}}">
                                </div>
                        </div>
                        <hr class="mb-0"> 
                        <div class="table-actions">
                                <button type="button" class="btn btn-info m-2 add-coin" data-id="{{$user->cust_id}}" ><i class="ik ik-plus"></i>Add Coin</button>
                                <button type="button" class="btn btn-warning m-2 send-noti" data-id="{{$user->cust_id}}" ><i class="ik ik-bell"></i>Send Notification</button>
                                <button type="button" class="btn btn-danger m-2 delete-trans" data-id="{{$user->cust_id}}" ><i class="ik ik-trash"></i>Delete All Transaction</button>
                                <button type="button" class="btn btn-danger m-2 remove-user" data-id="{{$user->cust_id}}" ><i class="ik ik-trash"></i>Delete User</button>
                            </div>
                    </div>
                </div>
            </div>
                <div class="col-xl-9 col-md-9">
                    <div class="col-xl-12 col-md-12">
                    <div class="card p-3">
                        <div class="card-header"><h3>{{ __('Withdrawals History')}}</h3>
                        <div class="dropdown" style="position: absolute; right: 0; margin-right:30px; margin-top:-30px;">
                              <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action  <i class="ik ik-chevron-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                              
                                <a class="dropdown-item" href="#" id="delete" data-id="request">{{ __('Delete')}}</a>
                            </div>
                        </div> </div>
                        <div class="card-body">
                            <table id="user_redeem" class="table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="sub_chk_all"></th>
                                        <th>{{ __('User')}}</th>
                                        <th>{{ __('Request To')}}</th>
                                        <th>{{ __('Coin Used')}}</th>
                                        <th>{{ __('Type')}}</th>
                                        <th>{{ __('IP')}}</th>
                                        <th>{{ __('Request Date')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>

                   <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('User Activity')}}</h3> <span style="position: absolute; right: 0; margin-right:300px; margin-top:-30px;" class="badge badge-dark">Account Creded IP => {{$user->ip}}</span>
                    <div class="dropdown" style="position: absolute; right: 0; margin-right:30px; margin-top:-30px;">
                              <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action  <i class="ik ik-chevron-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                              
                                <a class="dropdown-item" href="#" id="delete" data-id="trans">{{ __('Delete')}}</a>
                            </div>
                        </div> 
                    </div>
                    <div class="card-body">
                        <table id="user_transe" class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="sub_chk_all"></th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Amount')}}</th>
                                    <th>{{ __('Type')}}</th>
                                    <th>{{ __('Remained Coin')}}</th>
                                    <th>{{ __('Remark')}}</th>
                                    <th>{{ __('IP')}}</th>
                                    <th>{{ __('Date')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-header"><h3>{{ __('Activity Log')}}</h3>
                    <div class="dropdown" style="position: absolute; right: 0; margin-right:30px; margin-top:-30px;">
                              <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action  <i class="ik ik-chevron-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                              
                                <a class="dropdown-item" href="#" id="delete" data-id="log">{{ __('Delete')}}</a>
                            </div>
                        </div> 
                    </div>
                    <div class="card-body">
                        <table id="user_log" class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="sub_chk_all"></th>
                                    <th>{{ __('type')}}</th>
                                    <th>{{ __('Remark')}}</th>
                                    <th>{{ __('Date')}}</th>
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
            
            
            
            
        </div>
    </div>
    @include('model')
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
            <script src="{{ asset('js/layouts.js') }}"></script>
    <!--server side users table script-->
    <script>
        

    var id= $('#id').val();
        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#user_redeem').DataTable({
                
            order: [],
            lengthMenu: [[5, 10, 20, 30, -1], [5, 10, 20, 30, "All"]],
            processing: true,
            responsive: false,
            serverSide: true,
            processing: true,
            language: {
              processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
            },
            scroller: {
                loadingIndicator: false
            },
            pagingType: "full_numbers",
            dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
            ajax: {
                url: '/request/'+id,
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false,"searchable": false},
                {data:'name', name: 'name', orderable: false, searchable: false},
                {data:'mobile_no', name: 'mobile_no'},
                {data:'amount', name: 'amount'}, // add column name
                {data:'type', name: 'type'},
                {data:'ip', name: 'ip'},
                {data:'date', name: 'date'}
    
            ],
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-sm btn-info',
                    title: 'Users Transaction',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    className: 'btn-sm btn-success',
                    title: 'Pending Request',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    className: 'btn-sm btn-warning',
                    title: 'Pending Request',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible',
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn-sm btn-primary',
                    title: 'Pending Request',
                    pageSize: 'A2',
                    header: false,
                    footer: true,
                    exportOptions: {
                        // columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    className: 'btn-sm btn-default',
                    title: 'Pending Request',
                    // orientation:'landscape',
                    pageSize: 'A2',
                    header: true,
                    footer: false,
                    orientation: 'landscape',
                    exportOptions: {
                        // columns: ':visible',
                        stripHtml: false
                    }
                }
            ]
    });
 
 
    var searchable = [];
    var selectable = []; 
  
    var dTable = $('#user_transe').DataTable({

        order: [],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        processing: true,
        responsive: false,
        serverSide: true,
        processing: true,
        language: {
          processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
        },
        scroller: {
            loadingIndicator: false
        },
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
        ajax: {
            url: '/transaction/'+id,
            type: "get"
        },
        columns: [
            {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false,"searchable": false},
            {data:'name', name: 'name', orderable: false, searchable: true},
            {data:'amount', name: 'amount'},
            {data:'tran_type', name: 'tran_type'}, // add column name
            {data:'remained_balance', name: 'remained_balance'},
            {data:'remarks', name: 'remarks'},
            {data:'ip', name: 'ip'},
            {data:'inserted_at', name: 'inserted_at'}

        ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-sm btn-info',
                title: 'Users Transaction',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'csv',
                className: 'btn-sm btn-success',
                title: 'Users Transaction',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-sm btn-warning',
                title: 'Users Transaction',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible',
                }
            },
            {
                extend: 'pdf',
                className: 'btn-sm btn-primary',
                title: 'Users Transaction',
                pageSize: 'A2',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'print',
                className: 'btn-sm btn-default',
                title: 'Users Transaction',
                // orientation:'landscape',
                pageSize: 'A2',
                header: true,
                footer: false,
                orientation: 'landscape',
                exportOptions: {
                    // columns: ':visible',
                    stripHtml: false
                }
            }
        ]
    });
        console.log(window.location.origin+'userlog/');
     var searchable = [];
    var selectable = []; 
  
    var dTable = $('#user_log').DataTable({
        order: [],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        processing: true,
        responsive: false,
        serverSide: true,
        processing: true,
        language: {
          processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
        },
        scroller: {
            loadingIndicator: false
        },
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
        ajax: {
            url: window.location.origin+'/userlog/'+id,
            type: "get"
        },
        columns: [
            {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false,"searchable": false},
            {data:'type', name: 'type', orderable: false, searchable: true},
            {data:'remark', name: 'remark'},
            {data:'created_at', name: 'created_at'}

        ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-sm btn-info',
                title: 'Users Transaction',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'csv',
                className: 'btn-sm btn-success',
                title: 'Users Transaction',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-sm btn-warning',
                title: 'Users Transaction',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible',
                }
            },
            {
                extend: 'pdf',
                className: 'btn-sm btn-primary',
                title: 'Users Transaction',
                pageSize: 'A2',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'print',
                className: 'btn-sm btn-default',
                title: 'Users Transaction',
                // orientation:'landscape',
                pageSize: 'A2',
                header: true,
                footer: false,
                orientation: 'landscape',
                exportOptions: {
                    // columns: ':visible',
                    stripHtml: false
                }
            }
        ]
    });
    </script>
    @endpush
@endsection
