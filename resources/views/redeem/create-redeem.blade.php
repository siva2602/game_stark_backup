@extends('layouts.main') 
@section('title', 'Redeem Option')
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
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Add Redeem')}}</h5>
                            <span>{{ __('Create Reward')}}</span>
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
                        <h3>{{ __('Fill Details')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/payment-options/create" enctype= "multipart/form-data">
                        @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Redeem Title')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Name" required>
                                <div class="help-block with-errors"></div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Coin Required for Redeem')}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control @error('coin') is-invalid @enderror" name="coin" value="" placeholder="eg 1000" required>
                                        <div class="help-block with-errors" ></div>
                                        @error('coin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                             </div>
                             
                             <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Placeholder</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="text" class="form-control @error('coin') is-invalid @enderror" name="placeholder" value="" placeholder="eg ( Enter your email id )" required>
                                        <div class="help-block with-errors" ></div>
                                        @error('coin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                             </div>

                            <div class="form-group row">
                                  <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Input Type')}}</label>
                                   <div class="col-sm-9">     
                                        <select class="form-control select2" name="input_type">
                                            <option  value="text">Text</option>
                                            <option  value="number">Number</option>
                                            <option  value="email">Email</option>
                                        </select>
                                   </div>
                           </div>

                             <div class="form-group row">
                                  <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Select Reward Category')}}</label>
                                   <div class="col-sm-9">     
                                        <select class="form-control select2" name="category">
                                            @foreach($cat as $item)
                                            <option  value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                   </div>
                           </div>
                           
                            <button type="submit" class="btn btn-dark mr-2">{{ __('Add')}}</button>
                     
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
