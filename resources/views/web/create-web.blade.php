@extends('layouts.main') 
@section('title', 'Create Website')
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
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Create Websites Campaign')}}</h5>
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
                        <h3>{{ __('Campaign Details')}}</h3>
                    </div>
                    <div class="card-body">
                        
                        
                        <form class="forms-sample" method="POST" action="/websites/create">
                        @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Title')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title" placeholder="Enter Title" required>
                                <div class="help-block with-errors"></div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Link')}}</label>
                                <div class="col-sm-9">
                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="eg : http://google.com" required>
                                        <div class="help-block with-errors" ></div>
                                        @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Timer')}}</label>
                                <div class="col-sm-9">
                                    <input id="timer" type="text" class="form-control @error('package') is-invalid @enderror" name="timer" placeholder="Enter Timer Value in minute eg 1" required>
                                        <div class="help-block with-errors"></div>
                                        @error('timer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Coin')}}</label>
                                <div class="col-sm-9">
                                    <input id="point" type="number" class="form-control @error('url') is-invalid @enderror" name="point" placeholder="Coin eg:4" required>
                                        <div class="help-block with-errors"></div>

                                        @error('point')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Count of Users, who will Visit Website (Note: 0 = unlimited)')}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control" name="task_limit" placeholder="Count of Users, who will Visit Website" value="0" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark mr-2">{{ __('Create')}}</button>
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
