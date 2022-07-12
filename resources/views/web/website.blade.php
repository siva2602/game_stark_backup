@extends('layouts.main') 
@section('title', 'Websites')
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
                            <h5>{{ __('Websites')}}</h5>
                            <span>{{ __('List of Campaign')}}</span>
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
                                <a href="#">{{ __('websites')}}</a>
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
                    <div class="card-header"><h3>
                    <a class="btn btn-dark btn-sm" href="/websites/create-websites">{{ __('Create Campaign')}}</a>
                        <div class="dropdown" style="position: absolute; right: 0; margin-right:30px; margin-top:-30px;">
                              <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action  <i class="ik ik-chevron-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item" href="#" id="enable" data-id="web">{{ __('Enable')}}</a>
                                <a class="dropdown-item" href="#" id="disable" data-id="web">{{ __('Disable')}}</a>                       
                                <a class="dropdown-item" href="#" id="delete" data-id="web">{{ __('Delete')}}</a>
                            </div>
                        </div> 
                    </h3></div>
                    <div class="card-body">
                        <table id="weblist_table" class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="sub_chk_all"></th>
                                    <th>{{ __('Thumb')}}</th>
                                    <th>{{ __('Title')}}</th>
                                    <th>{{ __('Url')}}</th>
                                    <th>{{ __('Coin')}}</th>
                                    <th>{{ __('Timer')}}</th>
                                    <th>{{ __('Added by')}}</th>
                                    <th>{{ __('View')}}</th>
                                    <th>{{ __('Status')}}</th>
                                    <th>{{ __('Created Date')}}</th>
                                    <th>{{ __('Action')}}</th>
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
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <!--server side users table script-->
    <script src="{{ asset('js/layouts.js') }}"></script>
    <script>
        var searchable = [];
    var selectable = []; 
    
    var dTable = $('#weblist_table').DataTable({

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
            url: 'websites/list',
            type: "get"
        },
        columns: [
            // {data:'serial_no', name: 'serial_no'},
            {data:'DT_RowIndex', name: 'DT_RowIndex' , orderable: false,"searchable": false},
            {data:'thumb', name: 'thumb' ,"searchable": false},
            {data:'title', name: 'title'},
            {data:'url', name: 'url'},
            {data:'point', name: 'point'}, // add column name
            {data:'timer', name: 'timer'},
            {data:'type', name: 'type'},
            {data:'view', name: 'view'},
            {data:'status', name: 'status' },
            {data:'inserted_at', name: 'inserted_at'},
            {data:'action', name: 'action',"searchable": false}

        ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-sm btn-info',
                title: 'Website',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'csv',
                className: 'btn-sm btn-success',
                title: 'Website',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-sm btn-warning',
                title: 'Website',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible',
                }
            },
            {
                extend: 'pdf',
                className: 'btn-sm btn-primary',
                title: 'Website',
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
                title: 'Website',
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
