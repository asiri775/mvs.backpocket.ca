<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/nav.css') }}">
@php
$price=0;
$items =0;
foreach($cart_result as $res){
$price += $res->cost * $res->quantity;
$items += $res->quantity;
}
$discount = 0;
if(Session::has('coupon')){
$discount = App\Coupon::calculateDiscount(Session::get('coupon'), $price);
}
$setting = DB::select('select * from settings where id=1');
$delivery_fee=$setting[0]->delivery_fee;
$donation_amount=$setting[0]->donation_amount;
@endphp
<div class="white-ribbon"></div>
<nav class="container-fluid navbar navbar-inverse navbar-fixed-top" style="margin-top:-2px;z-index:9999;">
    <div class="">

        <div class="navbar-header">
            <div class="row mobile-menu">
                <div class="col-md-2">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" onclick="$('#mobilemenu').css('display','block');">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="col-md-6 text-center">
                    <a href="#!" target="_self" class="navbar-brand mobileshow" id="logo-uBe"><img
                            src="{{ url('/assets/img/ube_logo_ig.png') }}"></a>
                </div>
                <div class="col-md-4">
                    <div id="mobile" class="top-icons">
                        <span class="tongle">
                            {{$items}} ITEMS &nbsp; | &nbsp; <span class="price">
                                @if($price !== 0)
                                ${{ number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}
                                @else
                                $0.00
                                @endif
                            </span>
                            <i class="fas fa-shopping-cart cart-icon" style="margin-top: 0px; padding-top: 0px;"></i>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="row">
                <div class="col-sm-2">
                <a href="{{ url('/') }}" target="_self"> <img class="homelogo"
                            src="{{ url('/assets/img/51096b - logo_menu.png') }}"></a>
                </div>
                <div class="col-sm-6 col-md-4" id="tablet-nav-responsive">
                    <div id="mobileNav" class="mobileshow">
                        <li class="simple-list">
                            <a href="{{ url('/') }}" target="_self"><span class="title">Home</span></a>
                        </li>
                        @foreach($menus as $menu)
                        @if($menu->name === "Dry Clean and Laundry")
                        <li class="full-width-columns">
                            <a href="{{url('/category')}}/{{$menu->slug}}">SHOP BY CATEGORY</a>
                            @if(\App\Category::where('mainid',$menu->id)->where('role','sub')->count() >0)
                            <i style="color: #fff;" class="fa fa-chevron-down"></i>
                            <div class="submenu">
                                @foreach(\App\Category::where('mainid',$menu->id)->where('role','sub')->get() as
                                $submenu)
                                {{-- @if(\App\Category::where('subid',$submenu->id)->where('role','child')->count()) --}}
                                <div class="product-column-entry">
                                    <div class="submenu-list-title"><a href="{{url('/category')}}/{{$submenu->slug}}"
                                            style="color:#2e2e2e; font-size:13px;">{{$submenu->name}}</a><span
                                            style="color:#2e2e2e;" class="toggle-list-button"></span></div>
                                    <div class="description toggle-list-container">
                                        <ul class="list-type-1">
                                            @foreach(\App\Category::where('subid',$submenu->id)->where('role','child')->get()
                                            as $childmenu)
                                            <li class="full-width-columns" style="border-bottom: 0;"><a
                                                    href="{{url('/category')}}/{{$childmenu->slug}}"
                                                    style="color:#666; font-size: 12px; font-weight: 600; text-transform: capitalize;">{{$childmenu->name}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                {{-- @endif --}}
                                @endforeach
                            </div>
                            @endif
                        </li>
                        <!-- <li class="simple-list">
                            <a href="{{ url('/deals') }}" target="_self"><span class="title">Deals</span></a>
                        </li> -->
                        <li class="simple-list">
                            <a href="{{ url('/buy-credits') }}" target="_self"><span class="title">Buy
                                    Credits</span></a>
                        </li>
                        <!-- <li class="simple-lists">
                            <a href="{{ url('/locations') }}" target="_self"><span class="title">Locations</span></a>
                        </li> -->
                        <li class="simple-lists contact">
                            <a href="{{ url('/rewards') }}" target="_self"><span class="title">Rewards</span></a>
                        </li>
                        {{-- <li class="simple-lists">
                            <a href="{{ url('/about') }}" target="_self"><span class="title">About Us</span></a>
                        </li>
                        <li class="simple-lists contact">
                            <a href="{{ url('/contact') }}" target="_self"><span class="title">Contact Us</span></a>
                        </li> --}}
                        <li class="simple-lists">
                            <a href="{{route('user-dashboard.index')}}">
                                <span class="title">Order History</span>
                            </a>
                        </li>
                        <li class="simple-lists">
                            <a href="{{route('user.account-details')}}" class="title">
                                <span class="title">My Account</span>
                            </a>
                        </li>
                        <li class="simple-lists">
                            <a href="{{route('user-dashboard.index')}}" class="title">
                                <span class="title">My orders</span>
                            </a>
                        </li>
                        <li class="simple-lists">
                            <a href="{{route("user.product-favourite")}}" class="detailed">
                                <span class="">My Faves</span>
                            </a>
                        </li>
                        <li class="simple-lists">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span
                                    class="">
                                    logout </span></a>
                        </li>
                        @endif
                        @endforeach
                    </div>

                    <div id="sns_mainnav" class="sns_mainmenu" style="width:100%!important;">
                        <div id="sns_custommenu" class="visible-md visible-lg">
                            <ul class="mainnav">
                                <li class="level0 nav-3 no-group drop-submenu12">
                                    <a class="menu-title-lv0" id="homelink" href="{{ url('/') }}" target="_self"><span
                                            class="title">{{$language->home}}</span></a>
                                </li>
                                @foreach($menus as $menu)
                                @if($menu->name === "Dry Clean and Laundry")
                                <li class="level0 nav-1 no-group drop-submenu12">
                                    <a class="menu-title-lv0" href="{{url('/category')}}/{{$menu->slug}}"><span
                                            class="title">SHOP
                                            BY
                                            CATEGORY</span></a>
                                    @if(\App\Category::where('mainid',$menu->id)->where('role','sub')->count()
                                    >0)
                                    <div class="wrap_dropdown fullwidth">
                                        <div class="row">
                                            @foreach(\App\Category::where('mainid',$menu->id)->where('role','sub')->get()
                                            as $submenu)
                                            <div class="col-sm-3 col-md-4">
                                                <h6 class="title menu1-2-5"><a
                                                        href="{{url('/category')}}/{{$submenu->slug}}">{{$submenu->name}}</a><span
                                                        class="toggle-list-button"></span></h6>
                                                <div class="wrap_submenu">
                                                    <ul class="level1">
                                                        @foreach(\App\Category::where('subid',$submenu->id)->where('role','child')->get()
                                                        as $childmenu)
                                                        <li class="level2 nav-1-3-16 first"><a class=" menu-title-lv2"
                                                                href="{{url('/category')}}/{{$childmenu->slug}}">{{$childmenu->name}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </li>
                                @endif
                                @endforeach
                                  <!-- <div class="wrap_dropdown fullwidth">
                                        <div class="row">
                                            @foreach(\App\Category::where('mainid',$menu->id)->where('role','sub')->get()
                                            as $submenu)
                                            @if(\App\Category::where('subid',$submenu->id)->where('role','child')->count())
                                            <div class="col-sm-3">
                                                <h6 class="title menu1-2-5"><a
                                                        href="{{url('/category')}}/{{$submenu->slug}}">{{$submenu->name}}</a><span
                                                        class="toggle-list-button"></span></h6>
                                                <div class="wrap_submenu">
                                                    <ul class="level1">
                                                        @foreach(\App\Category::where('subid',$submenu->id)->where('role','child')->get()
                                                        as $childmenu)
                                                        <li class="level2 nav-1-3-16 first"><a class=" menu-title-lv2"
                                                                href="{{url('/category')}}/{{$childmenu->slug}}">{{$childmenu->name}}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div> -->

                                <!-- <li class="level0 nav-3 no-group drop-submenu12">
                                    <a class="menu-title-lv0" href="{{ url('/deals') }}" target="_self"><span
                                            class="title">Deals</span></a>

                                </li> -->
                                <li class="level0 nav-3 no-group drop-submenu12">
                                    <a class="menu-title-lv0" href="{{ url('/buy-credits') }}" target="_self"><span
                                            class="title">Buy
                                            Credits</span></a>
                                </li>
                                <!-- <li class="level0 nav-3 no-group drop-submenu12">
                                    <a class="menu-title-lv0" href="{{ url('/locations') }}" target="_self"><span
                                            class="title">Locations</span></a>
                                </li> -->

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-6">
                    <div class="top-cart">
                        <div class="mycart mini-cart">
                            <div class="block-minicart">
                                {{--<span class="login-a">
                                @if(Auth::guard('profile')->guest())
                                    <span><a href="{{url('user/registration')}}"><i class="fa fa-user-plus"> </i><span
                                    class="">
                                    Sign Up </span></a> &nbsp; | &nbsp;</span>
                                <span><a href="{{url('signin/user')}}"><i class="fa fa-key"> </i><span class="">
                                            Login </span></a> &nbsp; | </span>
                                @else
                                <span><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="fa fa-power-off"> </i><span class="">
                                            logout </span></a> &nbsp; | &nbsp;</span>
                                <span>
                                    <a href="{{route('user-dashboard.index')}}"><i class="fa fa-user"></i>
                                        <span class="title">{{ Auth::guard('profile')->user()->first_name }}
                                        </span>
                                    </a>
                                    &nbsp; |

                                </span>

                                @endif
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                </span>--}}
                                <div class="dropdown" style="float:left;">
                                    {{--<button class="dropbtn">Left</button>--}}
                                    <span class="login-a dropbtn" style="margin-top:10px;padding:5px;margin-right:3px;">
                                        @if(Auth::guard('profile')->guest())
                                        <span><a href="{{url('user/registration')}}"><i class="fa fa-user-plus">
                                                </i><span class="">
                                                    Sign Up </span></a> &nbsp; | &nbsp;</span>
                                        <span><a href="{{url('signin/user')}}"><i class="fa fa-key"> </i><span class="">
                                                    Login </span></a> &nbsp; | </span>
                                        @else
                                        <span><a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                                    class="fa fa-power-off"> </i><span class="">
                                                    logout </span></a> &nbsp; | &nbsp;</span>
                                        <span>
                                            <a href="{{route('user-dashboard.index')}}"><i class="fa fa-user"></i>
                                                <span class="title">{{ Auth::guard('profile')->user()->first_name }} &nbsp; ${{ number_format((float)Auth::guard('profile')->user()->balance, 2, '.', '') }}
                                                </span>
                                            </a>
                                            &nbsp; |

                                        </span>

                                        @endif
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </span>
                                    @if(!Auth::guard('profile')->guest())
                                    <div class="dropdown-content " style="left:0;">
                                        <a href="{{route("user.account-details")}}" class="detailed">
                                            <span class="title">My Account</span>
                                        </a>
                                        <a href="{{route('user-dashboard.index')}}">
                                            <span class="title">My orders</span>
                                        </a>
                                        <a href="{{route("user.product-favourite")}}" class="detailed">
                                            <span class="">My Faves</span>
                                        </a>
                                        {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><span class="">
                                            logout </span></a>--}}
                                    </div>
                                    @endif
                                </div>

                                <span class="cart-content">

                                    <span class="tongle" style="margin-top:10px;padding:5px;margin-right:3px;">
                                        {{$items}} ITEMS &nbsp; | &nbsp; <span class="price">
                                            @if($price !== 0)
                                            ${{ number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}
                                            @else
                                            $0.00
                                            @endif
                                        </span>
                                        <i class="fas fa-shopping-cart cart-icon"
                                            style="margin-top: 0px; padding-top: 0px;"></i>
                                    </span>


                                    <div class="block-content content">
                                        <div class="block-inner">
                                            <div class="row actions">
                                                <div class="col-md-6">
                                                    @if(!Auth::guard('profile')->user())
                                                    <a class="button gfont go-to-cart btn-block"
                                                        href="{{url('/order-summary')}}" style="width: 100%;">Check
                                                        out</a>
                                                    @else
                                                    <a class="button gfont go-to-cart btn-block"
                                                        href="{{url('/order-confirm')}}" style="width: 100%;">Check
                                                        out</a>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    {{-- <a class="button gfont go-to-cart btn-block" href="{{url('/cart')}}"
                                                    style="width: 100%;">Go
                                                    to
                                                    cart</a> --}}
                                                    @if(!Auth::guard('profile')->user())
                                                    <a class="button gfont go-to-cart btn-block" href="{{url('/cart')}}"
                                                        style="width: 100%;">Go
                                                        to
                                                        cart</a>
                                                    @else
                                                    <a class="button gfont go-to-cart btn-block" href="{{url('/cart')}}"
                                                        style="width: 100%;">Go
                                                        to
                                                        cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <table id="cartProductTable" class="table table-striped"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th class="text-center">QTY</th>
                                                        <th class="text-left">Rate</th>
                                                        <th class="text-center">Total</th>
                                                        <th style="width:5%"></th>
                                                    </tr>
                                                </thead>

                                                <tbody id="cartproductList">
                                                    @if($cart_result->count() == 0)
                                                    <tr>
                                                        <td colspan="4">Please add some products first</td>
                                                    </tr>
                                                    @else
                                                    @foreach($cart_result as $res)
                                                    <tr>
                                                        <td>
                                                            <a
                                                                href="{{ route('product.details', ['id' => $res->product, 'title' => str_slug(str_replace(' ', '-', $res->title))]) }}">{{ $res->title }}</a>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $res->quantity }}
                                                        </td>
                                                        <td class="text-left">
                                                            ${{ number_format((float)$res->cost, 2, '.', '') }}
                                                        </td>
                                                        <td class="text-center">
                                                            ${{ number_format((float)$res->cost * $res->quantity, 2, '.', '') }}
                                                        </td>
                                                        <td class="text-center">
                                                            <form
                                                                action="{{ url('/') . '/cartdelete/product/' . $res->product}}"
                                                                method="GET">
                                                                {{csrf_field()}}

                                                                <button class="btn-remove" title="Remove This Item"
                                                                    type="submit" style="margin-top:-5px;">Remove
                                                                    This
                                                                    Item</button>

                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tbody id="cartSummary" class="{{ $cart_result->count() == 0 ? 'hidden' : '' }}">
                                                    <tr>
                                                        <td colspan="5">
                                                            <table id="totalTable">
                                                                <tr>
                                                                    <td>
                                                                        <span style='float:right'>Subtotal:</span>
                                                                    </td>
                                                                    <td class="text-right" id="cartSummarySubtotal">
                                                                        ${{ number_format((float)$price, 2, '.', '') }}
                                                                    </td>
                                                                </tr>
                                                                @if(Session::has('coupon'))
                                                                <tr>
                                                                    <td>
                                                                        <span style="float:right">Discount:</span>
                                                                    </td>
                                                                    <td class="text-right" id="cartSummaryDiscount">
                                                                        -${{ number_format((float)$discount, 2, '.', '') }}
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                <tr>
                                                                    <td>
                                                                        <span style='float:right'>Delivery:</span>
                                                                    </td>
                                                                    <td class="text-right" id="cartSummaryDelivery">
                                                                        ${{ number_format((float) $delivery_fee, 2, '.', '') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <span style='float:right'>Tax (13%):</span>
                                                                    </td>
                                                                    <td class="text-right" id="cartSummaryTax">
                                                                        ${{ number_format((float) ($price+$delivery_fee) * 13/100, 2, '.', '') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <span  style='float:right'
                                                                        class="capital popovers" data-toggle="popover" title="" data-content="Help Us Make A Difference!
Your small micro donation will go towards providing free services and programs for Mental Health.  In addition, this Merchant will also generously match your donation. <br> <br> <a href='https://dryclean.io/makeitcount.php' title='test add link'>Click Here </a> to learn more about this program
and the Janeen Foundation" data-original-title="Make It Count"><img
                                                                                class='makeitcounticon'
                                                                                src='{{ url('assets/img/3742-300x300.jpg') }}'>Make
                                                                            it count <i class="helpicon far fa-question-circle"></i>:</span>
                                                                    </td>
                                                                    <td class="text-right" id="cartSummaryMakeItCount">
                                                                        ${{ number_format((float) $donation_amount, 2, '.', '') }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="line">
                                                                        <span style='float:right'><b>Grand
                                                                                Total:</b></span>
                                                                    </td>
                                                                    <td class="line text-right" id="cartSummaryGrandTotal">
                                                                        <b>${{ number_format(((float)($price+$delivery_fee) * 13) / 100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}</b>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</nav>
<scrip>
    var delivery_fee = {{ $delivery_fee }}
    var delivery_fee = {{ $delivery_fee }};
    var donation_amount = {{ $donation_amount=$setting[0]->donation_amount }};
    var discount_type = "{{ Session::has('coupon') ? Session::get('coupon')->type : null }}";
    var discount_value = {{ Session::has('coupon') ? Session::get('coupon')->value : 0 }};
</scrip>
