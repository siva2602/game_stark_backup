@extends('layouts.main') 
@section('title', 'General Setting')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <style>
                 textarea { height: auto; }
             </style>
    @endpush

    
    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('General Setting')}}</h5>
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
                        <h3>{{ __('General Setting')}}</h3>
                    </div>
                    <div class="card-body">
                        
                        <form class="forms-sample" method="POST" action="/setting/update" enctype= "multipart/form-data">
                        @csrf
                            <input type=hidden name="oldicon" value="{{$setting[0]->app_icon}}"/>
                            <input type="hidden" name="type" value="general"/>
                            
                      <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#setting" role="tab" aria-controls="pills-setting" aria-selected="true">{{ __('General Setting')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-share-tab" data-toggle="pill" href="#share" role="tab" aria-controls="pills-share" aria-selected="false">{{ __('App Share Message')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-text-tab" data-toggle="pill" href="#text" role="tab" aria-controls="pills-text" aria-selected="false">{{ __('Invite Screen Text')}}</a>
                        </li>
                       
                    </ul>
                            
                <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="referal" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('App Name')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control " name="app_name" value="{{$setting[0]->app_name}}" placeholder="App Name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Author')}}</label>
                                <div class="col-sm-9">
                                    <input id="author" type="text" class="form-control " value="{{$setting[0]->app_author}}"name="author" placeholder="Author" required>
                                    </div>
                             </div>

    
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Email')}}</label>
                                <div class="col-sm-9">
                                    <input id="email" type="text" class="form-control" name="email" value="{{$setting[0]->app_email}}" placeholder="Email" >
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Website')}}</label>
                                <div class="col-sm-9">
                                    <input id="website" type="text" class="form-control" value="{{$setting[0]->app_website}}" name="website" placeholder="https//example.com" >
                                    </div>
                            </div>
                            
                             <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Privacy Policy')}}</label>
                                <div class="col-sm-9">
                                    <input id="website" type="text" class="form-control" value="{{$setting[0]->privacy_policy}}" name="privacy_policy" placeholder="https//example.com">
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Facebook Page')}}</label>
                                <div class="col-sm-9">
                                    <input id="website" type="text" class="form-control " value="{{$setting[0]->fb}}" name="fb" placeholder="https//example.com">
                                    </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Youtube Channel')}}</label>
                                <div class="col-sm-9">
                                    <input id="website" type="text" class="form-control " value="{{$setting[0]->youtube}}" name="youtube" placeholder="https//youtube.com/channel" >
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Telegram Link')}}</label>
                                <div class="col-sm-9">
                                    <input id="website" type="text" class="form-control" value="{{$setting[0]->telegram}}" name="telegram" placeholder="https//example.com" >
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('App ICON')}}</label>
                                <div class="col-sm-9">
                                    <input id="icon" type="file" class="form-control" name="icon" placeholder="Select App ICON" >
                                </div>
                            </div>
                            
                             <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('About Us')}}</label>
                                <div class="col-sm-9">
                                <textarea class="ckeditor form-control" name="detail" required>{{$setting[0]->app_description}}</textarea>
                                </div>
                            </div>
                              <button type="submit" class="btn btn-dark mr-2 float-right">{{ __('Update')}}</button>
                            
                            </div>
                            </div>
                            
                       <div class="tab-pane fade" id="share" role="tabpanel" aria-labelledby="pills-share-tab">
                            <div class="card-body ">
                                 <br>       

                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('App Share Message')}}</label>
                                <div class="col-sm-9">
                                <textarea class="ckeditor form-control" name="refer_msg" required>{{$setting[0]->refer_msg}}</textarea>
                                </div>
                            </div>
                                <button type="submit" class="btn btn-dark mr-2 float-right">{{ __('Update')}}</button>
                         </div>  
                         </div>  
                            
                          <div class="tab-pane fade" id="text" role="tabpanel" aria-labelledby="pills-text-tab">
                            <div class="card-body ">
                                 <br>       
                                 
                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Invite Screen TEXT')}}</label>
                                <div class="col-sm-9">
                                <textarea class="ckeditor form-control" name="refer_text"  required>{{$setting[0]->refer_text}}</textarea>
                                </div>
                            </div>
                        
                            <button type="submit" class="btn btn-dark mr-2 float-right">{{ __('Update')}}</button>
                        </form>
                    </div>
                  </div>
                  </div>
              </div>
        </div>
    </div>
    </div>
    </div>
    <!-- push external js -->
    @push('script') 
<script src="https://cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<script>

</script>
         <!--get role wise permissiom ajax script-->
    @endpush
@endsection
