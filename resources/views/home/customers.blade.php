@extends('home.includes.master')

@section('header')
@include('home.includes.header')
@stop

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places">
</script>
<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/home/customers.css') }}">
<script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
<script src="{{ URL::asset('assets/map/js/jquery.blockUI.js')}}"></script>
<script src="{{ URL::asset('assets2/js/home/customers.js') }}"> </script>

@if(Session::has('message'))
<div class="alert alert-success alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('message') }}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ Session::get('error') }}
</div>
@endif
<section class="p-b-50 p-t-100">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-t-50">
                <div class="row">
                    <form method="post" action="{{ route('vendor.customer_add') }}" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12">
                        {{ csrf_field() }}
                        <div class="step-content">
                            <!-- Step 1 Start -->
                            <div class="step-pane step1">
                                <div class="map-section col-md-12 col-sm-12 col-xs-12" style="width: 100% !important;">
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <h3 align="left" style="color: #7934E2"><b>Start Shredding Today!</b></h3>
                                        <p align="left" style="font-size:15px; font-family: 'Montserrat'">Let's Get
                                            Started! <br><br>
                                            In order to provide you with the best and most accurate pricing, we first
                                            need to know where you are located.
                                        </p>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-9 map_sec">
                                        <div class="col-xs-12">
                                            <label style="color: darkgray" class="control-label col-sm-3">Step1: Enter
                                                Your Address</label>
                                            <div class="col-sm-9">
                                                <input style="width: 100%" autocomplete="off" id="autocomplete" placeholder="Enter address here" type="text">
                                                </input>
                                                <ul id="result" class="serachwrap">
                                                </ul>
                                            </div>
                                            <div id="map"></div>
                                        </div>

                                        <div class="address-form-block col-md-12 col-sm-12 col-xs-12 hide">
                                            <h3>Verify Address</h3>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <label class="control-label col-sm-3" for="address">Address</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="address" id="address" placeholder="Address">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <label class="control-label col-sm-3" for="address">Country</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="country" id="country" placeholder="Country">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <label class="control-label col-sm-3" for="city">City</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="city" id="city" placeholder="City">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <label class="control-label col-sm-3" for="province">Province</label>
                                                    <div class="col-sm-9">
                                                        <select name="province" class="form-control" placeholder="Province" id="province">
                                                            <option value="">Select Province</option>
                                                            <option value="Alberta">Alberta</option>
                                                            <option value="British Columbia">British Columbia</option>
                                                            <option value="Manitoba">Manitoba</option>
                                                            <option value="New Brunswick">New Brunswick</option>
                                                            <option value="Newfoundland">Newfoundland</option>
                                                            <option value="Northwest Territorie">Northwest Territorie
                                                            </option>
                                                            <option value="Nova Scotia">Nova Scotia</option>
                                                            <option value="Nunavut">Nunavut</option>
                                                            <option value="Ontario">Ontario</option>
                                                            <option value="Prince Edward Island">Prince Edward Island
                                                            </option>
                                                            <option value="Quebec">Quebec</option>
                                                            <option value="Saskatchewan">Saskatchewan</option>
                                                            <option value="Yukon">Yukon</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <label class="control-label col-sm-3" for="postalcode">Postal
                                                        Code</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <input type="text" name="zip1" maxlength="3" id="zip1" placeholder="">
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="zip2" maxlength="3" id="zip2" placeholder="">
                                                            </div>
                                                            <input type="hidden" class="form-control" name="lontude" id="lontude">
                                                            <input type="hidden" class="form-control" name="latude" id="latude">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" align="center">
                                            <button type="button" data-next="step2" id="next_btn_1" class="btn btn-success btn-next hide">NEXT<i class="icon-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 1 End -->

                            <!-- Step 2 Start -->
                            <div class="step-pane step2 hide">
                                <div class="col-md-12 col-sm-12 col-xs-12 border_sec" style="width: 100% !important;">
                                    <div class="col-xs-12 col-sm-12 col-md-12 " align="left">
                                        <p style="color: darkgray"><b>Step 2: SELECT SERVICE AND QUANTITY</b></p>
                                    </div>

                                    <div class="row">
                                        <!-- START POST -->
                                        <div class="col-xs-12 col-sm-6 col-md-4 post-card">
                                            <div class="container">
                                                <h4 align="center"><b>SECURE OFFSITE SHREDDING</b></h4>
                                                <div class="post-card-cover">
                                                    <img src="{{ url('home_assets/images/shredding_1.JPG') }}" alt="Avatar">
                                                </div>
                                                <div class="post-card-body">
                                                    <div class="m-t-30" align="center">
                                                        <h3 class="font-montserrat no-margin"><small><b>FROM</b></small> $65.00</h3>
                                                    </div>
                                                    <div class="m-t-10" align="center">
                                                        <div class="cart-product-count">
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <form method="GET">
                                                                        <input type="hidden" name="_token" value="cFYQ6SbUTiKLJRQUo8vROetIFdTeJoMzBSSdgSqP">
                                                                        <button class="btn btn-default btn-number" type="submit">
                                                                            <span class="glyphicon glyphicon-minus"></span>
                                                                        </button>
                                                                    </form>
                                                                </span>
                                                                <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" disabled>
                                                                <span class="input-group-btn">
                                                                    <form method="GET">
                                                                        <input type="hidden" name="_token" value="cFYQ6SbUTiKLJRQUo8vROetIFdTeJoMzBSSdgSqP">
                                                                        <button class="btn btn-default btn-number" type="submit">
                                                                            <span class="glyphicon glyphicon-plus"></span>
                                                                        </button>
                                                                    </form>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="post-card-footer m-t-30" align="center">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-cart-plus"></i>&nbsp;ADD TO CART</button> &nbsp;
                                                    <button type="button" class="btn btn-default"><i class="fa fa-heart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END POST -->
                                        <!-- START POST -->
                                        <div class="col-xs-12 col-sm-6 col-md-4 post-card">
                                            <div class="container">
                                                <h4 align="center"><b>DROP OFF SHREDDING</b></h4>
                                                <div class="post-card-cover">
                                                    <img src="{{ url('home_assets/images/shredding_2.JPG') }}" alt="Avatar">
                                                </div>
                                                <div class="post-card-body">
                                                    <div class="m-t-30" align="center">
                                                        <h3 class="font-montserrat no-margin"><small><b>FROM</b></small> $125.00</h3>
                                                    </div>
                                                    <div class="m-t-10" align="center">
                                                        <div class="cart-product-count">
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <form method="GET">
                                                                        <input type="hidden" name="_token" value="cFYQ6SbUTiKLJRQUo8vROetIFdTeJoMzBSSdgSqP">
                                                                        <button class="btn btn-default btn-number" type="submit">
                                                                            <span class="glyphicon glyphicon-minus"></span>
                                                                        </button>
                                                                    </form>
                                                                </span>
                                                                <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" disabled>
                                                                <span class="input-group-btn">
                                                                    <form method="GET">
                                                                        <input type="hidden" name="_token" value="cFYQ6SbUTiKLJRQUo8vROetIFdTeJoMzBSSdgSqP">
                                                                        <button class="btn btn-default btn-number" type="submit">
                                                                            <span class="glyphicon glyphicon-plus"></span>
                                                                        </button>
                                                                    </form>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="post-card-footer m-t-30" align="center">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-cart-plus"></i>&nbsp;ADD TO CART</button> &nbsp;
                                                    <button type="button" class="btn btn-default"><i class="fa fa-heart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END POST -->
                                        <!-- START POST -->
                                        <div class="col-xs-12 col-sm-6 col-md-4 post-card">
                                            <div class="container">
                                                <h4 align="center"><b>SECURE OFFSITE SHREDDING</b></h4>
                                                <div class="post-card-cover">
                                                    <img src="{{ url('home_assets/images/shredding_3.JPG') }}" alt="Avatar">
                                                </div>
                                                <div class="post-card-body">
                                                    <div class="m-t-30">
                                                        <div class="m-t-30" align="center">
                                                            <h3 class="font-montserrat no-margin"><small><b>FROM</b></small> $20.00</h3>
                                                        </div>
                                                        <div class="m-t-10" align="center">
                                                            <div class="cart-product-count">
                                                                <div class="input-group">
                                                                    <span class="input-group-btn">
                                                                        <form method="GET">
                                                                            <input type="hidden" name="_token" value="cFYQ6SbUTiKLJRQUo8vROetIFdTeJoMzBSSdgSqP">
                                                                            <button class="btn btn-default btn-number" type="submit">
                                                                                <span class="glyphicon glyphicon-minus"></span>
                                                                            </button>
                                                                        </form>
                                                                    </span>
                                                                    <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" disabled>
                                                                    <span class="input-group-btn">
                                                                        <form method="GET">
                                                                            <input type="hidden" name="_token" value="cFYQ6SbUTiKLJRQUo8vROetIFdTeJoMzBSSdgSqP">
                                                                            <button class="btn btn-default btn-number" type="submit">
                                                                                <span class="glyphicon glyphicon-plus"></span>
                                                                            </button>
                                                                        </form>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="post-card-footer m-t-30" align="center">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-cart-plus"></i>&nbsp;ADD TO CART</button> &nbsp;
                                                    <button type="button" class="btn btn-default"><i class="fa fa-heart"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END POST -->

                                        <div class="col-xs-6 col-sm-12 col-md-6 m-t-30" align="right">
                                            <button type="button" id="next_btn_2" class="btn btn-success">NEXT</button>
                                        </div>
                                        <div class="col-xs-6 col-sm-12 col-md-6 m-t-30" align="left">
                                            <button type="button" id="prev_btn_1" class="btn btn-back">BACK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 2 End -->

                            <!-- Step 3 Start -->
                            <div class="step-pane step3 hide">
                                <div class="col-md-12 col-sm-12 col-xs-12 border_sec" style="width: 100% !important;">
                                    <div class="content">
                                        <div class="container">
                                            <div class="col-xs-12 col-sm-12 col-md-12 " align="left">
                                                <p style="color: darkgray; font-family: 'Montserrat'; font-size: 16px"><b>Step 3: SELECT PRICE</b></p>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-3 post-card">
                                                <div class="container" style="border: none">
                                                    <h4 align="center"><b>MOBILE SHREDDING</b></h4>
                                                    <div class="post-card-cover">
                                                        <img id="mobile_sh" src="{{ url('home_assets/images/shredding_2.JPG') }}" alt="Avatar">
                                                    </div>
                                                    <div class="post-card-body">
                                                        <div class="m-t-30">
                                                            <div class="m-t-10" align="center">
                                                                <div class="cart-product-count">
                                                                    <div class="input-group">
                                                                        <span class="input-group-btn">
                                                                            <form method="GET">
                                                                                <input type="hidden" name="_token" value="cFYQ6SbUTiKLJRQUo8vROetIFdTeJoMzBSSdgSqP">
                                                                                <button class="btn btn-default btn-number" type="submit">
                                                                                    <span class="glyphicon glyphicon-minus"></span>
                                                                                </button>
                                                                            </form>
                                                                        </span>
                                                                        <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" disabled>
                                                                        <span class="input-group-btn">
                                                                            <form method="GET">
                                                                                <input type="hidden" name="_token" value="cFYQ6SbUTiKLJRQUo8vROetIFdTeJoMzBSSdgSqP">
                                                                                <button class="btn btn-default btn-number" type="submit">
                                                                                    <span class="glyphicon glyphicon-plus"></span>
                                                                                </button>
                                                                            </form>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-8">
                                                <div class="col-md-4 col-sm-4 box m-t-5">
                                                    <div class="pricing-headingm">
                                                        <div class="bg-master-green p-t-20 p-b-20">
                                                            <h5 class="block-title text-center text-white no-margin">BOOK ANYTIME</h5>
                                                        </div>
                                                    </div>
                                                    <div class="pricing-details m-t-20" align="center">
                                                        <ul class="no-style">
                                                            <li class="text-red fs-16 normal m-b-25"><span class="bold"><i class="fa fa-check"></i>&nbsp;BEST VALUE!</span></li>
                                                        </ul>
                                                        <p class="text-black">Service anytime available <br>
                                                            Certificate of Destruction <br>
                                                            Recycling<br>
                                                            Dedicated Account Manager<br>
                                                            Convenient Billing
                                                        </p>
                                                        <h1><b>$250.00</b></h1>
                                                        <button type="button" class="btn btn-green">Book Now</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 box m-t-5">
                                                    <div class="pricing-headingm">
                                                        <div class="bg-menu-blue p-t-20 p-b-20">
                                                            <h5 class="block-title text-center text-white no-margin">NEXT WEEK</h5>
                                                        </div>
                                                    </div>
                                                    <div class="pricing-details m-t-20" align="center">
                                                        <br><br>
                                                        <p class="text-black">Service within 7-10 days <br>
                                                            Certificate of Destruction <br>
                                                            Recycling<br>
                                                            Dedicated Account Manager<br>
                                                            Convenient Billing
                                                        </p><br>
                                                        <h1><b>$250.00</b></h1>
                                                        <button type="button" class="btn btn-blue">Book Now</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 box m-t-5">
                                                    <div class="pricing-headingm">
                                                        <div class="bg-menu-blue p-t-20 p-b-20">
                                                            <h5 class="block-title text-center text-white no-margin">THIS WEEEK</h5>
                                                        </div>
                                                    </div>
                                                    <div class="pricing-details m-t-20" align="center">
                                                        <br><br>
                                                        <p class="text-black">Service within 2-3 days <br>
                                                            Priority Queue <br>
                                                            Certificate of Destruction <br>
                                                            Recycling<br>
                                                            Dedicated Account Manager<br>
                                                            Convenient Billing
                                                        </p>
                                                        <h1><b>$250.00</b></h1>
                                                        <button type="button" class="btn btn-blue">Book Now</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-12 col-md-6 m-t-30" align="right">
                                                        <button type="button" id="next_btn_3" class="btn btn-success">NEXT</button>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-12 col-md-6 m-t-30" align="left">
                                                        <button type="button" id="prev_btn_2" class="btn btn-back">BACK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 3 End -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="p-b-65 p-t-20 bg-menu-blue">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-6 col-md-4">
                <h1 class="text-white"><b>TRUSTED</b></h1>
                <p class="text-white fs-14">We are the proven document
                    <br>shredding service company. Trusted
                    <br>by small businesses and enterprises to
                    <br>securely destroy confidential
                    <br>information in a timely and cost
                    <br>effective manner.
                </p>
            </div>
            <div class="col-12 col-xs-12 col-sm-6 col-md-8 star">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
        </div>
    </div>
