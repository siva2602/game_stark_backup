@extends('layouts.main') 
@section('title', 'Update Mode')
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
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Update Popup & Maintenance')}}</h5>
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
                        <h3>{{ __('Setting')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/setting/update" enctype= "multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="type" value="update"/>
                        <div class="form-group row">
                                      <label for="exampleInput" class="col-lg-3 form-label">{{ __('App Update & Maintenance Popup Show/Hide:- ')}}</label>
                                       <div class="col-lg-8">     
                                        <label class="switch s-icons s-outline s-outline-success mr-2" >
                                            <input type="checkbox" name="up_status" {{ ($setting[0]->up_status == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                        </div>
                          </div>
                        
                        
                        <div class="form-group row">
                                      <label for="exampleInput" class="col-lg-3 form-label">{{ __('Select Mode')}}</label>
                                       <div class="col-lg-8">     
                                            <select name="up_mode" class="form-control">
                                                <option value="update" {{ ($setting[0]->up_mode == 'update' ) ? 'selected' : '' }} >Update Popup ( Update Popup show Force use to Update App )</option>
                                                <option value="maintenance" {{ ($setting[0]->up_mode == 'maintenance' ) ? 'selected' : '' }} >Maintenance Popup ( App will Not Work Show Maintenance Popup ) </option>
                                            </select>
                                        </div>
                          </div>
                          
                        <div class="form-group row">
                                      <label for="exampleInput" class="col-lg-3 form-label">{{ __('Android Version Code')}}</label>
                                       <div class="col-lg-8">     
                                            <input type="number" class="form-control" name="up_version" value="{{$setting[0]->up_version}}" placeholder="1">
                                        </div>
                        </div>
                          
                        <div class="form-group row">
                                      <label for="exampleInput" class="col-lg-3 form-label">{{ __('Message')}}</label>
                                       <div class="col-lg-8">     
                                            <textarea  class="form-control" col="5" rows="5" name="up_msg">
                                               {{$setting[0]->up_msg}}
                                            </textarea>
                                        </div>
                        </div>
                        
                        <div class="form-group row">
                                      <label for="exampleInput" class="col-lg-3 form-label">{{ __('App URL')}}</label>
                                       <div class="col-lg-8">     
                                            <input type="text" class="form-control" name="up_link" value="{{$setting[0]->up_link}}" placeholder="https://play.google.com/store/apps/details?id=com.app.reward">
                                        </div>
                        </div>
                        
                         <div class="form-group row">
                                      <label for="exampleInput" class="col-lg-3 form-label">Cancel Option :- <br>
Cancel button option will show in app update popup</label>
                                       <div class="col-lg-8">     
                                        <label class="switch s-icons s-outline s-outline-success mr-2" >
                                            <input type="checkbox" name="up_btn" {{ ($setting[0]->up_btn == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                        </div>
                          </div>
                        
                      </div>  
                            <button type="submit" class="btn btn-dark btn-xl mr-2 float-right">{{ __('Save')}}</button>
                        </form>
                    </div>
                  </div>
                  </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
      
        <script src="{{ asset('js/form-advanced.js') }}"></script>
 <!--get role wise permissiom ajax script-->
    @endpush
@endsection
