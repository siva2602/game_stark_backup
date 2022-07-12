@extends('layouts.main') 
@section('title', 'Edit Network')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/switches.css') }}">

    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Edit AdNetwork')}}</h5>
                            <span>{{ __('')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <!-- <a href="#">{{ __('Add User')}}</a> -->
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
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Network Configuration')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/offerwall/update" enctype= "multipart/form-data">
                        @csrf
                       <input type="hidden" name="id" value="{{$data->id}}"/>
                       <input type="hidden" name="oldimage" value="{{$data->thumb}}"/>
                       <input type="hidden" name="offerwall_type" value="sdk"/>

                        <div class="form-group row">
                            <div class="col-sm-4">
                               <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Network Name')}}</label>
                                <div class="col-sm-12">
                                    <input id="url" type="text" class="form-control" name="title" value="{{$data->title}}"  placeholder="Network name or any name you want" required>
                                </div> 
                            </div>
                            
                            <div class="col-sm-7">
                               <label for="exampleInputPassword2" class="col-sm-12 col-form-label">{{ __('Offerwall Description')}}</label>
                                <div class="col-sm-12">
                                    <input id="url" type="text" class="form-control" name="description" value="{{$data->description}}" placeholder="Offer Description" required>
                                </div> 
                            </div>    
                            </div>
                        
                        
                         <div class="form-group row">
                            <div class="col-sm-4">
                               <label for="exampleInputPassword2" class="col-sm-12 col-form-label">{{ __('Offerwall Network Original Name')}}</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="offername" value="{{$offername}}" placeholder="Offerwall Original Name like= tapjoy,fyber " readonly>
                                </div> 
                            </div>
                            
                            <div class="col-sm-7">
                               <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Offerwall Status')}}</label>
                                <div class="col-sm-12">
                                    <label class="switch s-icons s-outline s-outline-success mr-2" >
                                            <input type="checkbox" name="status" {{($data->status == '0' ) ? 'checked' : '' }} >
                                            <span class="slider round"></label>
                                </div> 
                            </div>   
                            </div>
                            
                            
                            <div class="form-group row">
                                <div class="col-sm-4">
                                   <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('App ID & Key')}}</label>
                                    <div class="col-sm-12">
                                        <input id="url" type="text" name="appid" class="form-control" value="{{$appid}}"  placeholder="Enter your app id & Key" required>
                                    </div> 
                                </div>
                                
                            <div class="col-sm-7">
                                   <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Placement Name')}}</label>
                                    <div class="col-sm-12">
                                          <input type="text" class="form-control"  name="placement" value="{{$placement}}" placeholder="Enter Placement Name here">
                                    </div> 
                                </div>    
                            </div>

                            <div class="form-group row">
                            <div class="col-sm-4">
                               <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Network Icon')}}</label>
                                <div class="col-sm-12">
                                        <input id="name" type="file" class="form-control" name="icon">
                                </div> 
                            </div>
                            
                            <div class="col-sm-7">
                                   <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Security Key')}}</label>
                                    <div class="col-sm-12">
                                          <input type="text" class="form-control"  name="token" value="{{$token}}" placeholder="Security Key optional">
                                    </div> 
                                </div>    
                            </div>
                         
                           <hr style="color:black;">
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('PostBack Setup')}}</label>
                            </div>
                         
                   <div class="form-group row">
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Paramater for <b>User ID</b></label>
                                    <div class="col-sm-12">
                                        <input  type="text" class="form-control" name="userid" value="{{$pb[0]->p_userid}}" required>
                                    </div> 
                                </div>
                                
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>Offer ID</b></label>
                                    <div class="col-sm-12">
                                          <input id="url" type="text" class="form-control"  name="offerid" value="{{$pb[0]->p_campaing_id}}">
                                    </div> 
                                </div>  
                                
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>IP Address</b></label>
                                    <div class="col-sm-12">
                                          <input id="url" type="text" class="form-control" name="ip" value="{{$pb[0]->p_ip}}">
                                    </div> 
                                </div>
                                
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>Reward amount</b></label>
                                    <div class="col-sm-12">
                                          <input id="url" type="text" class="form-control" name="amount" value="{{$pb[0]->p_payout}}"required>
                                  </div> 
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>Offer Name</b></label>
                                    <div class="col-sm-12">
                                        <input  type="text" class="form-control" name="p_offername" placeholder="" >
                                    </div> 
                                </div>
                                </div>

                            <button type="submit" class="btn btn-dark mr-2 float-right">{{ __('Update AdNetwork')}}</button>
                        </form>
                    </div>
                  </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
       <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
         <!--get role wise permissiom ajax script-->
        <script>
         
        
         
        
         </script>
    @endpush
@endsection
