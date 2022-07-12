@extends('layouts.main') 
@section('title', 'Add App')
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
                            <h5>{{ __('Add App')}}</h5>
                            <span>{{ __('Create new Campaign')}}</span>
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
                        <h3>{{ __('Add Campaign')}}</h3>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('App Type')}}</label>
                                <div class="col-sm-8">
                                    <select name="type" id="apptype" class="form-control">
                                        <option value="play">Play Store App (Detaill Fetch Automatically)</option>
                                        <option value="external">External App Link (Enter app name,icon)</option>
                                    </select>
                                </div>
                                
                        </div>
                        
                        <form class="forms-sample" method="POST" action="/apps/create" enctype= "multipart/form-data">
                        @csrf
                         <input type="hidden" name="url" id="seturl"/>
                         <input type="hidden" name="thumb" id="setthumb"/>
                         <input type="hidden" name="type" id="setapptype"/>
                         
                         <div class="form-group row" id="divplay">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('App URL')}}</label>
                                <div class="col-sm-8">
                                    <input id="url" type="text" class="form-control"  placeholder="Enter App Link" >
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
                          
                          <div class="form-group row" id="divexter">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('App Icon')}}</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" name="icon"/>
                                </div>
                            </div>
                         
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('App Name')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="name" placeholder="Enter App Name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Install Coin')}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control" name="coin" placeholder="User get coin when app install" required>
                                </div>
                             </div>
                             
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Count of Users, who will Install Apps (Note: 0 = unlimited)' )}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control" name="task_limit" placeholder=" 0 = unlimited" value="0" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Packgae Name')}}</label>
                                <div class="col-sm-9">
                                    <input id="package" type="text" class="form-control" name="package"  placeholder="Enter App package name example : com.app.whatsapp" required>
                                    </div>
                             </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('App Instruction')}}</label>
                                <div class="col-sm-9">
                                <textarea class="ckeditor form-control" name="detail" required></textarea>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-dark mr-2">{{ __('Save')}}</button>
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
         
        $(document).ready(function()
        {
            $('#div_thumb').hide();
            $('#btn_search').hide();
            $('#divexter').hide();
            var optVal= $("#apptype option:selected").val();
           $('#setapptype').val(optVal);  
            
        }); 
        
        $('#apptype').change(function() {
           var optVal= $("#apptype option:selected").val();
           $('#setapptype').val(optVal);  
            if(optVal=="play"){
               $('#divexter').hide();  
           }else{
              $('#btn_search').hide();  
              $('#divexter').show();  
           }
        });
    
        function getInfo(urls) {
           
        }
      
       $( "#searchvid" ).click(function() {
            $('#thumb').show();
            var url=$('#url').val();
            $('#seturl').val(url);
            // getInfo(url);
            
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
