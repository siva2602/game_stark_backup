<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="RADMIN"> 
            </div>
        </a>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->path();
    @endphp
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == '') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>
  
                <div class="nav-item {{ ($segment1 == 'users' || $segment1 == 'users/banned') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Users')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                        <a href="{{url('users/banned')}}" class="menu-item {{ ($segment1 == 'users/banned') ? 'active' : '' }}">{{ __('Banned User')}}</a>
                    </div>
                </div>
                

                <div class="nav-item {{ ($segment1 == 'search-user') ? 'active' : '' }}">
                    <a href="{{url('search-user')}}"><i class="ik ik-search"></i><span>{{ __('Search User')}}</span>  </a>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'user-transaction') ? 'active' : '' }}">
                    <a href="{{url('user-transaction')}}"><i class="ik ik-book-open"></i><span>{{ __('User Transaction')}}</span>  </a>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'pay-transaction') ? 'active' : '' }}">
                    <a href="{{url('pay-transaction')}}"><i class="ik ik-book-open"></i><span>{{ __('Coin Store Transaction')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'request-pending' || $segment1 == 'request-complete'||$segment1 == 'request-reject') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-edit"></i><span>{{ __('Payment Request')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('request-pending')}}" class="menu-item {{ ($segment1 == 'request-pending') ? 'active' : '' }}">{{ __('Pending')}}</a>
                        <a href="{{url('request-complete')}}" class="menu-item {{ ($segment1 == 'request-complete') ? 'active' : '' }}">{{ __('Completed')}}</a>
                        <a href="{{url('request-reject')}}" class="menu-item {{ ($segment1 == 'request-reject') ? 'active' : '' }}">{{ __('Reject')}}</a>
                    </div>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'offerwall/sdk' || $segment1 == 'offerwall/web'||$segment1 == 'offerwall/api') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-package"></i><span>{{ __('Offerwalls')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('offerwall/sdk')}}" class="menu-item {{ ($segment1 == 'offerwall/sdk') ? 'active' : '' }}">{{ __('Sdk Offerwall')}}</a>
                        <a href="{{url('offerwall/api')}}" class="menu-item {{ ($segment1 == 'offerwall/api') ? 'active' : '' }}">{{ __('Api base Offerwall')}}</a>
                        <a href="{{url('offerwall/web')}}" class="menu-item {{ ($segment1 == 'offerwall/web') ? 'active' : '' }}">{{ __('Web Offerwall')}}</a>
                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'websites') ? 'active' : '' }}">
                    <a href="{{url('websites')}}"><i class="ik ik-globe"></i><span>{{ __('Websites')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'videos') ? 'active' : '' }}">
                    <a href="{{url('videos')}}"><i class="ik ik-youtube"></i><span>{{ __('Videos')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'apps') ? 'active' : '' }}">
                    <a href="{{url('apps')}}"><i class="fab fa-android"></i><span>{{ __('Apps')}}</span>  </a>
                </div>
                
             
                 <div class="nav-item {{ ($segment1 == 'quiz' || $segment1 == 'quiz-cat') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="fab fa-quinscape"></i><span>{{ __('Quiz')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('quiz-cat')}}" class="menu-item {{ ($segment1 == 'quiz-cat') ? 'active' : '' }}">{{ __('Category')}}</a>
                        <a href="{{url('quiz')}}" class="menu-item {{ ($segment1 == 'quiz') ? 'active' : '' }}">{{ __('Quiz')}}</a>
                    </div>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'game') ? 'active' : '' }}">
                    <a href="{{url('game')}}"><i class="fas fa-gamepad"></i><span>{{ __('Games')}}</span>  </a>
                </div>
                
                <div class="nav-item {{ ($segment1 == 'banner') ? 'active' : '' }}">
                    <a href="{{url('banner')}}"><i class="ik ik-image"></i><span>{{ __('Promotion Banner')}}</span>  </a>
                </div>

                <div class="nav-item {{ ($segment1 == 'faq') ? 'active' : '' }}">
                    <a href="{{url('faq')}}"><i class="fas fa-question"></i><span>{{ __('Faq')}}</span>  </a>
                </div>
                <div class="nav-item {{ ($segment1 == 'setting/spin') ? 'active' : '' }}">
                    <a href="{{url('setting/spin')}}"><i class="ik ik-target"></i><span>{{ __('Spinner')}}</span></a>
                </div>

                <div class="nav-item {{ ($segment1 == 'payment-options' || $segment1 == 'reward-cat') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-credit-card"></i><span>{{ __('Rewards')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('reward-cat')}}" class="menu-item {{ ($segment1 == 'reward-cat') ? 'active' : '' }}">{{ __('Category')}}</a>
                        <a href="{{url('payment-options')}}" class="menu-item {{ ($segment1 == 'payment-options') ? 'active' : '' }}">{{ __('Reward option')}}</a>
                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'notification') ? 'active' : '' }}">
                    <a href="{{url('notification')}}"><i class="ik ik-bell"></i><span>{{ __('Notifiaiton')}}</span>  </a>
                </div>
                
                 <div class="nav-item {{ ($segment1 == 'coinstore') ? 'active' : '' }}">
                    <a href="{{url('coinstore')}}"><i class="ik ik-shopping-cart"></i><span>{{ __('Coin Store')}}</span>  </a>
                </div>


                <div class="nav-item {{ ($segment1 == 'setting-general' || $segment1 == 'setting/ads' || $segment1 == 'setting/security'|| $segment1 == 'setting/app'|| $segment1 == 'setting/maintenance') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-settings"></i><span>{{ __('Setting')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{url('setting-general')}}" class="menu-item {{ ($segment1 == 'setting-general') ? 'active' : '' }}">{{ __('General Setting')}}</a>
                         <a href="{{url('setting/app')}}" class="menu-item {{ ($segment1 == 'setting/app') ? 'active' : '' }}">App & Task Setting</a>
                        <a href="{{url('setting/ads')}}" class="menu-item {{ ($segment1 == 'setting/ads') ? 'active' : '' }}">{{ __('Ads Setting')}}</a>
                        <a href="{{url('setting/security')}}" class="menu-item {{ ($segment1 == 'setting/security') ? 'active' : '' }}">{{ __('Fraud Prevention')}}</a>
                        <a href="{{url('setting/maintenance')}}" class="menu-item {{ ($segment1 == 'setting/maintenance') ? 'active' : '' }}">{{ __('Update & Maintenance')}}</a>
                    </div>
                </div>

                <div class="nav-item {{ ($segment1 == 'admin-profile') ? 'active' : '' }}">
                    <a href="{{url('admin-profile')}}"><i class="ik ik-lock"></i><span>{{ __('Admin Profile')}}</span>  </a>
                </div>


                <div class="nav-item {{ ($segment1 == 'clear-cache') ? 'active' : '' }}">
                    <a href="{{url('clear-cache')}}"><i class="ik ik-battery-charging"></i><span>{{ __('Clear Cache')}}</span>  </a>
                </div>
                              
        </div>
    </div>
</div>