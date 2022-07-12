@extends('layouts.main') 
@section('title', 'Security Setting')
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
                            <h5>{{ __('Security Setting')}}</h5>
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
                        <h3>{{ __('Security')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/setting/app-setting" enctype= "multipart/form-data">
                        @csrf
                        <input type="hidden" name="type" value="security"/>
                        
                           <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('User can create Max Account with ONE IP Address  :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="number" class="form-control " name="oneip_device" value="{{$setting[0]->oneip_device}}" placeholder="3,5" required>
                                </div>
                            </div>
                        
                        <div class="col-lg-12">
                        <div class="row">
                              <div class="form-group row col-sm-5" style="margin-left:20px; border: 1px solid lightgray; padding:10px; border-radius:5px;">
                                <img src="{{url('img/onedevice.png')}}" alt="user image" class="rounded img-40 align-top mr-15">
                                <div class="col-sm-8" >
                                      <a href="#!"><h6>{{ __('One Device One Account')}}</h6></a>
                                    <p class="text-muted mb-0">{{ __('User Can Create Only One Account in one device.')}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="onedevice" {{ ($setting[0]->onedevice == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round">
                                    </label> 
                                 </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="form-group row col-sm-5" style="margin-left:20px; border: 1px solid lightgray; padding:10px; border-radius:5px;">
                                <img src="{{url('img/vpn.png')}}" alt="user image" class="rounded img-40 align-top mr-15">
                                <div class="col-sm-8" >
                                      <a href="#!"><h6>{{ __('Auto Ban VPN Detection')}}</h6></a>
                                    <p class="text-muted mb-0">{{ __('Auto ban account User Attemp to use Vpn.')}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="auto_banvpn_user" {{ ($setting[0]->auto_banvpn_user == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round">
                                    </label> 
                                 </div>
                            </div>
                            
                            
                          <div class="form-group row col-sm-5" style="margin-left:20px; border: 1px solid lightgray; padding:10px; border-radius:5px;">
                                <img src="{{url('img/vpn.png')}}" alt="user image" class="rounded img-40 align-top mr-15">
                                <div class="col-sm-8" >
                                      <a href="#!"><h6>{{ __('Block Vpn Access')}}</h6></a>
                                    <p class="text-muted mb-0">{{ __('User Cannot Access App with Vpn.')}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="block_vpn" {{ ($setting[0]->block_vpn == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round">
                                    </label> 
                                 </div>
                            </div>
                             
                            
                            <div class="col-sm-1"></div>

                            <div class="form-group row col-sm-5" style="margin-left:20px; border: 1px solid lightgray; padding:10px; border-radius:5px;">
                                <img src="{{url('img/vpnmonitor.png')}}" alt="user image" class="rounded img-40 align-top mr-15">
                                <div class="col-sm-8" >
                                      <a href="#!"><h6>{{ __('Monitor Vpn Access')}}</h6></a>
                                    <p class="text-muted mb-0">{{ __('Silently Detect How many user attempted to use Vpn.')}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="vpn_monitor" {{ ($setting[0]->vpn_monitor == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round">
                                    </label> 
                                 </div>
                            </div>
                            
                            
                            <div class="form-group row col-sm-5" style="margin-left:20px; border: 1px solid lightgray; padding:10px; border-radius:5px;">
                                <img src="{{url('img/blockroot.png')}}" alt="user image" class="rounded img-40 align-top mr-15">
                                <div class="col-sm-8" >
                                      <a href="#!"><h6>{{ __('Block Rooted Devices')}}</h6></a>
                                    <p class="text-muted mb-0">{{ __('App will not work on Rooted device if this option is activated')}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="block_root_device" {{ ($setting[0]->block_root_device == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round">
                                    </label> 
                                 </div>
                            </div>
                         <div class="col-sm-1"></div>

                            
                              <div class="form-group row col-sm-5" style="margin-left:20px; border: 1px solid lightgray; padding:10px; border-radius:5px;">
                                <img src="{{url('img/blockroot.png')}}" alt="user image" class="rounded img-40 align-top mr-15">
                                <div class="col-sm-8" >
                                      <a href="#!"><h6>{{ __('Auto Ban Rooted Device')}}</h6></a>
                                    <p class="text-muted mb-0">{{ __('Auto ban account who used in rooted device.')}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="auto_banroot" {{ ($setting[0]->auto_banroot == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round">
                                    </label> 
                                 </div>
                            </div>
                          
                             <div class="form-group row col-sm-5" style="margin-left:20px; border: 1px solid lightgray; padding:10px; border-radius:5px;">
                                <img src="{{url('img/ads.png')}}" alt="user image" class="rounded img-40 align-top mr-15">
                                <div class="col-sm-8" >
                                      <a href="#!"><h6>{{ __('Auto Ban for Adblocker Detection')}}</h6></a>
                                    <p class="text-muted mb-0">{{ __('Auto Ban User who attemps to use Adblocker.')}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="auto_banadblock" {{ ($setting[0]->auto_banadblock == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round">
                                    </label> 
                                 </div>
                            </div>
                           <div class="col-sm-1"></div>  
                            <div class="form-group row col-sm-5" style="margin-left:20px; border: 1px solid lightgray; padding:10px; border-radius:5px;">
                                <img src="{{url('img/vpnmonitor.png')}}" alt="user image" class="rounded img-40 align-top mr-15">
                                <div class="col-sm-8" >
                                      <a href="#!"><h6>{{ __('Monitor Adblock Access')}}</h6></a>
                                    <p class="text-muted mb-0">{{ __('Silently Detect How many user attempted to use AdBlocker.')}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="monitor_adblock" {{ ($setting[0]->monitor_adblock == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round">
                                    </label> 
                                 </div>
                            </div>
                            
                             
                            <div class="form-group row col-sm-5" style="margin-left:20px; border: 1px solid lightgray; padding:10px; border-radius:5px;">
                                <img src="{{url('img/globe.png')}}" alt="user image" class="rounded img-40 align-top mr-15">
                                <div class="col-sm-8" >
                                      <a href="#!"><h6>{{ __('Auto Ban for Country Change')}}</h6></a>
                                    <p class="text-muted mb-0">{{ __('Auto ban account user access from different country.')}}</p>
                                </div>
                                <div class="col-sm-2">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="auto_bancountry_change" {{ ($setting[0]->auto_bancountry_change == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round">
                                    </label> 
                                 </div>
                            </div>
                                                         <div class="col-sm-1"></div>

                       
                            
                            </div>
                        </div>
                      
                            
                            
                            <button type="submit" class="btn btn-dark btn-xl mr-2 float-right">{{ __('Update Security')}}</button>
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
