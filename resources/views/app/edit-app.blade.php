@extends('layouts.main') 
@section('title', 'Edit App')
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
                            <h5>{{ __('Edit')}}</h5>
                            <span>{{ __('Edit Campaign')}}</span>
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
                        <h3>{{ __('Update Campaign')}}</h3>
                    </div>
                    <div class="card-body">
                        
                        <form class="forms-sample" method="POST" action="/apps/update" enctype= "multipart/form-data">
                        @csrf
                            <input type="hidden" name="id" value="{{$data->id}}"/>
                            <input type="hidden" name="thumb" id="setthumb" value="{{$data->image}}"/>
                            <input type="hidden" name="apptype" id="apptype" value="{{$type}}"/>

                            <div class="form-group row" id="divplay">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Play Store URL')}}</label>
                                <div class="col-sm-8">
                                    <input id="seturl" type="text" class="form-control" name="url"  value="{{$data->appurl}}" placeholder="Enter App Link" >
                                </div>
                                <div class="col-sm-1" id="btn_search">
                                     <button class="btn btn-primary float-right" id="searchvid">{{ __('Search')}}</button><br><br>
                                </div>
                            </div>
                             <div class="form-group row" id="div_thumb">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Thumbnail')}}</label>
                                <div class="col-sm-9">
                                        <img src="" id="thumb" width="100px" height="100px"/>
                                     </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('App Name')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="name" value="{{$data->app_name}}" placeholder="Enter App Name" required>
                                </div>
                            </div>
                            
                            <div class="form-group row" id="divexter">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('App Icon')}}</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="icon"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Install Coin')}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control" name="coin" value="{{$data->points}}" placeholder="User get coin when app install" required>
                                </div>
                             </div>
                             
                             <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Count of Users, who will Install Apps (Note: 0 = unlimited)')}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control" name="task_limit" value="{{$data->task_limit}}" placeholder="Count of Users, who will Install Apps" required>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Packgae Name')}}</label>
                                <div class="col-sm-9">
                                    <input id="package" type="text" class="form-control" name="package" value="{{$data->url}}" placeholder="Enter App package name example : com.app.whatsapp" required>
                                    </div>
                             </div>

                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('App Instruction')}}</label>
                                <div class="col-sm-9">
                                <textarea class="ckeditor form-control" name="detail" required>{{$data->details}}</textarea>
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
          <script>
         
        $(document).ready(function()
        {
            
         var type =$("#apptype").val();  
         console.log("type--"+type);
         if(type=="play"){
               $('#btn_search').show();
               var url=$('#seturl').val();
                $('#url').val(url);
         
             var imgPath=$('#setthumb').val();
             $("#thumb").attr("src",imgPath); 
         }else{
           
            $('#btn_search').hide(); 
            $('#div_thumb').hide(); 
         }
             
         });  
         
      
    

       $( "#searchvid" ).click(function() {
            var url=$('#url').val();
            $('#seturl').val(url);
            var base_url = window.location.origin;
            $.ajax({
            url: base_url+'/appinfo',
            type: "POST",
            data:{
                url:url
            },
            success: function (data) {
                console.log(data)
              if(data.status==1){
                 var imgPath=data.appicon;
                 $('#setthumb').val(imgPath);
                 $('#name').val(data.appname);
                 $("#thumb").attr("src", imgPath);
                $('#package').val(url.replace("https://play.google.com/store/apps/details?id=",""));
                }else{
                    swal("No Result Found")
                }
            },
          });
            
      
       });
       </script>
    @endpush
@endsection
