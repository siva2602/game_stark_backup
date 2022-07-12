@extends('layouts.main') 
@section('title', 'Sdk Offers')
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
                            <h5>{{ __('Sdk Offerwalls')}}</h5>
                            <span>{{ __('List of Sdk Offerwalls')}}</span>
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
                                <a href="#">{{ __('Offerwall')}}</a>
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
                    <div class="card-header" ><h3>   
                    <a class="btn btn-dark btn-sm" href="/offerwall/create-offer-sdk">{{ __('Add Network')}}</a>
                        <div class="dropdown" style="position: absolute; right: 0; margin-right:30px; margin-top:-30px;">
                              <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action  <i class="ik ik-chevron-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item" href="#" id="enable" data-id="offerwall">{{ __('Enable')}}</a>
                                <a class="dropdown-item" href="#" id="disable" data-id="offerwall">{{ __('Disable')}}</a>                       
                            </div>
                        </div>    
                    </h3></div>
                    <div class="card-body">
                        <table id="apps_table" class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="sub_chk_all"></th>
                                    <th>{{ __('Icon')}}</th>
                                    <th>{{ __('Offerwall Name')}}</th>
                                    <th>{{ __('Description')}}</th>
                                    <th>{{ __('Status')}}</th>
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
    
    var dTable = $('#apps_table').DataTable({

        order: [],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        processing: true,
        responsive: true,
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
            url: '/offerwall/list/sdk',
            type: "get"
        },
        columns: [
            // {data:'serial_no', name: 'serial_no'},
            {data:'DT_RowIndex', name: 'DT_RowIndex',"searchable": false,orderable: false},
            {data:'thumb', name: 'thumb',"searchable": false},
            {data:'title', name: 'title'},
            {data:'description', name: 'description',"searchable": false}, // add column name
            {data:'status', name: 'status'},
            {data:'action', name: 'action',"searchable": false}

        ],
       
        buttons: [
            {
                extend: 'copy',
                className: 'btn-sm btn-info',
                title: 'Videos',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'csv',
                className: 'btn-sm btn-success',
                title: 'Videos',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-sm btn-warning',
                title: 'Videos',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible',
                }
            },
            {
                extend: 'pdf',
                className: 'btn-sm btn-primary',
                title: 'Videos',
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
                title: 'Videos',
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
    
     $("body").on("click",".copy-postback",function(){
        var current_object = $(this);
        var id = current_object.attr('data-id');
        navigator.clipboard.writeText(id);
        id.remove();  
       });
    </script>
   
    @endpush
@endsection
