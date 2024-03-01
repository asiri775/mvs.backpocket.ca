@extends('shop.includes.master')

@section('header')
@include('shop.includes.header')
@stop

@section('content')
<!-- BEGIN INTRO CONTENT -->
<section class="p-b-65 p-t-100 m-t-50">
    <div class="container">
        <div class="row">
            <div align="center" class="col-xs-12 col-sm-6 col-md-4 m-t-10 hover-push-pro">
                <div>
                    <!-- <img src="home_assets/images/fm1.jpg"> -->
                    <!-- <div style="width:300px;height:250px;border:1px solid #000;">
                    </div> -->
                    <img style="width:300px;height:250px" src="{{ URL::asset('shop_assets/images/placeholder-image.png') }}">

                    <h6 class="h3-text-blue m-t-30" align="center" style="font-family: 'Montserrat';font-weight: 600;color: #134c89;font-size: 15px;">
                        FACE MASK - 10 PACK
                    </h6>
                    <h5 class="font-montserrat no-margin" style="color: #134c89;"><b>$9.99</b></h5>
                    <div class="m-t-15" align="center">
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
                    <div class="m-t-15" align="center">
                        <button type="button" class="btn btn-default"><i class="fa fa-cart-plus"></i>&nbsp;ADD TO
                            CART</button> &nbsp;
                        <button type="button" class="btn btn-default"><i class="fa fa-heart"></i></button>
                    </div>
                </div>
            </div>
            <div align="center" class="col-xs-12 col-sm-6 col-md-4 m-t-10 bg-success hover-push-pro">
                <div>
                    <img style="width:300px;height:250px" src="{{ URL::asset('shop_assets/images/placeholder-image.png') }}">
                    <h6 class="h3-text-blue m-t-30" align="center" style="font-family: 'Montserrat';font-weight: 600;color: #134c89;font-size: 15px;">
                        FACE MASK - 30 PACK
                    </h6>
                    <h5 class="font-montserrat no-margin" style="color: #134c89;"><b>$17.99</b></h5>
                    <div class="m-t-15" align="center">
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
                    <div class="m-t-15" align="center">
                        <button type="button" class="btn btn-default"><i class="fa fa-cart-plus"></i>&nbsp;ADD TO
                            CART</button> &nbsp;
                        <button type="button" class="btn btn-default"><i class="fa fa-heart"></i></button>
                    </div>
                </div>
            </div>
            <div align="center" class="col-xs-12 col-sm-6 col-md-4 m-t-10 bg-success hover-push-pro">
                <div>
                    <img style="width:300px;height:250px" src="{{ URL::asset('shop_assets/images/placeholder-image.png') }}">
                    <h6 class="h3-text-blue m-t-30" align="center" style="font-family: 'Montserrat';font-weight: 600;color: #134c89;font-size: 15px;">
                        FACE MASK - 75 PACK
                    </h6>
                    <h5 class="font-montserrat no-margin" style="color: #134c89;"><b>$49.99</b></h5>
                    <div class="m-t-15" align="center">
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
                    <div class="m-t-15" align="center">
                        <button type="button" class="btn btn-default"><i class="fa fa-cart-plus"></i>&nbsp;ADD TO
                            CART</button> &nbsp;
                        <button type="button" class="btn btn-default"><i class="fa fa-heart"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-t-50">
            <div class="col-md-12" align="center">
                <a href="{{ url('/shop/3') }}" type="button" style="color: white;background: #134c89;" class="btn btn-default">BACK</a>&nbsp;&nbsp;
                <button type="button" style="color: white;background: #134c89;" class="btn btn-default">VIEW CART</button>&nbsp;&nbsp;
                <button type="button" style="color: white;background: #2fb207;" class="btn btn-default">CHECKOUT</button>
            </div>
        </div>
    </div>
</section>
<!-- END INTRO CONTENT -->

<section class="p-b-65 p-t-50 m-t-30 bg-master-dark" id="aboutUs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <h2 class="text-white fs-24">About Us</h2>
                <p class="text-white fs-13" style="font-family: 'Open Sans', Arial, sans-serif;">
                    We are a LICENSED Manufacturer and Distributor of Medical Face Masks, by Health Canada.
                    <br><br>
                    Based out of Toronto, our mandate is to provide our clients across Canada and the USA with
                    high quality personal protection equipment at the best value and in a timely manner.
                </p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <h2 class="text-white fs-24">OUR MISSION</h2>
                <p class="text-white fs-13" style="font-family: 'Open Sans', Arial, sans-serif;">
                    We are committed to building a national inventory of medical masks that can be fulfilled to meet
                    end-user demand at any given time.
                    <br><br>
                    Our distribution network will ensure medical and long-term care facilities have an ample supply
                    of personal protection equipment during a crisis event. We are in this together.
                </p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 p-t-100" align="center">
                <h4 class="text-white" style="font-family: 'Montserrat';text-transform: uppercase;"><b>We Stand on
                        Guard for Thee</b></h4>
            </div>
        </div>
    </div>
