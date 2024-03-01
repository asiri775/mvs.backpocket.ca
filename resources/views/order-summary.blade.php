@extends('includes.newmaster2',['cart_result'=> $response])
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/order-summery.css') }}">
    <?php
$price=0;
$items =0;
    foreach($response as $res){
        $price += $res->cost * $res->quantity;
        $items += $res->quantity;
    }

    $discount = 0;
    if(Session::has('coupon')){
        $discount = App\Coupon::calculateDiscount(Session::get('coupon'), $price);
    }
    $setting = DB::select('select * from settings where id=1');
    $delivery_fee = $setting[0]->delivery_fee;
    $donation_amount = $setting[0]->donation_amount;

?>
<div class="home-wrapper">

    <div class="container-fluid">
        <!-- Starting of product filter area -->
        <div class="section-padding product-filter-wrapper wow fadeInUp">

            <div class="container inner-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>* {{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>* {{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    @if(Session::has('message'))
                                    <div class="alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ Session::get('message') }}
                                    </div>
                                    @endif
                                    @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="row"></div>
                                        <h4 class="sec-title">Existing Customers</h4>
                                        <form action="{{route('user.login.submit') }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="email">Email Address <span>*</span></label>
                                                <input class="form-control" value="{{ old('email') }}" type="email"
                                                    name="email" id="email1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password <span>*</span></label>
                                                <input class="form-control" type="password" name="password"
                                                    id="password" required>
                                                <input class="form-control" type="hidden" value="summary" name="page"
                                                    id="page1" required>
                                            </div>

                                            <div class="form-group">
                                                <input class="btn btn-md login-btn" type="submit" value="LOGIN">
                                                {{-- or <i class="fab fa-facebook-square"></i> LOGIN --}}
                                            </div>
                                            <div class="form-group">
                                                <a href="{{route('user.forgotpass')}}">Forgot your Password?</a>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="sec-title">New Customers</h4>
                                        <form action="{{route('user.reg.submit')}}" method="post">

                                            {{csrf_field()}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="first_name">First Name <span>*</span></label>
                                                        <input class="form-control" value="{{ old('first_name') }}"
                                                            type="text" name="first_name" id="first_name" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="last_name">Last Name <span>*</span></label>
                                                        <input class="form-control" value="{{ old('last_name') }}"
                                                            type="text" name="last_name" id="last_name" required="">
                                                        <input class="form-control" type="hidden" value="summary"
                                                            name="page" id="page" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email Address <span>*</span></label>
                                                        <input class="form-control" value="{{ old('email') }}"
                                                            type="email" name="email" id="email" required=""
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">Phone <span>*</span></label>
                                                        <input id="yourphone" class="form-control"
                                                            value="{{ old('phone') }}" type="text" name="phone"
                                                            id="phone" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="reg_password">Password<span>*</span></label>
                                                        <input class="form-control" type="password" name="password"
                                                            id="reg_password" required>
                                                        <span toggle="#reg_password"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="confirm_password">Confirm Password<span>*</span></label>
                                                        <input class="form-control" type="password"
                                                            name="password_confirmation" id="confirm_password" required>
                                                        <span toggle="#confirm_password"
                                                            class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-lg-12">
                                                    <input id="pac-input" class="form-control" type="text"
                                                        placeholder="Enter a location"
                                                        value="{{ Session::get('address')}}" autocomplete="off"
                                                        required><br>

                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col col-lg-12">



                                                    {{-- <div id="type-selector" class="controls">

                                                        </div> --}}
                                                    <div id="map" style="height: 300px;width: 100%"></div>
                                                    <br>
                                                    <input type="hidden" value="" name="lat" id="lat">
                                                    <input type="hidden" value="" name="lng" id="lng">
                                                    <input type="hidden" value="{{old('address') }}" name="address"
                                                        id="location">
                                                    <input type="hidden" name="uniqueid"
                                                        value="{{Session::get('uniqueid')}}">

                                                </div>

                                                <table id="address" hidden>
                                                    <tr>
                                                        <td class="label">Street address</td>
                                                        <td class="slimField"><input class="field" name="street_number"
                                                                id="street_number" disabled="true" /></td>
                                                        <td class="wideField" colspan="2"><input class="field"
                                                                value="{{old('route') }}" name="route" id="route"
                                                                disabled="true" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="label">City</td>
                                                        <td class="wideField" colspan="3"><input class="field"
                                                                value="{{old('locality') }}" name="locality"
                                                                id="locality" disabled="true" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="label">State</td>
                                                        <td class="slimField"><input class="field"
                                                                value="{{old('administrative_area_level_1') }}"
                                                                name="administrative_area_level_1"
                                                                id="administrative_area_level_1" disabled="true" /></td>
                                                        <td class="label">Zip code</td>
                                                        <td class="wideField"><input class="field" name="postal_code"
                                                                id="postal_code" disabled="true" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="label">Country</td>
                                                        <td class="wideField" colspan="3"><input class="field"
                                                                value="{{old('country') }}" name="country" id="country"
                                                                disabled="true" /></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <!--End of row-->


                                            <!--End of conatiner-->

                                            {{--<div class="form-group">
                                         <label for="first_name">Phone <span>*</span></label>
                                        <input class="form-control" value="" placeholder="Search" type="text"
                                            name="first_name1" id="first_name1" required="">
                                    </div>--}}
                                            {{--<div class="row">
                                                <div class="col-md-4">
                                                    123 Anywhere St, <br>
                                                    City, State <br>
                                                    Country, Postal Code
                                                </div>
                                                <div class="col-md-8">
                                                    <div id="googleMap" style="width:100%;height:250px;"></div>
                                                </div>
                                            </div>--}}

                                            <div class="form-group">
                                                <br>
                                                <input class="btn btn-md login-btn" type="submit" value="CONTINUE">
                                                {{-- or <i class="fab fa-facebook-square"></i> LOGIN --}}
                                            </div>
                                            {{-- @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>* {{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>* {{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                            @if(Session::has('message'))
                                            <div class="alert alert-success alert-dismissable">
                                                <a href="#" class="close" data-dismiss="alert"
                                                    aria-label="close">&times;</a>
                                                {{ Session::get('message') }}
                                            </div>
                                            @endif --}}
                                        </form>
                                        <input type="hidden" name="latitude" id="latitude"
                                            value="{{ Session::get('lat')}}" />
                                        <input type="hidden" name="logtitude" id="longitude"
                                            value="{{ Session::get('lng')}}" />

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div id="tableArea">
                                    @if($response->count() == 0)
                                    <div class="text-center" id="emptyCart">
                                        Hey! Looks like your cart is empty, Please add some products! <br>
                                        <a href="{{ url('/category/dry-clean-laundry') }}"><i
                                                class="fas fa-cart-arrow-down"></i></a>
                                    </div>
                                    @else
                                    <table id="productTable" class="table table-striped tabele-bordered"
                                        style="margin-top:20px;">
                                        <thead>
                                            <tr style="text-transform: uppercase;">
                                                <th>Item</th>
                                                <th class="text-center">QTY</th>
                                                <th class="text-left">Rate</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>

                                        <tbody style="font-size: 12px; font-weight: 500;">
                                            @foreach($response as $res)
                                            <tr>
                                                <td>
                                                    <a
                                                        href="{{ route('product.details', ['id' => $res->id, 'title' => str_slug(str_replace(' ', '-', $res->title))]) }}">{{ $res->title }}</a>
                                                </td>
                                                <td class="text-center">
                                                    {{ $res->quantity }}
                                                </td>
                                                <td class="text-left">
                                                    {{-- <img class="credit-sign"
                                                                            src="{{ url('/') . '/assets2/images/rsign.png' }}"
                                                    alt=""> --}}
                                                    $ {{ number_format((float)$res->cost, 2, '.', '') }}
                                                </td>
                                                <td class="text-center">
                                                    {{-- <img class="credit-sign"
                                                                        src="{{ url('/') . '/assets2/images/rsign.png' }}"
                                                    alt=""> --}}
                                                    $
                                                    {{ number_format((float)$res->cost * $res->quantity, 2, '.', '') }}
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr style="background-color:#ffffff;">
                                                <td colspan="5">
                                                    <table id="totalTable">
                                                        <tr>
                                                            <td style="float:right">
                                                                Subtotal:
                                                            </td>
                                                            <td class="text-right">
                                                                ${{ number_format((float)$price, 2, '.', '') }}
                                                            </td>
                                                        </tr>
                                                        @if(Session::has('coupon'))
                                                        <tr>
                                                            <td style="float:right">
                                                                Discount:
                                                            </td>
                                                            <td class="text-right">
                                                                -${{ number_format((float)$discount, 2, '.', '') }}
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td style="float:right">
                                                                Delivery:
                                                            </td>
                                                            <td class="text-right">
                                                                <?php
                                                                            $setting = DB::select('select * from settings where id=1');
                                                                            $delivery_fee=$setting[0]->delivery_fee;
                                                                    ?>
                                                                ${{ number_format((float)$delivery_fee, 2, '.', '') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="float:right">
                                                                Tax (13%):
                                                            </td>
                                                            <td class="text-right">
                                                                ${{ number_format((float) ($price+$delivery_fee) * 13/100, 2, '.', '') }}
                                                            </td>
                                                        </tr>
                                                        <tr >
                                                            <td style="float:right">
                                                            <span style='float:right'
                                                            class="capital popovers" data-toggle="popover" title="" data-content="Help Us Make A Difference!
Your small micro donation will go towards providing free services and programs for Mental Health.  In addition, this Merchant will also generously match your donation. <br> <br> <a href='https://dryclean.io/makeitcount.php' title='test add link'>Click Here </a> to learn more about this program
and the Janeen Foundation" data-original-title="Make It Count"><img
                                                                                class='makeitcounticon'
                                                                                src='{{ url('assets/img/3742-300x300.jpg') }}'>Make
                                                                            it count <i class="helpicon far fa-question-circle"></i>: </span>
                                                            </td>
                                                            <td class="text-right">
                                                                ${{ number_format((float)$donation_amount, 2, '.', '') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="line" style="float:right">
                                                                <b>Grand Total:</b>
                                                            </td>
                                                            <td class="line text-right">
                                                                <b>${{ number_format((float)($price+$delivery_fee) * 13/100 + $price - $discount + $delivery_fee + $donation_amount, 2, '.', '') }}</b>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr style="background-color:#ffffff;">
                                                <td colspan="4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            @if(!Session::has('coupon'))
                                                            <h5 class="card-title all-caps">Have a Coupon Code?</h5>
                                                            <form action="{{ route('coupon.apply') }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control"
                                                                        id="coupon_code" name="coupon_code"
                                                                        placeholder="Coupon Code" required>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn apply-btn">Apply</button>
                                                            </form>
                                                            @else
                                                            <h5 class="card-title">Coupon Applied</h5>
                                                            <form class="form-inline"
                                                                action="{{ route('coupon.remove') }}" method="POST">
                                                                {{ csrf_field() }}
                                                                {{ method_field('delete') }}
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control"
                                                                        id="coupon_code" name="coupon_code"
                                                                        placeholder="Coupon Code"
                                                                        value="{{ Session::get('coupon')['code'] }}"
                                                                        readonly>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Remove</button>
                                                            </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>

                                    </table>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Ending of product filter area -->
</div>



@stop

@section('footer')
{{--<script src="https://maps.googleapis.com/maps/api/js?key=YAIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc"></script>--}}
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places&callback=initMap"
    async defer></script>

<script src="{{ URL::asset('assets2/js/ordersummary.js') }}"></script>
{{--<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries&callback=myMap">
</script>--}}
{{--<script src="./resources/assets/jquery.maskedinput.js" type="text/javascript"></script>--}}

<script src="{{ URL::asset('assets/js/jquery.maskedinput.js')}}"></script>
{{-- <script src="{{ URL::asset('assets/js/jquery.maskedinput.js')}}"></script> --}}

<script src="{{ URL::asset('assets2/js/ordersummary.js') }}"></script>

@stop