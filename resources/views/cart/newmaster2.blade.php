<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="keywords" content="{{$code[0]->meta_keys}}">
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/images/{{$settings[0]->favicon}}" />
    <title>{{$settings[0]->title}} @yield('title')</title>

    <link href='https://fonts.googleapis.com/css?family=Poppins:300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mountains+of+Christmas:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Taviraj:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="{{ URL::asset('assets2/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets2/css/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/font/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('assets2/css/style.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets2/js/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('assets2/js/owl-carousel/owl.theme.css')}}">
    <link href="{{ URL::asset('assets2/css/bs-select.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="stylesheet" href="{{ URL::asset('assets2/css/newmaster2.css')}}">
<body id="bd" class="cms-index-index4 header-style4 prd-detail sns-products-detail1 cms-simen-home-page-v2 default cmspage">
    <div id="sns_wrapper">
        <!-- Menu -->
        <div id="sns_header" class="wrap">
            <!-- Header Top -->
            <div id="sns_menu" class="container-fluid" style="z-index:9999;">
                @include('includes.nav')
            </div>

            <div class="content-center fixed-header-margin">

                @yield('content')
                <script src="https://use.fontawesome.com/releases/v5.11.1/js/all.js" data-auto-replace-svg="nest">
                </script>
                <!-- starting of footer area -->
                <link rel="stylesheet" href="{{ URL::asset('assets2/css/newmaster2.css')}}">
                <!-- FOOTER -->
                <footer>
                    <div id="sns_footer" class="footer_style vesion2 wrap">

                        <div class="container-fluid">
                            <div id="footer_bottom">
                                <div id="sns_footer_bottom" class="footer" style='background-color:black;z-index:999;'>
                                    <div class="icon-container">
                                        @if(!Auth::guard('profile')->user())
                                        <a class="shcart" href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i></a>
                                        @else
                                        <a class="shcart" href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i></a>
                                        @endif
                                        {{-- <a class="shcart" href="{{ url('/cart') }}"><i class="fa fa-shopping-cart"></i></a> --}}
                                        <div class="accountloy">
                                            <div class="inner">
                                                <a href="{{route("user.product-favourite")}}"><i class="fas fa-heart"></i><br><span class="break"></span>Faves</a>
                                            </div>
                                            <div class="inner">
                                                <a href="{{route('user.myorders')}}"><i class="fas fa-file-invoice"></i><br><span class="break"></span>Orders</a>

                                            </div>
                                            <div class="inner hid">
                                                <a href="{{ url('/locations') }}"><i class="fas fa-map-marked-alt"></i><br><span class="break"></span>Drop Off</a>
                                            </div>
                                        </div>
                                        <div class="transhop">
                                            <!-- <div class="inner hid">
                                                <a href="{{ url('/request-pickup') }}"><i
                                                        class="fas fa-phone-square"></i><br><span
                                                        class="break"></span>Request Pickup</a>
                                            </div> -->
                                            <div class="inner">
                                                <a href="{{route("user-dashboard.index")}}"><i class="fas fa-user-cog"></i><br><span class="break"></span>Account</a>
                                            </div>
                                            <!-- <div class="inner">
                                                <a href="{{ url('/rewards') }}"><i class="fas fa-medal"></i><br><span
                                                        class="break"></span>Rewards</a>
                                            </div> -->
                                        </div>
                                        {{-- <div id="footer-cart">
                                            <span class="tongle"> --}}
                                        <?php
                                        // $price=0;
                                        // $items =0;
                                        // foreach($cart_result as $res){
                                        //     $price += $res->cost * $res->quantity;
                                        //     $items += $res->quantity;
                                        // }
                                        ?>

                                        {{-- &nbsp; {{$items}} ITEMS | <b>
                                            $ {{$price}} </b>
                                        </span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </footer>
            <!-- AND FOOTER -->

        </div>

        <script>
            var mainurl = '{{url(' / ')}}';
            var currency = '{{$settings[0]->currency_sign}}';
            var language = {!!json_encode($language) !!};
        </script>


        <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.zoom.js')}}"></script>
        <script src="{{ URL::asset('assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap-slider.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/wow.js')}}"></script>
        <script src="{{ URL::asset('assets/js/genius-slider.js')}}"></script>
        <script src="{{ URL::asset('assets/js/global.js')}}"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script> --}}
        <script src="{{ URL::asset('assets/js/main.js')}}"></script>
        <script src="{{ URL::asset('assets/js/plugins.js')}}"></script>
        <script src="{{ URL::asset('assets/js/notify.js')}}"></script>

        <script src="{{ URL::asset('assets2/js/less.min.js')}}"></script>
        <script src="{{ URL::asset('assets2/js/sns-extend.js')}}"></script>
        <script src="{{ URL::asset('assets2/js/custom.js')}}"></script>
        <script src="{{ URL::asset('assets2/js/bs-select.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
        @yield('footer')

            <script src="{{ URL::asset('assets2/js/newmaster2.js') }}"></script>

</body>

</html>