</section>
<section class="p-b-40 p-t-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-t-5 fs-24">Protectica: Canada’s Choice for Personal Protection Equipment (PPE)</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4" align="center">
                <img class="m-t-30 xs-image-responsive-height sm-no-padding" src="{{ URL::asset('shop_assets/images/dr1.JPG') }}" alt="">
                <br><br>
                <p class="fs-15" style="width: 300px;">
                    Each day, more and more Canadians choose Protectica Masks and
                    Sanitizers as a safeguard from air and water borne pollutants
                    and diseases.
                </p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <h6 class="block-title"><b>CANADIAN MADE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    Protectica is committed to supporting the public health and government repose to the
                    Coronoavirus. Masks and Sanitizers produced in Canada are manufactured under stricter and
                    controlled conditions, accelerating lead times, and resulting in peace of mind. Buying Canadian
                    also supports the local economy.
                </p>
                <h6 class="block-title m-t-50"><b>SUPERIOR QUALITY</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    Protectica masks are made from high quality materials, providing the sought-after combination of
                    comfort and protection. All of our medical masks meet X Standards and come in a wide variety of
                    styles to suit personal preferences and clinical requirements. Protectica masks are highly
                    breathable, comfortable, hypoallergenic and latex-free.
                </p>
                <h6 class="block-title m-t-50"><b>SATISFACTION GUARANTEED</b><i class="pg-arrow_right m-l-20"></i>
                </h6>
                <p class="m-t-15 fs-15">
                    We are commited to providing only the highest quality products. Each purchase comes
                    with a money back guarantee against defects.
                </p>
            </div>
        </div>
        <hr class="double">
    </div>

    <div class="container p-t-20">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-t-5 fs-24">Hand Sanitizers: Better Hygiene, Better Health</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <h6 class="block-title"><b>ANTIBACTERIAL DEFENSE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    Protectica Sanitizers are made with 75% Alcohol content, which is a proven defense against
                    bacteria and viruses. Regular application of a hand sanitizer helps prevent the spread of
                    contagious diseases.
                </p>
                <h6 class="block-title m-t-50"><b>BEST VALUE</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    Protectica manufactures and sells direct to consumers to save you money. With the increased
                    demand for hand sanitizer, and the growing importance of hand hygiene, buying direct is the
                    smart choice.
                </p>
                <h6 class="block-title m-t-50"><b>COMMUNITY SUPPORT</b><i class="pg-arrow_right m-l-20"></i></h6>
                <p class="m-t-15 fs-15">
                    For every bottle of hand sanitizer sold, we will donate one bottle to a local NPO or long-term
                    living facility.
                </p>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4" align="center">
                <img class="p-r-40 m-t-10 hidden-xs" src="{{ URL::asset('shop_assets/images/sanica_handsanitizer.png') }}" alt="">
                <img class="p-r-40 m-t-10 visible-xs" src="{{ URL::asset('shop_assets/images/sanica_handsanitizer_mobile.png') }}" alt="">
                <br>
                <p class="m-t-15 fs-15">
                    Regular use of Sanica hand sanitizer is an important part of good hand hygiene. Sanica hand
                    sanitizer removes dirt and germs without antibacterial ingredients or harsh preservatives.
                </p>
            </div>

            <!-- <div class="col-xs-12 col-sm-6 col-md-12 m-t-20" align="left">
                    <button type="button" class="btn btn-success"><b>HOW IT WORKS</b></button> &nbsp;&nbsp;
                    <button type="button" class="btn btn-green"><b>BOOK NOW</b></button>
                </div> -->
        </div>
        <hr class="double">
    </div>

    <div class="container p-t-20">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-t-5 fs-24">Masks and Hand Hygiene: An Essential Part of the New Normal</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 m-t-20">
                <p class="m-t-15 fs-15">
                    It is generally an accepted standard set by government health agencies that wearing masks, in
                    combination with proper hand hygiene that includes sanitizers, contribute to the defense against
                    infectious diseases. Protectica delivers the ideal combination of effective protection from
                    germs and safety for people and the environment. We develop well-being solutions for personal
                    protection–solutions that result in healthier people and a healthy environment at all times.
                </p>
            </div>

            <div class="m-t-15 col-xs-12 col-sm-6 col-md-4" align="center">
                <img class="p-r-40 m-t-10 xs-image-responsive-height sm-no-padding" src="{{ URL::asset('shop_assets/images/masks.JPG') }}" alt="">
            </div>
        </div>
        <br>

        <div class="row p-t-20">
            <div class="col-md-12">
                <h4 class="m-t-5">In The News: Face Masks and Hand Sanitizers</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <a href="https://www.bbc.com/future/article/20200504-coronavirus-what-is-the-best-kind-of-face-mask" target="_blank"><u>Why We should be wearing face masks: Face masks are a symbol of the pandemic
                        era – a visual
                        metaphor for the tiny, unseen viral foe that could be lurking around any corner. </u></a>
                <h6 class="block-title"><a href="https://www.bbc.com/future/article/20200504-coronavirus-what-is-the-best-kind-of-face-mask" target="_blank">READ MORE</a></h6>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <a href="https://www.healthing.ca/diseases-and-conditions/coronavirus/not-all-face-masks-are-created-equal-what-you-need-to-know-to-help-prevent-covid-19" target="_blank"><u>Canada’s chief public health officer, advised that non-medical masks help
                        prevent the spread
                        of COVID-19 by people who don’t know they have it.</u></a>
                <h6 class="block-title"><a href="https://www.healthing.ca/diseases-and-conditions/coronavirus/not-all-face-masks-are-created-equal-what-you-need-to-know-to-help-prevent-covid-19" target="_blank">READ MORE</a></h6>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                <a href="https://www.medicalnewstoday.com/articles/covid-19-hand-sanitizers-inactivate-novel-coronavirus-study-finds" target="_blank"><u>COVID-19: Hand sanitizers inactivate novel coronavirus, study finds</u></a>
                <h6 class="block-title"><a href="https://www.medicalnewstoday.com/articles/covid-19-hand-sanitizers-inactivate-novel-coronavirus-study-finds" target="_blank">READ MORE</a></h6>
            </div>
            <!-- <div class="col-xs-12 col-sm-6 col-md-3 m-t-20">
                    <a><u>It uses a dictionary of over 200 Latin words, combined with a handful of model sentence
                            structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is
                            therefore always free from repetition, injected humour, or non-characteristic words
                            etc.</u></a>
                    <h5><a><b>READ MORE</b></a></h5>
                </div> -->
        </div>
        <hr class="double">
    </div>
