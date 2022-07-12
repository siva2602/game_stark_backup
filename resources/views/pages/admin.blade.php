@extends('layouts.main') 
@section('title', 'Admin Profile')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Admin Profile')}}</h5>
                            <span>{{ __('admin section')}}</span>
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
                        <h3>{{ __('Admin Information')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/admin/update">
                        @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Email')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="email" value="{{$data->email}}" placeholder="Email" required>                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Old Password')}}</label>
                                <div class="col-sm-9">
                                    <input id="url" type="password" class="form-control " name="oldpass" placeholder="Old Password" required>
                                     </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('New Password')}}</label>
                                <div class="col-sm-9">
                                    <input id="timer" type="password" class="form-control" name="newpas" placeholder="New Password" required>
                                    </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Confirm Password')}}</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control " name="cnpas" placeholder="Confirm Password" required>
                                    </div>
                            </div>

                            <button type="submit" class="btn btn-dark mr-2">{{ __('Save')}}</button>
                        </form>
                    </div>
                  </div>



                  <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Licence Verification')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/verify">
                        @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Licence Code')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="licence" value="{{base64_decode($data->licence)}}" placeholder="Licence Code" required>                                  
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Android Package Name')}}</label>
                                <div class="col-sm-9">
                                    <input id="url" type="text" class="form-control " name="package" value="{{base64_decode($data->package)}}" placeholder="Package Name" required>
                                     </div>
                             </div>

                            <button type="submit" class="btn btn-dark mr-2">{{ __('Verify')}}</button>
                        </form>
                    </div>
                  </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
       <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
         <!--get role wise permissiom ajax script-->
    @endpush
@endsection
