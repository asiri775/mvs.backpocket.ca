<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/partials/nav.css') }}">
<nav class="page-sidebar" data-pages="sidebar">
<meta id="p" name="csrf_token" content="{{ csrf_token() }}" />
    <div class="sidebar-header">
        <div class="my-dashboard" style="padding:0px;" id="inter-dashboard">My Dashboard</div>
        <div class="sidebar-header-controls">
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu-items">
            <li class="m-t-30" {!! (Request::is('user-dashboard.index') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user-dashboard.index")}}" class="detailed">
                    <span class="title">My Dashboard</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-tachometer" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user-orders') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user.myorders")}}" class="detailed">
                    <span class="title">My Orders</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-first-order" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user/account-details') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user.account-details")}}" class="detailed">
                    <span class="title">My Account</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user-gift-cards') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user-gift-cards")}}" class="detailed">
                    <span class="title">Gift Cards</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-gift"></i></span>
            </li>
            <li {!! (Request::is('user/refer-friend') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user.refer-friend")}}" class="detailed">
                    <span class="title">Refer a Friend</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
            </li>
            <li {!! (Request::is('user/product-favourite') ? 'class="active"' : '' ) !!}>
                <a href="{{route("user.product-favourite")}}" class="detailed">
                    <span class="title">My Faves</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-gratipay" aria-hidden="true"></i></span>
            </li>
            <li>
                <a href="{{route("logout")}}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="detailed">
                    <span class="title">Logout</span>
                </a>
                <span class="icon-thumbnail"><i class="pg-power" aria-hidden="true"></i></span>
            </li>
        </ul>

        <div class="clearfix"></div>
    </div>
</nav>
<div class="page-container ">
    <div class="header ">
        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar">
        </a>
        <div class="mobile-set">
            <div class="brand inline logo-with-dashboad  ">
                <div class="brand-logo">
                    <a href="{{url('/')}}"><img src="http://www.ubeclean.com/assets/img/ube_logo_ig.png"
                            class="img-responsive" /></a>
                </div>
                <div class="my-dashboard">
                    <a href="{{route("user-dashboard.index")}}"><img class="dashboard"
                            src="{{ url('/assets/img/logo_mydashboard.png') }}"></a>
                </div>

            </div>
            <div class="brand inline searchbar-wrap  ">
                <div class="input-group">
                    <input type="text" id="search" class="searchbar form-control "
                            placeholder="Search for a product, invoice or item">

                        
                </div>
                <div id="here" class="dropdown-content ScrollStyle" style="left:0;">
                    <div class="row" id="search-row">
                        <div style="text-align: left;" class="col-md-6" id="here1">
                            Orders
                        </div>
                        <div style="text-align: left;" class="col-md-6" id="here2">
                            Products
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="pull-left p-r-10 fs-14 d-lg-block d-none logged-username">
                <span>{{ Auth::guard('profile')->user()->first_name }}</span>
                <span>{{ Auth::guard('profile')->user()->last_name }}</span>
            </div>
            <div class="dropdown pull-right d-lg-block d-none">
                <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="thumbnail-wrapper d32 circular inline">
                        <img src="{{ URL::asset('/assets/img/default-user.jpg')}}" alt=""
                            data-src="{{ URL::asset('/assets/img/default-user.jpg')}}"
                            data-src-retina="{{ URL::asset('/assets/img/default-user.jpg')}}" width="32" height="32">
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="{{route("user.account-details")}}" class="dropdown-item">
                        Account
                        Settings <i class="pg-settings_small"></i></a>

                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="clearfix bg-master-lighter dropdown-item">
                        <span class="pull-left">Logout</span>
                        <span class="pull-right"><i class="pg-power"></i></span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <div class="pull-right d-lg-block d-none balance-summery">
                <span>Balance :</span>
                <span>{{$settings[0]->currency_sign}}
                    {{ number_format(Auth::guard('profile')->user()->balance, 2) }}</span>
            </div>
        </div>
    </div>