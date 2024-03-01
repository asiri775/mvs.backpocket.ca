@extends('includes.newmaster2')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">


<div class="home-wrapper">
    <div class="section-padding signup-area-wrapper wow fadeInUp">
        <div class="container">

            <div class="row">
                <div class="col-sm-3 col-xs-12 hidden-xs col-sm-offset-2">
                    <div class="text-right">
                        <img class="login-logo" src="{{ url('/assets/img/ube_logo_ig.png') }}">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="newAccount-area">
                        <h2 class="signIn-title">Create a new Vendor account</h2>
                        <hr />

                        @if ($message = Session::get('message'))
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('name'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('name') }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('email'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('email') }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('password'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('password') }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('address'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('address') }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('phone'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('phone') }}</strong>
                        </div>
                        @endif
                        @if ($errors->has('giftcode'))
                        <div class="alert alert-danger alert-dismissable">
                            <strong>* {{ $errors->first('giftcode') }}</strong>
                        </div>
                        @endif
                        <form action="{{route('vendor.reg.submit')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="name">Vendor Name <span>*</span></label>
                                    <input class="form-control" value="{{ old('name') }}" type="text" name="name" id="name" required autocomplete="off">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="shop_name">Shop Name <span>*</span></label>
                                    <input class="form-control" value="{{ old('shop_name') }}" type="text" name="shop_name" id="shop_name" required autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="reg_email">Email Address<span>*</span></label>
                                    <input class="form-control" value="{{ old('email') }}" type="email" name="email" id="reg_email" required autocomplete="off">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="reg_Pnumber">Phone Number <span>*</span></label>
                                    <input id="yourphone" class="form-control" value="{{ old('phone') }}" type="text" name="phone" required autocomplete="off">
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-12 form-group">
                                    <label for="reg_Pnumber">Address <span>*</span></label>
                                    {{--<input class="form-control" type="text" name="address" id="address" required>--}}
                                    <input id="pac-input" class="form-control" type="text" placeholder="Enter a location" value="{{ Session::get('address')}}" required autocomplete="off">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="reg_password">Password <span>*</span></label>
                                    <input class="form-control" type="password" name="password" id="reg_password" required autocomplete="off">
                                    <span toggle="#reg_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label for="confirm_password">Confirm Password <span>*</span></label>
                                    <input class="form-control" type="password" name="password_confirmation" id="confirm_password" required autocomplete="off">
                                    <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="btn btn-md login-btn" id="sign-btn" type="submit" value="SIGN UP">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                                        <a href="{{url('/vendor')}}">Already Have Account?</a>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" value="" name="lat" id="lat">
                            <input type="hidden" value="" name="lng" id="lng">
                            <input type="hidden" value="" name="address" id="location">
                            <input class="field" value="" name="route" id="route" type="hidden" />
                            <input class="field" value="" name="locality" id="locality" type="hidden" />
                            <input class="field" value="" name="administrative_area_level_1" id="administrative_area_level_1" type="hidden" />
                            <input class="field" value="" name="country" id="country" type="hidden" />
                            <input class="field" name="postal_code" id="postal_code" type="hidden" />
                            <input class="field" name="street_number" id="street_number" type="hidden" />

                            <div id="map" style="height: 300px;width: 100%" hidden></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places&callback=initMap" async defer></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

<script src="{{ URL::asset('assets2/js/registervendor.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.maskedinput.js')}}"></script>
<script src="{{ URL::asset('assets2/js/registervendor.js') }}"></script>

@stop