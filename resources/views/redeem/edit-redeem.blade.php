@extends('layouts.main') 
@section('title', 'Edit Redeem')
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
                        <h3>{{ __('Edit  Rewards')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/payment-options/update" enctype= "multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$redeem->id}}"/>
                        
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Redeem Title')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="name" value="{{$redeem->title}}" placeholder="Name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Coin Required for Redeem')}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control" name="coin" value="{{$redeem->points}}" placeholder="eg 1000" required>
                                     </div>
                             </div>

                        
                             <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Placeholder</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="text" class="form-control @error('coin') is-invalid @enderror" name="placeholder" value="{{$redeem->placeholder}}" placeholder="eg ( Enter your email id )" required>
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
                                            <option  value="text"{{ ($redeem->input_type == 'text' ) ? 'selected' : '' }} >Text</option>
                                            <option  value="number"{{ ($redeem->input_type == 'number' ) ? 'selected' : '' }} >Number</option>
                                            <option  value="email"{{ ($redeem->input_type == 'email' ) ? 'selected' : '' }} >Email</option>
                                        </select>
                                   </div>
                           </div>


                            <div class="form-group row">
                                  <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Select Reward Category')}}</label>
                                   <div class="col-sm-9">     
                                        <select class="form-control select2" name="category">
                                            @foreach($cat as $item)
                                            <option value="{{$item->id}}" {{ ($item->id == $redeem->category ) ? 'selected' : '' }} >{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                   </div>
                            </div>
                           
                            <button type="submit" class="btn btn-dark mr-2">{{ __('Update')}}</button>
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
