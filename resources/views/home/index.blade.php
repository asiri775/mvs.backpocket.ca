@extends('home.includes.master')

@section('header')
@include('home.includes.header')
<script src="https://code.jquery.com/jquery-1.12.1.min.js" name="jquery"></script>
<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDiNJfWJG8MhalcsGzfQrwhx5UWdVLhZvw&libraries=places'>
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var placeSearch, autocomplete;
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
            service.getPlacePredictions(request1, callback);
            service.getPlacePredictions(request2, callback);

        });

        function callback(predictions, status) {

            $('#result').html('');
            $('#result').hide();
            var resultData = '';
            if (predictions != '') {
                for (var i = 0; i < predictions.length; i++) {
                    // resultData += '<li title="' + predictions[i].description + '"><a href="request_quote/?s=' +
                    //     predictions[i].description + '"><i class="fa fa-map-marker"></i>' + predictions[i]
                    //     .description + '</a></li>';

                    resultData += '<li title="' + predictions[i].description + '"><a href="{{ url("/request_quote") }}"><i class="fa fa-map-marker"></i>' + predictions[i]
                        .description + '</a></li>';
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
    });
</script>
@stop

@section('content')
<section class="jumbotron full-vh" data-pages="parallax">
    <div class="inner full-height">
        <div class="swiper-container" id="hero">
            <div class="swiper-wrapper">
                <div class="swiper-slide fit bg-complete">
                    <div class="slider-wrapper">
                        <div class="background-wrapper" data-swiper-parallax="20%">
                            <img src="{{ url('home_assets/images/bkg-home.jpg') }}" class="background" draggable="false" (dragstart)="false;">
                        </div>
                    </div>
                    <div class="content-layer">
                        <div class="inner full-height">
                            <div class="container-xs-height full-height">
                                <div class="col-xs-height col-middle text-left">
                                    <div class="container text-center">
                                        <div class="row">
                                            <div class="col-md-12 m-t-70">
                                                <h1 class="m-t-5 light text-white" data-pages-animation="standard" data-delay="600" data-type="transition.slideDownIn">
                                                    <span class="font-montserrat">Ready to Shred</span>
                                                </h1>
                                                <h2 class="light text-white" data-pages-animation="standard" data-delay="600" data-type="transition.slideDownIn">
                                                    <span class="font-georgia">Los Angeles Shredding Service</span>
                                                </h2> <br>
                                                <p class="small text-white" data-pages-animation="standard" data-delay="600" data-type="transition.slideDownIn">We provide
                                                    GUARANTEED lowest pricing for Secure Paper
                                                    Shredding
                                                    Services<br>
                                                    Request A Quote and get started on shredding personal & confidential
                                                    documents</p>
                                            </div>
                                            <div class="col-md-12 m-t-30" data-pages-animation="standard" data-delay="600" data-type="transition.slideDownIn">
                                                <form method="get" action="request_quote/">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="location-field" align="center">
                                                                <input class="form-control" type="text" id="autocomplete" placeholder="Enter your EXACT address" autocomplete="off" />
                                                                <ul id="result" class="serachwrap"></ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 m-t-20">
                                                            <button type="submit" class="btn btn-default green_btn text-white btn-lg" /><b>Let's
                                                                Get
                                                                Started</b></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-12 m-t-50 img_div" style="z-index: -2;">
                                                <img src="{{ url('home_assets/images/coca-cola.png') }}" width="116" data-pages-animation="standard" data-delay="700" data-type="transition.fadeIn"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="{{ url('home_assets/images/google.png') }}" width="115" data-pages-animation="standard" data-delay="700" data-type="transition.fadeIn"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="{{ url('home_assets/images/apple.png') }}" width="42" data-pages-animation="standard" data-delay="700" data-type="transition.fadeIn"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="{{ url('home_assets/images/canon.png') }}" width="124" data-pages-animation="standard" data-delay="700" data-type="transition.fadeIn"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="{{ url('home_assets/images/nike.png') }}" width="83" data-pages-animation="standard" data-delay="700" data-type="transition.fadeIn"> &nbsp;&nbsp;&nbsp;&nbsp;
                                                <img src="{{ url('home_assets/images/audi.png') }}" width="85" data-pages-animation="standard" data-delay="700" data-type="transition.fadeIn">
                                            </div>
                                            <div class="col-md-12">
                                                <p class="text-white m-t-20">Take a peek at some of our <b>satisfied</b>
                                                    customers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mouse-wrapper">
                <div class="mouse">
                    <div class="mouse-scroll"></div>
                </div>
            </div>
            <div class="swiper-navigation swiper-rounded swiper-white-solid swiper-button-prev"></div>
            <div class="swiper-navigation swiper-rounded swiper-white-solid swiper-button-next"></div>
        </div>
    </div>
</section>
<section class="p-b-20 p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 text-center hover-push demo-story-block">
                <div class="hover-backdrop" style="background:url('home_assets/images/offsiteshredding.jpg');"></div>
                <div class="hover-caption bottom-left bottom-right p-b-70">
                    <h4 class="text-white m-b-25">Paint it the way you like it!</h4>
                    <a class="font-montserrat fs-12 hint-text text-white all-caps">More information</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 text-center bg-success hover-push demo-story-block">
                <div class="hover-backdrop" style="background:url('home_assets/images/mobileshredding.jpg');"></div>
                <div class="hover-caption bottom-left bottom-right p-b-70">
                    <h4 class="text-white m-b-25">Capture the moments</h4>
                    <a class="font-montserrat fs-12 hint-text text-white all-caps">More information</a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 text-center bg-success hover-push demo-story-block">
                <div class="hover-backdrop" style="background:url('home_assets/images/dropoffshredding.jpg');"></div>
                <div class="hover-caption bottom-left bottom-right p-b-70">
                    <h4 class="text-white m-b-25">Digital solutions led by<br>
                        clarity, simplicity & honesty</h4>
                    <a class="font-montserrat fs-12 hint-text text-white all-caps">More information</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="p-b-65 p-t-40 bg-master-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-6 col-md-4">
                <h1 class="text-white"><b>PROVEN</b></h1>
                <p class="text-white fs-14">15 YEARS
                    <br>10,000 + CUSTOMERS
                    <br>2 MILLION + BOXES DESTROYED
                    <br>ZERO DATA BREACH
                </p>
            </div>
            <div class="col-12 col-xs-12 col-sm-6 col-md-8">
                <h2 class="text-white"><b>About Us</b></h2>
                <p class="text-white fs-13">
                    StartShredding is a national document destruction and records management company based out of
                    Toronto, Canada. Founded in 2005, we have consistently proven to be the trusted name and industry
                    leader. Trusted by over 10,000 Clients, we utilize best of breed technology, attention to details
                    and unparalleled commitment to customer service, that brings repeat customers every single year.
                </p>
            </div>
        </div>
    </div>
</section>
<section class="p-b-40 p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="m-t-5 light">Off Site Shredding</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <p class=" m-t-15">The most secure and cost-effective way to destroy your documents.
                    Convenient, Reliable, and Trusted by thousands of our clients.
                </p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding" src="{{ url('home_assets/images/color-wheel.jpg') }}" alt="">
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <h6 class="block-title"><b>SECURE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">Our plant facilities are equipped with best of breed technology, to securely destroy
                    documents in a timely manner.</p>
                <h6 class="block-title m-t-50"><b>BEST VALUE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">Our cost efficient systems and processes ensure that our Clients receive the best
                    value in shredding services.</p>
                <h6 class="block-title m-t-50"><b>TRUSTED</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">From City services, government offices, and small businesses, thousands of clients
                    rely on our secure offsite shredding service.</p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-12 m-t-20" align="center">
                <button type="button" class="btn btn-success"><b>HOW IT WORKS</b></button> &nbsp;&nbsp;
                <button type="button" class="btn btn-green"><b>BOOK NOW</b></button>
            </div>
        </div>
        <hr class="double">
    </div>

    <div class="container p-t-20">
        <div class="row">
            <div class="col-md-12">
                <h2 class="m-t-5 light">Mobile Shredding</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <p class=" m-t-15">Secure destruction of your material right on your premises.
                    Convenient, Reliable, and Trusted by thousands of our clients.
                </p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <h6 class="block-title"><b>SECURE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">With Onsite Shredding, your documents are destroyed securely utilizing our best of
                    breed technology</p>
                <h6 class="block-title m-t-50"><b>CONVENIENT</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">The destruction process occurs right on your premises at a time that is convenient
                    for you.</p>
                <h6 class="block-title m-t-50"><b>RELIABLE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class=" m-t-15">Our team works hard to ensure your service is completed in a timely and
                    cost-effective manner.</p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding" src="{{ url('home_assets/images/color-wheel.jpg') }}" alt="">
            </div>

            <div class="col-xs-12 col-sm-6 col-md-12 m-t-20" align="left">
                <button type="button" class="btn btn-success"><b>HOW IT WORKS</b></button> &nbsp;&nbsp;
                <button type="button" class="btn btn-green"><b>BOOK NOW</b></button>
            </div>
        </div>
        <hr class="double">
    </div>

    <div class="container p-t-20">
        <div class="row">
            <div class="col-md-12">
                <h2 class="m-t-5 light">City Shredding Service</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <p class=" m-t-15">We provide a full range of shredding services from coast to coast, with service to
                    nearly every major metropolitan city in the USA and Canada. Our dependable and secure network of
                    mobile shredding and plant shredding facilities has enabled us to provide the same reliable and
                    secure shredding services for clients ranging from individuals to multi national corporations.</p>
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
            <div class="col-xs-6 col-sm-6 col-md-3 m-t-20">
                <ol type="i">
                    <li>New York</li>
                    <li>Los Angeles</li>
                    <li>Chicago</li>
                    <li>Houston[3]</li>
                    <li>Phoenix</li>
                    <li>Philadelphia[e]</li>
                    <li>San Antonio</li>
                    <li>San Diego</li>
                    <li>Dallas</li>
                    <li>San Jose</li>
                    <li>Austin</li>
                    <li>Jacksonville[f]</li>
                </ol>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 m-t-20">
                <ol type="i" start="13">
                    <li>Fort Worth</li>
                    <li>Columbus</li>
                    <li>San Francisco[g]</li>
                    <li>Charlotte</li>
                    <li>Indianapolis[h]</li>
                    <li>Seattle</li>
                    <li>Denver[i]</li>
                    <li>Washington[j]</li>
                    <li>Boston</li>
                    <li>El Paso</li>
                    <li>Detroit</li>
                    <li>Nashville[k]</li>
                </ol>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 m-t-20">
                <ol type="i" start="25">
                    <li>Portland</li>
                    <li>Memphis</li>
                    <li>Oklahoma City</li>
                    <li>Las Vegas</li>
                    <li>Louisville[l]</li>
                    <li>Baltimore[m]</li>
                    <li>Milwaukee</li>
                    <li>Albuquerque</li>
                    <li>Tucson</li>
                    <li>Fresno</li>
                    <li>Mesa</li>
                    <li>Sacramento</li>
                </ol>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 m-t-20">
                <ol type="i" start="37">
                    <li>Atlanta</li>
                    <li>Kansas City</li>
                    <li>Colorado Springs</li>
                    <li>Miami</li>
                    <li>Raleigh</li>
                    <li>Omaha</li>
                    <li>Long Beach</li>
                    <li>Virginia Beach[m]</li>
                    <li>Oakland</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h4><b>Canada</b></h4>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-3 m-t-20">
                <ol type="i">
                    <li>Toronto</li>
                    <li>Montreal</li>
                    <li>Vancouver</li>
                    <li>Calgary</li>
                    <li>Edmonton</li>
                </ol>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 m-t-20">
                <ol type="i" start="6">
                    <li>Ottawa–Gatineau</li>
                    <li>Winnipeg</li>
                    <li>Quebec City</li>
                    <li>Hamilton</li>
                    <li>Kitchener</li>
                </ol>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 m-t-20">
                <ol type="i" start="11">
                    <li>London</li>
                    <li>Victoria</li>
                    <li>Halifax</li>
                    <li>Oshawa</li>
                    <li>Windsor</li>
                </ol>
            </div>
        </div>
        <hr class="double">
    </div>
</section>
<section class="p-b-70">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-6 col-sm-6 col-6">
                <img alt="" src="{{ url('home_assets/images/logo.png') }}" width="152" height="30">
            </div>
            <!-- <div class="col-md-3 col-xs-6 col-sm-6 col-6">
                <ul class="no-style fs-12 no-padding xs-m-t-20">
                    <li class="inline no-padding"><a href="#" class="text-black fs-16 xs-no-padding"><i class="fa fa-facebook"></i></a></li>
                    <li class="inline no-padding"><a href="#" class="text-black p-l-30 fs-16 xs-no-padding"><i class="fa fa-twitter"></i></a></li>
                    <li class="inline no-padding"><a href="#" class="text-black p-l-30 fs-16 xs-no-padding"><i class="fa fa-dribbble"></i></a></li>
                    <li class="inline no-padding"><a href="#" class="text-black p-l-30 fs-16 xs-no-padding"><i class="fa fa-rss"></i></a></li>
                    <li class="inline no-padding"><a href="#" class="text-black p-l-30 fs-16 xs-no-padding"><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </div> -->
        </div>
        <div class="row m-t-30">
            <div class="col-md-3 col-sm-4 col-xs-6 col-12" align="left">
                <p class="fs-14">StartShredding Inc.</p>
                <p class="fs-14">327 Evans Avenue
                    <br> Toronto, Ontario
                    <br> Canada M8Z 1K2
                </p>
                <p class="fs-14">Phone: (416) 255 1500
                    <br> Toll Free: (866) 931 8615
                    <br> Fax: (866) 931 8615
                </p>
                <p class="fs-14"><a style="color: black;" href="mailto:info@shredex.ca">Contact Us by Email</a>
                </p>
            </div>
            <div class="col-md-6 col-sm-5 col-xs-12 col-12">
                    <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2888.598541254167!2d-79.5221020849952!3d43.61489986292543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b37d5f1663501%3A0xe085b53d61b4037a!2s327%20Evans%20Ave%2C%20Etobicoke%2C%20ON%20M8Z%201K2%2C%20Canada!5e0!3m2!1sen!2slk!4v1587997416979!5m2!1sen!2slk" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 col-12">
                <p><a class="link text-black fs-16 sm-p-r-30" href="#"> Privacy Policy
                    </a><br>
                    <a class="link text-black fs-16 sm-p-r-30" href="#">Terms &
                        Conditions</a><br>
                    <a class="link text-black fs-16 sm-p-r-30" href="#">Contact us</a>
                    <br>
                </p>
            </div>
        </div>
    </div>
</section>
@stop

@section('footer')
@include('home.includes.footer')
@stop