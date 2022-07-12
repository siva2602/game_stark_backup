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
                        <input type="hidden" name="id" value="{{$quiz->id}}"/>

                             <div class="form-group row">
                                  <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Select Category')}}</label>
                                   <div class="col-sm-9">     
                                        <select class="form-control select2" name="category">
                                            @foreach($cat as $item)
                                            <option value="{{$item->id}}" {{ ($item->id == $quiz->category ) ? 'selected' : '' }} >{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                   </div>
                            </div>
                            
                          <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Question')}}</label>
                                <div class="col-sm-9">
                                    <input id="icon" type="text" class="form-control" name="question" placeholder="Question"  value="{{$quiz->question}}"  required>
                                </div>
                            </div>
                            
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Option A')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="a" value="{{$quiz->a}}" placeholder="Option A" required>
                              
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Option B')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="b" value="{{$quiz->b}}" placeholder="Option B" required>
                              
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Option C')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="c" value="{{$quiz->c}}" placeholder="Option C" required>
                              
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Option D')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="d" value="{{$quiz->d}}" placeholder="Option D" required>
                              
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Right Answer')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="answer" value="{{$quiz->answer}}" placeholder="Right Answer" required>
                              
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Coin ')}}</label>
                                <div class="col-sm-9">
                                     <input id="name" type="text" class="form-control" name="coin" value="{{$quiz->coin}}" placeholder="Coin " required>
                              
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
