@extends('layouts.main') 
@section('title', 'Ads Setting')
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
                            <h5>{{ __('Ads Setting')}}</h5>
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
                        <h3>{{ __('Ads Setting')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/setting/update" enctype= "multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="ads"/>
                        <div class="form-group row">
                                      <div class="col-sm-1"></div>  
                                      <label for="exampleInput" class="col-lg-2 form-label">{{ __('StaratApp App ID :-')}}</label>
                                       <div class="col-lg-6">     
                                            <input type="text" class="form-control" name="startappid" value="{{$setting[0]->startappid}}" placeholder="">
                                        </div>
                          </div>
                          
                           <div class="form-group row">
                                      <div class="col-sm-1"></div>  
                                      <label for="exampleInput" class="col-lg-2 form-label">{{ __('Unity Game ID :-')}}</label>
                                       <div class="col-lg-6">     
                                            <input type="text" class="form-control" name="unity_gameid" value="{{$setting[0]->unity_gameid}}" placeholder="">
                                        </div>
                          </div>
                          
                          <div class="form-group row">
                                      <div class="col-sm-1"></div>  
                                      <label for="exampleInput" class="col-lg-2 form-label">{{ __('Ad Colony App ID :-')}}</label>
                                       <div class="col-lg-6">     
                                            <input type="text" class="form-control" name="adcolony_appID" value="{{$setting[0]->adcolony_appID}}" placeholder="">
                                        </div>
                          </div>
                          
                          <div class="form-group row">
                                      <div class="col-sm-1"></div>  
                                      <label for="exampleInput" class="col-lg-2 form-label">{{ __('AdColony Zone ID :-')}}</label>
                                       <div class="col-lg-6">     
                                            <input type="text" class="form-control" name="adcolony_zoneid" value="{{$setting[0]->adcolony_zoneid}}" placeholder="">
                                        </div>
                          </div>
                          
             

                        <div class="row">
                            <div class="col-md-4 card">
                                <div class="card-header bg-dark" ><h3 style="color:white;">Banner Ads</h3>
                                  </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                      <label for="exampleInputConfirmPassword2" class="col-sm-12 col-form-label">{{ __('Select Banner Ad Type')}}</label>
                                       <div class="col-sm-12">     
                                            <select class="form-control select2" name="banner_type">
                                                <option value="startapp" {{ ($setting[0]->banner_type == 'startapp' ) ? 'selected' : '' }} >Startapp</option>
                                                <option value="unity" {{ ($setting[0]->banner_type == 'unity' ) ? 'selected' : '' }} >Unity</option>
                                                <option value="applovin" {{ ($setting[0]->banner_type == 'applovin' ) ? 'selected' : '' }} >Applovin</option>
                                            </select>
                                            </div>
                                       </div>
                                       
                                      <div class="form-group row">
                                          <label for="exampleInput" class="col-lg-12 form-label">{{ __('Banner Adunit ( not reiuired for startapp):-')}}</label>
                                           <div class="col-lg-12">     
                                                <input type="text" class="form-control" value="{{$setting[0]->bannerid}}" name="bannerid" placeholder="">
                                            </div>
                                     </div>
                                     </div>
                                </div>
                                
                            <div class="col-md-4 card">
                                <div class="card-header bg-dark" >
                                    <h3 style="color:white;">Interstital Ads</h3>
                                        <div class="" style="position: absolute; right: 0; margin-right:30px;">
                                        <label class="switch s-icons s-outline s-outline-success mr-2" style="float:right;">
                                            <input type="checkbox" name="interstital" {{ ($setting[0]->interstital == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                    </div>
                                  </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                      <label for="exampleInputConfirmPassword2" class="col-sm-12 col-form-label">{{ __('Select Interstital Ad Type')}}</label>
                                       <div class="col-sm-12">     
                                            <select class="form-control select2" name="interstital_type">
                                                <option value="startapp" {{ ($setting[0]->interstital_type == 'startapp' ) ? 'selected' : '' }} >Startapp</option>
                                                <option value="unity" {{ ($setting[0]->interstital_type == 'unity' ) ? 'selected' : '' }} >Unity</option>
                                                <option value="applovin" {{ ($setting[0]->interstital_type == 'applovin' ) ? 'selected' : '' }} >Applovin</option>
                                            </select>
                                            </div>
                                       </div>
                                       
                                      <div class="form-group row">
                                          <label for="exampleInput" class="col-lg-12 form-label">{{ __('Interstital Adunit ( not reiuired for startapp):-')}}</label>
                                           <div class="col-lg-12">     
                                                <input type="text" class="form-control" value="{{$setting[0]->interstital_ID}}" name="interstital_ID" placeholder="">
                                            </div>
                                     </div>
                                     
                                     <div class="form-group row">
                                          <label for="exampleInput" class="col-lg-12 form-label">{{ __('After How many Click Ads Show 1,2,3:-')}}</label>
                                           <div class="col-lg-12">     
                                                <input type="text" class="form-control" name="interstital_count" value="{{$setting[0]->interstital_count}}" placeholder="1,2,3">
                                            </div>
                                     </div>
                                     </div>
                                </div>     

                            <div class="col-md-4">
                                <div class="col-md-12 card">
                                    <div class="card-header bg-dark">
                                        <h3 style="color:white;">Unity Reward </h3>
                                        <div class="" style="position: absolute; right: 0; margin-right:30px;">
                                        <label class="switch s-icons s-outline s-outline-success mr-2" style="float:right;">
                                            <input type="checkbox" name="unity_reward" {{ ($setting[0]->unity_reward == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                    </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                          <label for="exampleInput" class="col-lg-12 form-label">{{ __('Unity Placement ID :-')}}</label>
                                           <div class="col-lg-12">     
                                                <input type="text" class="form-control" value="{{$setting[0]->unity_rewardid}}" name="unity_rewardid" placeholder="">
                                            </div>
                                     </div> 
                                    </div>
                                </div>  
                                     
                                <div class="col-md-12 card">
                                    <div class="card-header bg-dark">
                                        <h3 style="color:white;">Applovin Reward Ads</h3>
                                        <div class="" style="position: absolute; right: 0; margin-right:30px;">
                                        <label class="switch s-icons s-outline s-outline-success mr-2" style="float:right;">
                                            <input type="checkbox" name="applovin_reward" {{ ($setting[0]->applovin_reward == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                    </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                          <label for="exampleInput" class="col-lg-12 form-label">{{ __('Applovin Placement ID :-')}}</label>
                                           <div class="col-lg-12">     
                                                <input type="text" class="form-control" value="{{$setting[0]->applovin_rewardID}}" name="applovin_rewardID" placeholder="">
                                            </div>
                                     </div> 
                                    </div>
                                </div>
                                </div>
                              
                                <div class="col-md-4 ">  
                                <div class="col-md-12 card">
                                    <div class="card-header bg-dark">
                                        <h3 style="color:white;">StartApp Rewarded Ads</h3>
                                        <div class="" style="position: absolute; right: 0; margin-right:30px;">
                                        <label class="switch s-icons s-outline s-outline-success mr-2" style="float:right;">
                                            <input type="checkbox" name="statartapp_reward" {{ ($setting[0]->statartapp_reward == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                    </div>
                                    </div>
                                </div> 
                                
                                <div class="col-md-12 card">
                                    <div class="card-header bg-dark">
                                        <h3 style="color:white;">Adcolony Rewarded Ads</h3>
                                        <div class="" style="position: absolute; right: 0; margin-right:30px;">
                                        <label class="switch s-icons s-outline s-outline-success mr-2" style="float:right;">
                                            <input type="checkbox" name="adcolony_reward" {{ ($setting[0]->adcolony_reward == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                    </div>
                                    </div>
                                </div> 
                                </div>   
                        </div>
                      </div>  
                            <button type="submit" class="btn btn-dark btn-xl mr-2 float-right">{{ __('Update')}}</button>
                        </form>
                    </div>
                  </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script') 
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/form-advanced.js') }}"></script>
 <!--get role wise permissiom ajax script-->
    @endpush
@endsection
