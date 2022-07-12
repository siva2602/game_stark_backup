@extends('layouts.main') 
@section('title', 'Payment Options')
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
                            <h5>{{ __('Rewards Category')}}</h5>
                            <span>{{ __('List of Reward Category')}}</span>
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
                                <a href="#">{{ __('Rewards')}}</a>
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
                    <a class="btn btn-dark btn-sm" href="/reward-cat/create">{{ __('Create Category')}}</a>
                    </h3></div>
                    <div class="card-body">
                        <table id="redeemcat_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Sr no')}}</th>
                                    <th>{{ __('Icon')}}</th>
                                    <th>{{ __('Category')}}</th>
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
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/layouts.js') }}"></script>
    
    <script>
         var searchable = [];
    var selectable = []; 
    
    var dTable = $('#redeemcat_table').DataTable({

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
            url: 'reward-cat/list',
            type: "get"
        },
        columns: [
            {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false,"searchable": false},
            {data:'image', name: 'image' ,"searchable": false},
            {data:'name', name: 'name'},
            {data:'status', name: 'status' , "searchable": false},
            {data:'action', name: 'action',"searchable": false}

        ]
    });
    </script>
     @endpush
@endsection