</section>
<!-- Off Site Shredding -->

<!-- BEGIN FOOTER -->
<section class="p-b-70">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-xs-6 col-sm-6 col-6">
                <img alt="" src="home_assets/images/logo.png" width="152" height="30">
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
                <p class="fs-14">327 Evans Avenue
                    <br> Toronto, Ontario
                    <br> Canada M8Z 1K2
                </p>
                <p class="fs-14">Phone: (613) 702 5030
                    <br> Toll Free: (866) 931 8615
                </p>
                <p class="fs-14"><a style="color: black;" href="mailto:info@protectica.ca"><u>Contact Us by
                            Email</u></a>
                </p>
            </div>
            <div class="col-md-6 col-sm-5 col-xs-12 col-12">
                <!-- <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d184551.80857903487!2d-79.51814365082902!3d43.7184038124084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4cb90d7c63ba5%3A0x323555502ab4c477!2sToronto%2C%20ON%2C%20Canada!5e0!3m2!1sen!2slk!4v1587192248189!5m2!1sen!2slk" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
                <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2888.598541254167!2d-79.5221020849952!3d43.61489986292543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b37d5f1663501%3A0xe085b53d61b4037a!2s327%20Evans%20Ave%2C%20Etobicoke%2C%20ON%20M8Z%201K2%2C%20Canada!5e0!3m2!1sen!2slk!4v1587997416979!5m2!1sen!2slk" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
            <!-- <div class="col-md-3 col-sm-3 col-xs-6 col-12">
                    <p>
                        <i class="fa fa-facebook"></i> &nbsp;&nbsp;&nbsp;
                        <i class="fa fa-twitter"></i> &nbsp;&nbsp;&nbsp;
                        <i class="fa fa-dribbble"></i> &nbsp;&nbsp;&nbsp;
                        <i class="fa fa-rss"></i> &nbsp;&nbsp;&nbsp;
                        <i class="fa fa-linkedin"></i> &nbsp;&nbsp;&nbsp;
                    </p>
                </div> -->
        </div>
    </div>
</section>
@stop

@section('footer')
@include('shop.includes.footer')
@stop