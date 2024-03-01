@extends('home.includes.master')

@section('header')
@include('home.includes.header')
@stop

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ url('home_assets/css/jquery-ui.css') }}">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places"></script>
<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/home/quote_request.css') }}">
<script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
<script src="{{ URL::asset('assets/map/js/jquery.blockUI.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="{{ url('home_assets/js/functions.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $.blockUI.defaults = {

            message: '&lt;h1&gt;Please wait...&lt;/h1&gt;',

            title: null,

            draggable: true,

            theme: false,

            css: {
                padding: 0,
                margin: 0,
                width: '45%',
                top: '10%',
                left: '30%',
                textAlign: 'center',
                color: '#000',
                border: '3px solid #aaa',
                backgroundColor: '#fff'
                //cursor: 'wait'
            },

            themedCSS: {
                width: '30%',
                top: '40%',
                left: '35%'
            },

            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.6
                //cursor: 'wait'
            },

            cursorReset: 'default',

            growlCSS: {
                width: '350px',
                top: '10px',
                left: '',
                right: '10px',
                border: 'none',
                padding: '5px',
                opacity: 0.6,
                cursor: null,
                color: '#fff',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px'
            },

            iframeSrc: /^https/i.test(window.location.href || '') ? 'javascript:false' : 'about:blank',

            forceIframe: false,

            baseZ: 1000,

            centerX: true,

            centerY: true,

            allowBodyStretch: true,

            bindEvents: true,

            constrainTabKey: true,

            fadeIn: 200,

            fadeOut: 400,

            timeout: 0,

            showOverlay: true,

            focusInput: true,

            onBlock: null,

            onUnblock: null,

            quirksmodeOffsetHack: 4,

            blockMsgClass: 'blockMsg',

            ignoreIfBlocked: false
        };

        $('.btn-fo-next').click(function() {
            var next_step = $(this).data('next');
            if (next_step == "step2") {

                $(".address_error").html("");
                $(".street_no_error").html("");
                $(".state_error").html("");
                $(".city_error").html("");
                $(".zip_error").html("");

                if (!$("#address").val() || $("#address").val() == " ") {
                    $(".address_error").html("Address is required");
                } else if (!$("#street_no").val() || $("#street_no").val() == " ") {
                    $(".street_no_error").html("Street number is required");
                } else if (!$("#state").val() || $("#state").val() == " ") {
                    $(".state_error").html("State is required");
                } else if (!$("#city").val() || $("#city").val() == " ") {
                    $(".city_error").html("City is required");
                } else if (!$("#zip").val() || $("#zip").val() == " ") {
                    $(".zip_error").html("Zip Code is required");
                } else if ($("#zip").val().length < 7) {
                    $(".zip_error").html("Zip Code is invalid");
                } else {
                    $('.step-pane.step1').hide();
                    $("li[data-target='step1']").removeClass('active');
                    $('.step-pane.step2').removeClass('hide');
                    $("li[data-target='step2']").addClass('active');
                }
            }

            if (next_step == "step3") {
                $(".service_type_error").html("");
                $(".quantity_error").html("");
                $(".container_error").html("");

                if ($("#service_type").val() == 0) {
                    $(".service_type_error").html("Service Type is required");
                } else if ($("#quantity").val() == "") {
                    $(".quantity_error").html("Quantity is required");
                } else if ($("#container").val() == 0) {
                    $(".container_error").html("Container type is required");
                } else {
                    $('.step-pane.step2').hide();
                    $("li[data-target='step2']").removeClass('active');
                    $('.step-pane.step3').removeClass('hide');
                    $("li[data-target='step3']").addClass('active');
                }
            }

            if (next_step == "step4") {

                $(".firstname_error").html("");
                $(".lastname_error").html("");
                $(".email_error").html("");
                $(".phone_error").html("");

                if ($("#firstname").val() == "") {
                    $(".firstname_error").html("First name is required");
                } else if ($("#lastname").val() == "") {
                    $(".lastname_error").html("Last name is required");
                } else if ($("#email").val() == "") {
                    $(".email_error").html("Email is required");
                } else if ($("#phone").val() == "") {
                    $(".phone_error").html("Phone is required");
                } else {
                    $('.step-pane.step3').hide();
                    $("li[data-target='step3']").removeClass('active');
                    $('.step-pane.step4').removeClass('hide');
                    $("li[data-target='step4']").addClass('active');
                }
            }
        });

        $('.submit').click(function() {
            $cap = $("#CaptchaDiv").text();
            $input = $("#CaptchaInput").val();

            $(".captcha_error").html("");

            if ($input != $cap) {
                $(".captcha_error").html("Please, enter the correct captcha");
            } else {
                $("#main-form").submit();
            }
        });

        $('.btn-prev').click(function() {
            var prev_step = $(this).data('back');
            if (prev_step == "step1") {
                $('.step-pane.step2').addClass('hide');
                $("li[data-target='step2']").removeClass('active');
                $('.step-pane.step1').show();
                $("li[data-target='step1']").addClass('active');
            }

            if (prev_step == "step2") {
                $('.step-pane.step3').addClass('hide');
                $("li[data-target='step3']").removeClass('active');
                $('.step-pane.step2').show();
                $("li[data-target='step2']").addClass('active');
            }

            if (prev_step == "step3") {
                $('.step-pane.step4').addClass('hide');
                $("li[data-target='step4']").removeClass('active');
                $('.step-pane.step3').show();
                $("li[data-target='step3']").addClass('active');
            }
        });

        $(".close-box-button").click(function() {
            $.unblockUI();
        });

        $("#zip").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#zip2').focus();
            }
        });

        $("#txt_fsa1").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#txt_fsa2').focus();
            }
        });

        $("#phone1").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#phone2').focus();
            }
        });

        $("#phone2").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#phone3').focus();
            }
        });

        $("#txt_phone1").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#txt_phone2').focus();
            }
        });

        $("#txt_phone2").keyup(function() {
            var val = $(this).val();
            if (val.length == 3) {
                $('#txt_phone3').focus();
            }
        });
    });