</section>

<!-- Off Site Shredding -->
<section class="p-b-40 p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="m-t-5 light">City Shredding Service</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia
                    deserunt mollit anim id est laborum.</p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding" src="{{ url('home_assets/images/color_wheel.png') }}" alt="">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="m-t-25 light">Our Service Areas</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia
                    deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia
                    deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia
                    deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <p class=" m-t-15">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                    nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum
                    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                    officia
                    deserunt mollit anim id est laborum.</p>
            </div>
        </div>
        <hr class="double">
    </div>
</section>
<!-- Off Site Shredding -->

<!----------------- javascript for map address--------------------------------------->
<script type="text/javascript">
    $(document).ready(function() {
        var myLatLng = {
            lat: 47.774241,
            lng: -94.031905
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: myLatLng
        });
        var currCenter = null;

        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'long_name',
            country: 'long_name',
            postal_code: 'short_name'
        };
        var component_map = {
            street_number: 'street_no',
            route: 'address',
            locality: 'city',
            administrative_area_level_1: 'state',
            country: 'country',
            postal_code: 'zip'
        };
        $(document).on("keypress", 'form #autocomplete', function(e) {
            if (e.which == 13) return false;
            if (e.which == 13) e.preventDefault();
        });
        $("#autocomplete").on("keyup", function(e) {
            e.preventDefault();
            var code = e.keyCode || e.which;
            if (code == 40) {
                if ($('.serachwrap .focus').length == 0)
                    $('.serachwrap li:first-child').addClass('focus');
                else {
                    var el = $('.serachwrap li.focus');
                    $('.serachwrap li').removeClass('focus');
                    el.next('li').addClass('focus');
                }
                return;
            } else if (code == 38) {
                if ($('.serachwrap .focus').length == 0)
                    $('.serachwrap li:last-child').addClass('focus');
                else {
                    var el = $('.serachwrap li.focus');
                    $('.serachwrap li').removeClass('focus');
                    el.prev('li').addClass('focus');
                }
                return;
            } else if (code == 13) {
                e.preventDefault();
                var el = $('.serachwrap li.focus');
                if (el.length) {
                    var string = $('.serachwrap li.focus').attr('title');
                    $('#autocomplete').val(string);
                    var geocd = new google.maps.Geocoder();
                    geocd.geocode({
                        "address": string
                    }, fillInAddress);
                    $('#result').hide();
                    return false;
                }
            }
            $('#result').hide();
            $('#result').html('');
            var inputData = $("#autocomplete").val();
            service = new google.maps.places.AutocompleteService();
            var request1 = {
                input: inputData,
                types: ['geocode'],
                componentRestrictions: {
                    country: 'us'
                },
            };
            var request2 = {
                input: inputData,
                types: ['geocode'],
                componentRestrictions: {
                    country: 'ca'
                },
            };
            $('#result').empty();
            //service.getPlacePredictions(request1, callback);//remove if only for CA
            service.getPlacePredictions(request2, callback); //remove if only for US
        });
        $(document).on('click', '.serachwrap li', function() {
            var string = $(this).attr('title');
            $('#autocomplete').val(string);
            var geocd = new google.maps.Geocoder();
            geocd.geocode({
                "address": string
            }, fillInAddress);
            $('#result').hide();
        });

        function callback(predictions, status) {
            $('#result').html('');
            $('#result').hide();
            var resultData = '';
            if (predictions != '') {
                for (var i = 0; i < predictions.length; i++) {
                    resultData += '<li title="' + predictions[i].description +
                        '"><i class="fa fa-map-marker"></i>' + predictions[i].description + '</li>';
                }
                if ($('#result').html() != undefined && $('#result').html() != '') {
                    resultData = $('#result').html() + resultData;
                }
                if (resultData != undefined && resultData != '') {
                    $('#result').html(resultData).show();
                    $('#result').show();
                }
            }
        }

        marker = null;

        function fillInAddress(results, status) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();

            if (marker != null) {
                marker.setMap(null);
            }
            var point = {
                lat: latitude,
                lng: longitude
            };
            marker = new google.maps.Marker({
                position: point,
                map: map,
                title: 'Your location'
            });
            map.setCenter(point);
            currCenter = map.getCenter();
            if (results[0].geometry.viewport)
                map.fitBounds(results[0].geometry.viewport);
            $('.step1').find('input:not(#autocomplete)').val('');
            $.map(results, function(item) {
                //$('.step1 .map-section').removeClass('col-md-12').addClass('col-md-6');
                $('.step1 .map_sec #next_btn_1').removeClass('hide');
                var street_number = "";
                var route = "";
                var locality = "";
                var administrative_area_level_1 = "";
                var country = "";
                var postal_code = "";
                for (var i = 0; i < item.address_components.length; i++) {
                    var addressType = item.address_components[i].types[0];
                    if (componentForm[addressType]) {
                        var val = item.address_components[i][componentForm[addressType]];
                        if (addressType == "street_number") {
                            street_number = val;
                        }
                        if (addressType == "route") {
                            route = val;
                        }
                        if (addressType == "locality") {
                            locality = val;
                        }
                        if (addressType == "administrative_area_level_1") {
                            administrative_area_level_1 = val;
                        }
                        if (addressType == "country") {
                            country = val;
                        }
                        if (addressType == "postal_code") {
                            postal_code = val;
                        }
                        //alert(addressType+"->"+component_map[addressType]);
                        //document.getElementById(component_map[addressType]).value = val;
                    }
                }
                document.getElementById("country").value = country;
                document.getElementById("address").value = street_number + " " + route;
                document.getElementById("city").value = locality;
                document.getElementById("lontude").value = longitude;
                document.getElementById("latude").value = latitude;
                $(function() {
                    $('[name=province] option').filter(function() {
                        return ($(this).text() == administrative_area_level_1);
                    }).prop('selected', true);
                });
                if (postal_code) {
                    postal_code_array = postal_code.split(" ");
                    document.getElementById("zip").value = postal_code_array[0] == null ? '' :
                        postal_code_array[0];
                    document.getElementById("zip2").value = postal_code_array[1] == null ? '' :
                        postal_code_array[1];
                }
                google.maps.event.trigger(map, 'resize');
            });
        }
        google.maps.event.addListener(map, 'resize', function() {
            map.setCenter(currCenter);
        });
        google.maps.event.addListener(map, 'bounds_changed', function() {
            if (currCenter) {
                map.setCenter(currCenter);
            }
            currCenter = null;
        });
    });
</script>
@stop

@section('footer')
@include('home.includes.footer')
@stop