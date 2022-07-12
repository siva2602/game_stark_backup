@extends('layouts.main') 
@section('title', 'Edit Website')
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
                         <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Link')}}</label>
                                <div class="col-sm-9">
                                    <input id="url" type="text" class="form-control @error('url') is-invalid @enderror"   value="{{$web->url}}" name="url" placeholder="eg : http://google.com" required>
                                        <div class="help-block with-errors" ></div>
                                        @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                     </div>
                             </div>
                        
							<button class="btn btn-primary float-right" id="searchvid">{{ __('Search')}}</button><br><br>
							
                        <form class="forms-sample" method="POST" action="/websites/update">
                        @csrf
                        <input type="hidden" name="id" value="{{$web->id}}"/>
                        <input type="hidden" name="url" id="seturl" value="{{$web->url}}"/>
                        <input type="hidden" name="thumb" id="setthumb" value="{{$web->thumb}}"/>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Thumb')}}</label>
                                <div class="col-sm-9">
                                        <img src="" id="thumb" width="75px" height="75px" class="img-thumbnail"/>
                                     </div>
                             </div>
                           
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Title')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{$web->title}}" placeholder="Enter Title" required>
                                <div class="help-block with-errors"></div>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Timer')}}</label>
                                <div class="col-sm-9">
                                    <input id="timer" type="text" class="form-control @error('package') is-invalid @enderror" name="timer" value="{{$web->timer}}" placeholder="Enter Timer Value in minute eg 1" required>
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
                                    <input id="point" type="number" class="form-control @error('url') is-invalid @enderror" name="point" value="{{$web->point}}" placeholder="Coin eg:4" required>
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
                                    <input id="coin" type="number" class="form-control" name="task_limit" value="{{$web->task_limit}}" placeholder="Count of Users, who will Visit Website" required>
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
           var url=$('#setthumb').val();
           $("#thumb").attr("src", url); 
        }); 
        
        function getWebInfo(urls) {
           $.ajax({
              url: "https://textance.herokuapp.com/title/"+urls,
              complete: function(data) {
                $('#name').val(data.responseText);
              }
        }); 
        }
      
       $( "#searchvid" ).click(function() {
            var url=$('#url').val();
            $('#seturl').val(url);
            var imgPath='https://www.google.com/s2/favicons?sz=64&domain_url='+url;
             $('#setthumb').val(imgPath);
             $("#thumb").attr("src", imgPath);
             getWebInfo(url);
       });
      
      </script>
    @endpush
@endsection