</script>

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
<section class="p-t-90 p-b-50">
    <div class="boxed no-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div id="wizard-form" class="wizard m-t-50">
                        <ul class="steps">
                            <li data-target="step1" class="active"><span class="badge badge-info">1</span>Location<span class="chevron"></span></li>
                            <li data-target="step2"><span class="badge">2</span>Services<span class="chevron"></span></li>
                            <li data-target="step3"><span class="badge">3</span>Contact Info<span class="chevron"></span></li>
                            <li data-target="step4"><span class="badge">4</span>Promo Code<span class="chevron"></span></li>
                        </ul>
                    </div>

                    <form method="post" action="{{ url('/request_quote/submit') }}" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12">
                        {{csrf_field()}}
                        <div class="step-content">
                            <!-- Step 1 Start -->
                            <div class="step-pane step1 m-t-40">
                                <div class="map-section col-md-12 col-sm-12 col-xs-12">
                                    <div id="locationField">
                                        <input autocomplete="off" id="autocomplete" placeholder="Enter address here" type="text"></input>
                                        <ul id="result" class="serachwrap"></ul>
                                    </div>
                                    <div id="map"></div>
                                </div>
                                <div class="address-form-block col-md-6 col-sm-12 col-xs-12 hide">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-3" for="address"><span class="text-red">*</span>&nbsp;Address:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="address" id="address" placeholder="Enter address">
                                                <small><span class="text-red address_error"></span></small>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-3" for="unit"><span class="text-red">*</span>&nbsp;Street No:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="street_no" id="street_no" placeholder="Enter Street No">
                                                <small><span class="text-red street_no_error"></span></small>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-3" for="unit">Unit:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="unit" id="unit" placeholder="Enter unit">
                                            </div>
                                        </div>

                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-3" for="state"><span class="text-red">*</span>&nbsp;State/Province:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="state" id="state" placeholder="Enter state/province">
                                                <small><span class="text-red state_error"></span></small>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-3" for="service_requested"><span class="text-red">*</span>&nbsp;City:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="city" id="city" placeholder="Enter your city">
                                                <small><span class="text-red city_error"></span></small>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-3" for="zip"><span class="text-red">*</span>&nbsp;Zip/Postal Code:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="zip" id="zip" placeholder="Enter zip/postal code">
                                                <small><span class="text-red zip_error"></span></small>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="col-sm-9">
                                                <input type="hidden" name="country" id="country">
                                                <input type="hidden" id="lontude" name="lontude">
                                                <input type="hidden" id="latude" name="latude">
                                            </div>
                                        </div>
                                        <div class="text-right col-xs-12">
                                            <div class="actions col-xs-12">
                                                <button type="button" data-next="step2" class="btn btn-fo-next">Next<i class="icon-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 2 Start -->
                            <div class="step-pane step2 hide m-t-50">
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-4" for="service_requested">Please select the type of service you are looking for:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="service_type" id="service_type">
                                                <option value="0">-- Service Type --</option>
                                                <option value="One Time Bulk Shredding">One Time Bulk Shredding</option>
                                                <option value="Shredding Serive on a Regular Basis">Shredding Serive on a Regular Basis</option>
                                                <option value="Drop Off Shredding">Drop Off Shredding</option>
                                            </select>

                                            <small><span class="text-red service_type_error"></span></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-4" for="boxes">Please enter the quantity:</label>
                                        <div class="col-sm-8">
                                            <input class="form-control col-xs-2" type="number" placeholder="Qty" name="quantity" id="quantity" maxlength="11">
                                            <select class="form-control col-xs-10" name="container" id="container">
                                                <option value="0">-- Container Type --</option>
                                                <option value="Standard File Boxes">Standard File Boxes</option>
                                                <option value="Various Size Boxes / Containers">Various Size Boxes / Containers</option>
                                                <option value="Garbage Bags">Garbage Bags</option>
                                                <option value="Skids">Skids</option>
                                                <option value="Pounds">Pounds</option>
                                            </select>
                                            <small><span class="text-red quantity_error"></span></small>
                                            <small><span class="text-red container_error"></span></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-4" for="service_preference">Service Type:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control col-xs-10" name="service_preference" id="service_preference">
                                                <option value="No Preference">No Preference</option>
                                                <option value="OFF-SITE (Secured Warehouse Shredding)">OFF-SITE (Secured Warehouse Shredding)</option>
                                                <option value="ON-SITE Shredding">ON-SITE Shredding</option>
                                            </select>
                                            <a href="#" target="_blank" class="service_learn permlink">Learn More About Our Services</a>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-4" for="notes">Please provide any other relevant, additional info:</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="notes" id="notes" cols="30" rows="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-4" for="idealstart_date">Ideal Start Date:</label>
                                        <div class="col-sm-8">
                                            <div class=" post-time">
                                                <label class="col-md-4 col-sm-4 col-xs-4 active">
                                                    <input type="radio" name="idealstart_date" class="postingtimes" value="NOW">
                                                    Now
                                                </label>
                                                <label class="col-md-4 col-sm-4 col-xs-4 ">
                                                    <input type="radio" name="idealstart_date" class="postingtimes" value="FLEXIBLE">
                                                    <span class="visible-xs hidden-md hidden-lg text-center margin-top-5">
                                                        <img style="width:32px;" src="{{ URL::asset('home_assets/images/flexibleTime.png')}}" alt="I'm flexible" title="I'm flexible">
                                                    </span>
                                                    <span class="hidden-xs">
                                                        I'm flexible
                                                    </span>
                                                </label>
                                                <label class="col-md-4 col-sm-4 col-xs-4" id="specific_date">
                                                    <input type="radio" name="idealstart_date" class="postingtimes" value="SPECIFIC">
                                                    <span class="visible-xs hidden-md hidden-lg text-center margin-top-5">
                                                        <img style="width:32px;" src="{{ URL::asset('home_assets/images/specificDate.png')}}" alt="Specific Date" title="Specific Date">
                                                    </span>
                                                    <span class="hidden-xs">
                                                        Specific Date
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="contain post-time-content-outer" id="specific_date_content">
                                                <div class="col-md-12 no-padding">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input type="text" id="specificpost_date" name="specificpost_date" class="form-control " placeholder="Date" />
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="col-xs-10" name="am_pm" id="am_pm">
                                                                <option value="AM">AM</option>
                                                                <option value="PM">PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right col-xs-12">
                                        <div class="actions col-xs-12">
                                            <a href="#" target="_blank" class="service_learn2 permlink">Click Here to Learn More About Services and Containers</a>
                                            <a class="btn btn-fo-back  btn-prev" href="javascript:;" data-back="step1"></i>Back</a>
                                            <button type="button" data-next="step3" class="btn btn-fo-next">Next<i class="icon-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step3 Start -->
                            <div class="step-pane step3 hide m-t-50">
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-2" for="company">Company:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="company" id="company" placeholder="Enter company">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-2" for="firstname"><span class="text-red">*</span>&nbsp;First Name:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Enter first name">
                                            <small><span class="text-red firstname_error"></span></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-2" for="lastname"><span class="text-red">*</span>&nbsp;Last Name:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Enter last name">
                                            <small><span class="text-red lastname_error"></span></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-2" for="email"><span class="text-red">*</span>&nbsp;Email:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Enter email">
                                            <small><span class="text-red email_error"></span></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label class="control-label col-sm-2" for="phone"><span class="text-red">*</span>&nbsp;Phone:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Enter phone" >
                                            <small><span class="text-red phone_error"></span></small>
                                        </div>
                                    </div>
                                    <div class="text-right col-xs-12">
                                        <div class="actions col-xs-12">
                                            <a class="btn btn-fo-back  btn-prev" href="javascript:;" data-back="step2"></i>Back</a>
                                            <button type="button" data-next="step4" class="btn btn-fo-next">Next<i class="icon-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 4 Start -->
                            <div class="step-pane step4 hide m-t-50">
                                <!--                                	<div class="map-section col-md-6 col-sm-12 col-xs-12">-->
                                <!--                                        <h3>Chat With Us and Find Out How You Can Save on Shredding!</h3>-->
                                <!--                                        <a href="javascript:$zopim.livechat.window.show()" class="chatagent"><i class="fa fa-user"></i><span>Ask an Agent</span></a>-->
                                <!--                                    </div>-->
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="form-group col-xs-12">
                                            <label class="control-label col-xs-12 promo-label" for="address">Enter Promo Code</label>
                                            <div class="col-sm-12 col-xs-12">
                                                <input class="form-control" type="text" name="promocode" id="promocode" placeholder="Enter promo code">
                                            </div>
                                        </div>
                                        <div class="form-group col-xs-12 captcha_block">
                                            <label class="control-label col-xs-12 promo-label" for="captcha"><span class="text-red">*</span>&nbsp;Please Enter Text From Image</label>
                                            <div class="col-sm-12 col-xs-12">
                                                <!-- START CAPTCHA -->
                                                <br>
                                                <div class="capbox">

                                                    <?php
                                                    $var = str_random(6);
                                                    ?>

                                                    <div id="CaptchaDiv" onclick="changeText()">{{ $var }}</div>

                                                    <div class="capbox-inner">
                                                        Type the number:<br>
                                                        <input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>
                                                    </div>
                                                </div>
                                                <br><br>
                                                <!-- END CAPTCHA -->
                                                <small><span class="text-red captcha_error"></span></small>

                                            </div>
                                        </div>
                                        <div class="text-right col-xs-12">
                                            <div class="actions col-xs-12">
                                                <a class="btn btn-fo-back  btn-prev" href="javascript:;" data-back="step3"></i>Back</a>
                                                <button type="button" class="btn btn-fo-next submit">Submit<i class="icon-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function changeText() {
        $captcha = generateRandomString(6);
        $("#CaptchaDiv").html($captcha);
    }

    function generateRandomString(length) {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var i = 0; i < length; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }
</script>


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
                    resultData += '<li title="' + predictions[i].description + '"><i class="fa fa-map-marker"></i>' + predictions[i].description + '</li>';
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
                //console.log(JSON.stringify(results));
                /*$('#address').val(item.address_components[0]['long_name']);
                $('#city').val(item.address_components[1]['long_name']);*/
                $('.step1 .map-section').removeClass('col-md-12').addClass('col-md-6');
                $('.step1 .address-form-block').removeClass('hide');
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
                document.getElementById("street_no").value = street_number;
                document.getElementById("country").value = country;
                if (street_number != "" || route != "") {
                    document.getElementById("address").value = street_number + " " + route;
                }
                document.getElementById("state").value = administrative_area_level_1;
                document.getElementById("zip").value = postal_code;
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
                    document.getElementById("zip").value = postal_code_array[0] == null ? '' : postal_code_array[0];
                    document.getElementById("zip2").value = postal_code_array[1] == null ? '' : postal_code_array[1];
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

<script>
    $(function() {
        $("#specificpost_date").datepicker();
    });
</script>

@stop

@section('footer')
@include('home.includes.footer')
@stop