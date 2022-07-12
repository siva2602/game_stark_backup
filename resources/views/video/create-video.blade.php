@extends('layouts.main') 
@section('title', 'Add Video')
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
                            <h5>{{ __('Add Video')}}</h5>
                            <span>{{ __('Create Video Campaign')}}</span>
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
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Youtube Video Link')}}</label>
                                <div class="col-sm-9">
                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" value=""  placeholder="eg : http://youtu.be/dQw4w9WgXcQ" required>
                                        <div class="help-block with-errors" ></div>
                                        @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                             </div>
                             
                             
                            
                        <button class="btn btn-primary float-right" id="searchvid">{{ __('Search Video')}}</button><br><br>
                        
                        <form class="forms-sample" method="POST" action="/videos/create" enctype= "multipart/form-data">
                        @csrf
                            <input type="hidden" name="url" id="seturl"/>
                            <input type="hidden" name="thumb" id="setthumb"/>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Thumbnail')}}</label>
                                <div class="col-sm-9">
                                        <img src="" id="thumb" width="300px" height="200px"/>
                                     </div>
                             </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Video Title')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" placeholder="Enter Video Title" required>
                                <div class="help-block with-errors"></div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Video Timer')}}</label>
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
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label">{{ __('Video Watch Coin')}}</label>
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
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Count of Users, who will Watch Video  (Note: 0 = unlimited)')}}</label>
                                <div class="col-sm-9">
                                    <input id="coin" type="number" class="form-control" name="task_limit" placeholder="Count of Users, who will Watch Video" value="0" required>
                                </div>
                            </div>
                            

                            <button type="submit" class="btn btn-dark mr-2">{{ __('Submit')}}</button>
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
            $('#thumb').hide();
        }); 
        
         function YouTubeGetID(url){
               url = url.split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
               return (url[2] !== undefined) ? url[2].split(/[^0-9a-z_\-]/i)[0] : url[0];
        }
        

        function getYouTubeInfo(urls) {
           $.ajax({
              url: "https://textance.herokuapp.com/title/https://youtu.be/"+urls,
              complete: function(data) {
                $('#name').val(data.responseText);
              }
        }); 
        }
    
    
       $( "#searchvid" ).click(function() {
           $('#thumb').show();
            var url=$('#url').val();
            $('#seturl').val(url);
             var video_id = YouTubeGetID(url);
             var imgPath='http://img.youtube.com/vi/'+video_id+'/sddefault.jpg';
             $('#setthumb').val(imgPath);
             $("#thumb").attr("src", imgPath);
             getYouTubeInfo(video_id);
      
       });
       
       
                
        
         </script>
    @endpush
@endsection
