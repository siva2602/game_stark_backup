@extends('layouts.main') 
@section('title', 'Daily Task Setting')
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
                            <h5>{{ __('App Setting')}}</h5>
                            <span>{{ __('')}}</span>
                        </div>
                        </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('dashboard')}}"><i class="ik ik-target"></i></a>
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
                    <div class="card">
                      <div class="card-header">
                        <h5>{{ __('App Setting')}}</h5>
                        <span>{{ __('')}}</span>
                    </div>
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-signup-tab" data-toggle="pill" href="#signup" role="tab" aria-controls="pills-signup" aria-selected="true">{{ __('Signup & Withdraw')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-task-tab" data-toggle="pill" href="#task" role="tab" aria-controls="pills-task" aria-selected="false">{{ __('Task Setting')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-referal-tab" data-toggle="pill" href="#referal" role="tab" aria-controls="pills-referal" aria-selected="false">{{ __('Referral Setting')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-dailybonus-tab" data-toggle="pill" href="#dailybonus" role="tab" aria-controls="pills-dailybonus" aria-selected="false">{{ __('Daily Bonus')}}</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" id="pills-promotecontent-tab" data-toggle="pill" href="#promotecontent" role="tab" aria-controls="pills-promotecontent" aria-selected="false">{{ __('User Promote Setting')}}</a>
                        </li> 
                        
                        <li class="nav-item">
                            <a class="nav-link" id="pills-paymentsetting-tab" data-toggle="pill" href="#paymentsetting" role="tab" aria-controls="pills-paymentsetting" aria-selected="false">{{ __('Payment Gateway Setting')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="signup" role="tabpanel" aria-labelledby="pills-signup-tab">
                            <div class="card-body">
                            <form class="forms-sample" method="POST" action="/setting/app-setting">
                            @csrf
                            <input type="hidden" name="type" value="app"/>
                             <br>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Google Login  :- ')}}</label>
                                <div class="col-sm-9">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                    <input type="checkbox" name="google_login" {{ ($data[0]->google_login == 'true' ) ? 'checked' : '' }}>
                                    <span class="slider round"></label>
                            </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Email Verification ( Email verification on User Signup ) :- ')}}</label>
                                <div class="col-sm-9">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                    <input type="checkbox" name="email_verification" {{ ($data[0]->email_verification == 'true' ) ? 'checked' : '' }}>
                                    <span class="slider round"></label>
                            </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Promote Content ( User can promote website, app ,video ) :- ')}}</label>
                                <div class="col-sm-9">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                    <input type="checkbox" name="promote_content" {{ ($data[0]->promote_content == 'true' ) ? 'checked' : '' }}>
                                    <span class="slider round"></label>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Daily Withdrawal Limit :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="number" class="form-control " name="max_redeem_day" value="{{$data[0]->max_redeem_day}}" placeholder="0" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark m-3 float-right">{{ __('Update')}}</button>
                       
                        </div>
                        </div>
                        
                        <!--Task Setting-->
                        <div class="tab-pane fade" id="task" role="tabpanel" aria-labelledby="pills-task-tab">
                            <div class="card-body ">
                                 <br>
                               <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Task Mode :- ')}}</label>
                                <select class="form-control select2 col-sm-9" name="task_mode">
                                    <option value="onetime" {{ ($data[0]->task_mode == 'onetime' ) ? 'selected' : '' }}>One Time ( Same Task Not Show Again to User)</option>
                                    <option value="daily" {{ ($data[0]->task_mode == 'daily' ) ? 'selected' : '' }}>Daily ( Same Task Available Next Day ( Apply in Articale, Video,Quiz ))</option>
                                </select>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-12 col-form-label">Daily Spin Limit :- </label>
                                <div class="col-sm-10">
                                     <input type="number" class="form-control " name="spin" value="{{$data[0]->spinlimit}}" placeholder="0" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-12 col-form-label">Paid Spin Cost :- </label>
                                <div class="col-sm-10">
                                     <input type="number" class="form-control " name="paid_spin" value="{{$data[0]->paid_spin}}" placeholder="0" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Daily Scratch Limit :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="number" class="form-control " name="scrath_limit" value="{{$data[0]->scrath_limit}}" placeholder="0" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Scratch Minimum & Maximum Amount :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="text" class="form-control " name="scratch" value="{{$data[0]->scratch}}" placeholder="minimum number 1, maximum 10 etc  1,10" required>
                                </div>
                            </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Daily VideoZone Task Limit :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="number" class="form-control " name="limit_video" value="{{$data[0]->limit_video}}" placeholder="0" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Daily App Install Task Limit :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="number" class="form-control " name="limit_app" value="{{$data[0]->limit_app}}" placeholder="0" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Daily Quiz Task Limit :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="number" class="form-control " name="limit_quiz" value="{{$data[0]->limit_quiz}}" placeholder="0" required>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Daily Read Article Task Limit :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="number" class="form-control " name="limit_web" value="{{$data[0]->limit_web}}" placeholder="0" required>
                                </div>
                            </div>
                            </div>

                            <div class="form-group row">
                                 <div class="col-sm-3">
                                     <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Quiz Fifty Lifeline Coin Amount  :- ')}}</label>
                                        <div class="col-sm-10">
                                     <input type="number" class="form-control " name="quiz_half"  value="{{$quiz_half}}" placeholder="5" required>
                                </div>
                                </div>
                                
                                <div class="col-sm-3">
                                     <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Quiz Timer in second  :- ')}}</label>
                                        <div class="col-sm-10">
                                     <input type="number" class="form-control " name="quiz_time"  value="{{$quiz_time}}" placeholder="5" required>
                                </div>
                                </div>
                                
                                <div class="col-sm-3">
                                     <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Skip Question Amount  :- ')}}</label>
                                        <div class="col-sm-10">
                                     <input type="number" class="form-control " name="quiz_skip"  value="{{$quiz_skip}}" placeholder="5" required>
                                </div>
                                </div>
                                
                            </div>
                            
                            <div class="form-group row">
                                 <div class="col-sm-3">
                                     <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Play Game For x Minute  :- ')}}</label>
                                        <div class="col-sm-10">
                                     <input type="number" class="form-control " name="game_minute"  value="{{$game_minute}}" placeholder="5" required>
                                </div>
                                </div>
                                
                                <div class="col-sm-3">
                                     <label for="exampleInputUsername2" class="col-sm-12 col-form-label ">{{ __('Reward for Spend x Minute in Game  :- ')}}</label>
                                        <div class="col-sm-10">
                                     <input type="number" class="form-control " name="game_coin"  value="{{$game_coin}}" placeholder="5" required>
                                    </div>
                                </div>
                                
                                <div class="col-sm-5">
                                     <label for="exampleInputUsername2" class="col-sm-12 col-form-label">{{ __('Gameinfo Message :- ')}}</label>
                                        <div class="col-sm-12">
                                     <input type="text" class="form-control " name="game_message"  value="{{$game_message}}" placeholder="Play Game for 5 minute and get Reward" required>
                                    </div>
                                </div>
                                
                            </div>
                
                            <button type="submit" class="btn btn-dark m-3 float-right">{{ __('Update')}}</button>
                        </div>
                        </div>
                        
                        <!--Referal setting-->
                        <div class="tab-pane fade" id="referal" role="tabpanel" aria-labelledby="pills-referal-tab">
                            <div class="card-body">
                                <br>
                                <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Welcome Bonus :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="text" class="form-control " name="bonus" value="{{$data[0]->bonus}}" placeholder="0" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Referral Coin :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="text" class="form-control " name="refer"  value="{{$data[0]->referral_points}}" placeholder="0" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Referral Coin :- ')}}</label>
                                <select class="form-control select2 col-sm-9" name="refer_mode">
                                    <option value="direct" {{ ($data[0]->refer_mode == 'direct' ) ? 'selected' : '' }}>Direct ( When Invited person  Enter refer code Upline User get Bonus)</option>
                                    <option value="redeem" {{ ($data[0]->refer_mode == 'redeem' ) ? 'selected' : '' }}>Redeem ( Upline User get Refer Bonus when Invited person submit first redeem )</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-dark m-3 float-right">{{ __('Update')}}</button>
                                
                            </div>
                        </div>
                   

                        <!--daily bonus-->
                        <div class="tab-pane fade" id="dailybonus" role="tabpanel" aria-labelledby="pills-dailybonus-tab">
                            <div class="card-body">
                                 <br>
                                 <div class="form-group row">
                                <div class="col-sm-3"> 
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Day 1 :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="text" class="form-control " name="day1" value="{{$data[0]->day1}}" placeholder="0" required>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Day 2 :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="text" class="form-control " name="day2" value="{{$data[0]->day2}}" placeholder="0" required>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Day 3 :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="text" class="form-control " name="day3" value="{{$data[0]->day3}}" placeholder="0" required>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Day 4 :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="text" class="form-control " name="day4"  value="{{$data[0]->day4}}" placeholder="0" required>
                                </div>
                            </div>
                            </div>
                            

                            <div class="form-group row">
                                <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Day 5 :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="text" class="form-control " name="day5"  value="{{$data[0]->day5}}" placeholder="0" required>
                                </div>
                            </div>
                            
                             <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Day 6  :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="number" class="form-control " name="day6"  value="{{$data[0]->day6}}" placeholder="5" required>
                                </div>
                            </div>
                            
                             <div class="col-sm-3">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Day 7 :- ')}}</label>
                                <div class="col-sm-10">
                                     <input type="number" class="form-control " name="day7"  value="{{$data[0]->day7}}" placeholder="5" required>
                                </div>
                            </div>
                            </div>
                            
                            <button type="submit" class="btn btn-dark m-3 float-right">{{ __('Update')}}</button>
                            </div>
                </div>
                  
                        <!--Promote content -->
                        <div class="tab-pane fade" id="promotecontent" role="tabpanel" aria-labelledby="pills-promotecontent-tab">
                    <div class="card-body">
                          <br>
                          <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Required Coin For Promote 1 App  :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="text" class="form-control " name="app_promotecoin" value="{{$data[0]->app_promotecoin}}" placeholder="Required Coin For Promote 1 App " required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Required Coin For Promote 1 Website & Video  :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="text" class="form-control " name="video_promotecoin" value="{{$data[0]->video_promotecoin}}" placeholder="Required Coin For Promote 1 Website & Video" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __(' Max Promotion Limit :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="text" class="form-control " name="max_promote" value="{{$data[0]->max_promote}}" placeholder="User Can create how much promotion" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Video & Website Timer in Promotion :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="number" class="form-control " name="promote_time" value="{{$data[0]->promote_time}}" placeholder="Enter Timer Value in minute eg 1" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('App Install Coin get User( from promoted app ) :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="number" class="form-control " name="promo_appcoin" value="{{$data[0]->promo_appcoin}}" placeholder="eg 10" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Video Watch Coin get User( from promoted video ) :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="number" class="form-control " name="promo_videocoin" value="{{$data[0]->promo_videocoin}}" placeholder="eg 10" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Web Visit Coin get User( from promoted website ) :- ')}}</label>
                                <div class="col-sm-9">
                                     <input type="number" class="form-control " name="promo_webcoin" value="{{$data[0]->promo_webcoin}}" placeholder="eg 10" required>
                                </div>
                            </div>
                            

                            <button type="submit" class="btn btn-dark m-3 float-right">{{ __('Update')}}</button>
                    </div>
                </div>
                
                        <!--Payment Gateway Setting-->
                        <div class="tab-pane fade" id="paymentsetting" role="tabpanel" aria-labelledby="pills-paymentsetting-tab">
                            <div class="card-body bg-light">
                                <br>
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Store Name</label>
                                    <div class="col-sm-9">
                                         <input type="text" class="form-control " name="store_name" value="{{$store_name}}" placeholder="coin store" required>
                                    </div>
                                </div> 
                                <div class="row">
                                                                     <div class="col-md-4 card">
                                   <div class="card-header bg-dark" >
                                       <h3 style="color:white;">Paypal</h3>
                                        <div class="" style="position: absolute; right: 0; margin-right:30px;">
                                        <label class="switch s-icons s-outline s-outline-success mr-2" style="float:right;">
                                            <input type="checkbox" name="paypal" {{ ($paypal == 'true' ) ? 'checked' : '' }} >
                                            <span class="slider round"></label>
                                    </div>
                                  </div>
                                    <div class="card-body">
                                          <div class="form-group row">
                                              <label for="exampleInput" class="col-lg-12 form-label">Paypal Client ID</label>
                                               <div class="col-lg-12">     
                                                    <input type="text" class="form-control" value="{{$paypal_key}}" name="paypal_key" placeholder="client id">
                                                </div>
                                         </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-4 card">
                                   <div class="card-header bg-dark" >
                                       <h3 style="color:white;">RazorPay</h3>
                                        <div class="" style="position: absolute; right: 0; margin-right:30px;">
                                        <label class="switch s-icons s-outline s-outline-success mr-2" style="float:right;">
                                            <input type="checkbox" name="razorpay" {{ ($razorpay == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                    </div>
                                  </div>
                                    <div class="card-body">
                                          <div class="form-group row">
                                              <label for="exampleInput" class="col-lg-12 form-label">KEY</label>
                                               <div class="col-lg-12">     
                                                    <input type="text" class="form-control" value="{{$razorpay_key}}" name="razorpay_key" placeholder="key">
                                                </div>
                                         </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 card">
                                   <div class="card-header bg-dark" >
                                       <h3 style="color:white;">UPI</h3>
                                        <div class="" style="position: absolute; right: 0; margin-right:30px;">
                                        <label class="switch s-icons s-outline s-outline-success mr-2" style="float:right;">
                                            <input type="checkbox" name="upi" {{ ($upi == 'true' ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                    </div>
                                  </div>
                                    <div class="card-body">
                                          <div class="form-group row">
                                              <label for="exampleInput" class="col-lg-12 form-label">UPI Business ID</label>
                                               <div class="col-lg-12">     
                                                    <input type="text" class="form-control" value="{{$upi_key}}" name="upi_key" placeholder="business upi id">
                                                </div>
                                         </div>
                                         
                                         <div class="form-group row">
                                              <label for="exampleInput" class="col-lg-12 form-label">Payee name on upi id</label>
                                               <div class="col-lg-12">     
                                                    <input type="text" class="form-control" value="{{$payee_name}}" name="payee_name" placeholder="John">
                                                </div>
                                         </div>
                                    </div>
                                </div>
                                
                                   <button type="submit" class="btn btn-dark  m-3 float-right">{{ __('Update')}}</button>
                                </form>
                            </div>
                        </div>
                        </div>
                
                
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
