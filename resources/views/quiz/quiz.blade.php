@extends('layouts.main') 
@section('title', 'Quiz')
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
                            <h5>{{ __('Quiz')}}</h5>
                            <span>{{ __('List of Quiz')}}</span>
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
                                <a href="#">{{ __('Quiz')}}</a>
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
                    <a class="btn btn-dark btn-sm" href="/quiz/create">{{ __('Create Quiz')}}</a>
                    <div class="dropdown" style="position: absolute; right: 0; margin-right:30px; margin-top:-30px;">
                              <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action  <i class="ik ik-chevron-down"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a class="dropdown-item" href="#" id="enable" data-id="quiz">{{ __('Enable')}}</a>
                                <a class="dropdown-item" href="#" id="disable" data-id="quiz">{{ __('Disable')}}</a>                       
                                <a class="dropdown-item" href="#" id="delete" data-id="quiz">{{ __('Delete')}}</a>
                            </div>
                        </div>
                    </h3></div>
                    <div class="card-body">
                        <table id="quiz_table" class="table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="sub_chk_all"></th>
                                    <th>{{ __('Question')}}</th>
                                    <th>{{ __('A')}}</th>
                                    <th>{{ __('B')}}</th>
                                    <th>{{ __('C')}}</th>
                                    <th>{{ __('D')}}</th>
                                    <th>{{ __('Answer')}}</th>
                                    <th>{{ __('Coin')}}</th>
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
    
    var dTable = $('#quiz_table').DataTable({

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
            url: 'quiz/list',
            type: "get"
        },
        columns: [
            {data:'DT_RowIndex', name: 'DT_RowIndex', orderable: false,"searchable": false},
            {data:'question', name: 'question'},
            {data:'a', name: 'a'},
            {data:'b', name: 'b'}, // add column name
            {data:'c', name: 'c'}, // add column name
            {data:'d', name: 'd' },
            {data:'answer', name: 'answer' },
            {data:'coin', name: 'coin' ,"searchable": false},
            {data:'status', name: 'status' ,"searchable": false},
            {data:'action', name: 'action' ,"searchable": false}

        ]
    });
    </script>
     @endpush
@endsection
