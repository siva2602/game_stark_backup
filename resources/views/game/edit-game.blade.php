@extends('layouts.main') 
@section('title', 'Edit Quiz')
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
                        <h3>{{ __('Edit  Quiz')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/quiz/update" enctype= "multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$game->id}}"/>
                        <input type="hidden" name="oldimage" value="{{$game->image}}"/>
                            
                          <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Question thumbnail')}}</label>
                                <div class="col-sm-9">
                                    <input id="icon" type="file" class="form-control" name="icon" placeholder="Select Thumbnail" required>
                                </div>
                            </div>
                            
                             <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Title')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="title" value="{{$game->title}}" placeholder="Game Title" required>
                              
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Link')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="link" value="{{$game->link}}" placeholder="Game Link" required>
                              
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
