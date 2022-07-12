@extends('layouts.main') 
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')

        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="container-fluid">
    	<div class="row">
    		<!-- page statustic chart start -->
            <div class="col-xl-3 col-md-6">
                <a href="/users"><div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$user}}</h4>
                                <p class="mb-0">{{ __('Users')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-user f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div></a>
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="/user-transaction"><div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$trans}}</h4>
                                <p class="mb-0">{{ __('Transaction')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-shopping-cart f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow" ></div>
                    </div>
                </div></a>
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="/request-pending"><div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$pending}}</h4>
                                <p class="mb-0">{{ __('Pending Payment')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-user f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div><a/>
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="/request-complete"><div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{$complete}}</h4>
                                <p class="mb-0">{{ __('Completed Payment')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik f-30">৳</i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow" ></div>
                    </div>
                </div></a>
            </div>
            <!-- page statustic chart end -->
        
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="/apps"><div class="widget bg-primary">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('App')}}</h6>
                                <h2>{{$apps}}</h2>
                            </div>
                            <div class="icon">
                                <i class="fab fa-android"></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="/videos"><div class="widget bg-danger">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('Videos')}}</h6>
                                <h2>{{$video}}</h2>
                            </div>
                            <div class="icon">
                                <i class="fab fa-youtube"></i>
                            </div>
                        </div>
                    </div>
                </div></a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <a href="/websites"><div class="widget bg-warning">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('Website')}}</h6>
                                <h2>{{$weblink}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-globe"></i>
                            </div>
                        </div>
                    </div></a>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <a href="/payment-options"><div class="widget bg-dark">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>{{ __('Rewards Option')}}</h6>
                                    <h2>{{$redeem}}</h2>
                                </div>
                                <div class="icon">
                                <i class="ik ik-credit-card"></i>
                                </div>
                            </div>
                        </div>
                    </div></a>
                </div>

            <!-- Application Sales end -->
    	</div>
    	   <div class="col-lg-12 col-xl-12">
    	       <div class="row">
        	      <div class="col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="">Users Analysis</h3>
                        </div>
                         <div class="card-block text-center">
                                <div id="revenueMonthly" class="chart-shadow"></div>
                            </div>
                    </div>
                 </div>
                 
        	    <div class="col-lg-4 col-xl-4">
        	         <div class="col-xl-12 col-md-12">
                          <div class="card proj-t-card">
                                <div class="card-body">
                                    <div class="row align-items-center mb-10">
                                        <div class="col-auto">
                                            <i class="fas fa-calendar-check text-red f-30"></i>
                                        </div>
                                        <div class="col pl-0">
                                            <h6 class="mb-5">Last 30 Minute Acitve User</h6>
                                            <p class="mb-0 text-red">last 30 Minute User Opend App</p>
                                        </div>
                                    </div>
                                    <div class="row align-items-center text-center">
                                        <div class="col">
                                            <h5 class="mb-0">{{$last}}</h5></div>
                                        <div class="col"></div>
                                        <div class="col">
                                            <h5 class="mb-0"></h5></div>
                                    </div>
                                    <h6 class="pt-badge bg-red">
                                       @if($user>0)
                                        {{round(($last*100)/$user)}}@endif%</h6>
                                </div>
                            </div>
                     </div>
                     
                     <div class="col-xl-12 col-md-12">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center mb-10">
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-check text-blue f-30"></i>
                                    </div>
                                    <div class="col pl-0">
                                        <h6 class="mb-5">Active User Today</h6>
                                        <p class="mb-0 text-blue">Active User Today</p>
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">
                                    <h5 class="mb-0">{{$today}}</h5></div>
                                    <div class="col"></div>
                                        <div class="col">
                                            <h5 class="mb-0"></h5></div>
                                </div>
                                <h6 class="pt-badge bg-blue">@if($user>0)
                                        {{round(($today*100)/$user)}}@endif%</h6>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-xl-12 col-md-12">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center mb-10">
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-check text-green f-30"></i>
                                    </div>
                                    <div class="col pl-0">
                                        <h5 class="mb-5">Weekly Active User</h5>
                                        <p class="mb-0 text-green">Weekly User Opend App</p>
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">
                                        <h5 class="mb-0">{{$week}}</h5></div>
                                        <div class="col"></div>
                                        <div class="col">
                                            <h5 class="mb-0"></h5></div>
                                </div>
                                <h6 class="pt-badge bg-green">@if($user>0)
                                        {{round(($week*100)/$user)}}@endif%</h6>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-12 col-md-12">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center mb-10">
                                    <div class="col-auto">
                                        <i class="fas fa-calendar-check text-blue f-30"></i>
                                    </div>
                                    <div class="col pl-0">
                                        <h6 class="mb-5">Monthly Active User</h6>
                                        <p class="mb-0 text-blue">Monthly User Opend App</p>
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">
                                    <h5 class="mb-0">{{$month}}</h5></div>
                                    <div class="col"></div>
                                        <div class="col">
                                            <h5 class="mb-0"></h5></div>
                                </div>
                                <h6 class="pt-badge bg-blue">@if($user>0)
                                        {{round(($month*100)/$user)}}@endif%</h6>
                            </div>
                        </div>
                    </div>
        	     </div> 
        	       
    	    </div>   
    	   </div>
    	   
    	   <div class="col-lg-12 col-xl-12">
               <div class="row">
                   <div class="card col-sm-6" style="padding:5px;" >
                        <div class="card-header">
                            <h3 class="">Top 5 User</h3>
                        </div>
                         <div class="card-block text-center">
                           <table id="advanced_table" class="table">
		                    <thead>
		                        <tr>
		                            <th>#</th>
		                            <th>UserName</th>
		                            <th>Email</th>
		                            <th>Coin</th>
		                            <th>Account Created</th>
		                            <th>Track</th>
		                        </tr>
		                    </thead>
		                    <tbody>
    		                        @foreach($topuser as $item)
    		                        <tr>
                                    <td>{{$loop->iteration;}}</td>
                                    <td>{{$item->name;}}</td>
                                    <td>{{$item->email;}}</td>
                                    <td>{{$item->balance;}}</td>
                                    <td>{{date('d-m-Y g:i A', strtotime($item->inserted_at)); }}</td>
                                    <td><a href="/user/track/{{$item->cust_id}}"><button type="button" class="btn btn-dark tr"><i class="ik ik-activity"></i>Track</button></a></td>
                                    </tr>    
                                    @endforeach
		                    </tbody>
		                    </table>
                          </div>
                          
                    </div>
                    <div class="card col-sm-6" style="padding:5px;" >
                        <div class="card-header">
                            <h3 class="">Recent Coin Purchase Transaction</h3>
                        </div>
                         <div class="card-block text-center">
                           <table id="advanced_table" class="table">
		                    <thead>
		                        <tr>
		                            <th>#</th>
		                            <th>Purchased with</th>
		                            <th>Coin</th>
		                            <th>Amount</th>
		                            <th>Payment ID</th>
		                            <th>Date</th>
		                        </tr>
		                    </thead>
		                    <tbody>
    		                        @foreach($paytrans as $item)
    		                        <tr>
                                    <td>{{$loop->iteration;}}</td>
                                    <td>{{$item->method;}}</td>
                                    <td>{{$item->coin;}}</td>
                                    <td>{{$item->amount;}}</td>
                                    <td>{{$item->pacinfo;}}</td>
                                    <td>{{date('d-m-Y g:i A', strtotime($item->created_at)); }}</td>
                                    </tr>    
                                    @endforeach
		                    </tbody>
		                    </table>
                          </div>
                          
                    </div>
                 </div>
               </div>     
                

    </div>
	<!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/owl.carousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/chartist/dist/chartist.min.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.js') }}"></script>
         <script src="{{ asset('plugins/flot-charts/jquery.flot.categories.js') }}"></script> 
        <script src="{{ asset('plugins/flot-charts/curvedLines.js') }}"></script>
        <script src="{{ asset('plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

       <script src="{{ asset('plugins/amcharts/amcharts.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/gauge.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/serial.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/themes/light.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/animate.min.js') }}"></script>
        <script src="{{ asset('plugins/amcharts/pie.js') }}"></script>
        <script src="{{ asset('plugins/ammap3/ammap/ammap.js') }}"></script>
        <script src="{{ asset('plugins/ammap3/ammap/maps/js/usaLow.js') }}"></script>

        <script src="{{ asset('js/widget-statistic.js') }}"></script>
        <script src="{{ asset('js/widget-data.js') }}"></script>
        <script src="{{ asset('js/dashboard-charts.js') }}"></script>
        <script src="{{ asset('js/dashboardchart.js') }}"></script>
        <script src="{{ asset('js/apexcharts.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var user = @json($alluser);
        var total = {{$user}};
        

        users_Analysis(total,user[1]['count'],user[2]['count'],user[3]['count'],user[4]['count'],user[5]['count'],user[6]['count'],user[7]['count'],user[8]['count'],user[9]['count'],user[10]['count'],user[11]['count'],user[12]['count'])


    });
</script>
    @endpush
    
   
@endsection