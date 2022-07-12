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
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Transaction')}}</h5>
                            <span>{{ __('List of Transaction')}}</span>
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
                                <a href="#">{{ __('Transaction')}}</a>
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
                     <div class="card-header"><h3>{{ __('User Activity')}}</h3> <span style="position: absolute; right: 0; margin-right:300px; margin-top:-30px;" class="badge badge-dark"></span>
                        <div class="dropdown" style="position: absolute; right: 0; margin-right:30px; margin-top:-30px;">
                            <div class="row">
                                   <label class="form-label" style="margin-top:15px;">Transaction Filter</label><br>
                                  <input type="date" id="startdate"  class="form-control m-2" style="width:200px;"/><br>
                                  <input type="date"  class="form-control m-2"  style="width:200px;" id="enddate"/><br>
                                  <button class="btn btn-danger dropdown-toggle m-2" type="button" id="search" >
                                        Search </i>
                            </div> 
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="trans_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('sr no.')}}</th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Amount')}}</th>
                                    <th>{{ __('Type')}}</th>
                                    <th>{{ __('Remark')}}</th>
                                    <th>{{ __('Remained Coin')}}</th>
                                    <th>{{ __('Offerwall')}}</th>
                                    <th>{{ __('Campaign ID')}}</th>
                                    <th>{{ __('IP')}}</th>
                                    <th>{{ __('Date')}}</th>
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
     @include('model')
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/layouts.js') }}"></script>

    <!--server side users table script-->
    <script>
        
        var searchable = [];
        var selectable = []; 
        
        var dTable = $('#trans_table').DataTable({

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
                url: 'transaction/data',
                type: "get"
            },
            columns: [
                {data:'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
                {data:'name', name: 'name', orderable: false, searchable: false},
                {data:'amount', name: 'amount'},
                {data:'tran_type', name: 'tran_type'}, // add column name
                {data:'remarks', name: 'remarks'},
                {data:'remained_balance', name: 'remained_balance'},
                {data:'offerwall_type', name: 'offerwall_type'},
                {data:'eventId', name: 'eventId'},
                {data:'ip', name: 'ip'}, // add column name
                {data:'inserted_at', name: 'inserted_at'},
                {data:'action', name: 'action', searchable: false}

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
            ],
            initComplete: function () {
                var api =  this.api();
                api.columns(searchable).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    input.setAttribute('placeholder', $(column.header()).text());
                    input.setAttribute('style', 'width: 140px; height:25px; border:1px solid whitesmoke;');

                    $(input).appendTo($(column.header()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });

                    $('input', this.column(column).header()).on('click', function(e) {
                        e.stopPropagation();
                    });
                });

                api.columns(selectable).every( function (i, x) {
                    var column = this;

                    var select = $('<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">'+$(column.header()).text()+'</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function(e){
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column.search(val ? '^'+val+'$' : '', true, false ).draw();
                            e.stopPropagation();
                        });

                    $.each(dropdownList[i], function(j, v) {
                        select.append('<option value="'+v+'">'+v+'</option>')
                    });
                });
            }
        }); 
        
         $('#search').click(function(){
             console.log($('#startdate').val()+
            $('#enddate').val())
        table = $('#trans_table').DataTable();
         table.destroy();
         
          var searchable = [];
    var selectable = []; 
  
    var dTable = $('#trans_table').DataTable({

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
            url: '/transactionbydate',
            type: "POST",
            data:{
            startdate:$('#startdate').val(),
            enddate:$('#enddate').val()
            }
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
    });
        
    </script>
    
    @endpush
@endsection
