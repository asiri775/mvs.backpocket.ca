<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Protectica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="description"
        content="About Face Masks, and Surgical Masks, Surgical Masks, Face Masks, Reusable Massk, Cloth Masks, Medical Masks, Canadian Made Masks, Household Masks, Corporate Masks, Promotional Items, Health Canada, CDC, Masks, Hand Hygiene, Hand Sanitizers, Sanitizers, Aloe Vera, Isopropyl, Alcohol, Hand Wash, Covid19, Uniform Masks">
    <meta content="" name="author" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('shop_assets/images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('shop_assets/images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('shop_assets/images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('shop_assets/images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('shop_assets/images/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('shop_assets/images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('shop_assets/images/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('shop_assets/images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('shop_assets/images/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('shop_assets/images/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('shop_assets/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('shop_assets/images/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('shop_assets/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL::asset('shop_assets/images/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- BEGIN PLUGINS -->
    <link href="{{ URL::asset('shop_assets/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('shop_assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('shop_assets/plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('shop_assets/plugins/swiper/css/swiper.css')}}" rel="stylesheet" type="text/css" media="screen" />
    <!-- END PLUGINS -->
    <!-- BEGIN PAGES CSS -->
    <link class="main-stylesheet" href="{{ URL::asset('shop_assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="{{ URL::asset('shop_assets/css/pages-icons.css')}}" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGES CSS -->

    <script src="https://code.jquery.com/jquery-1.12.1.min.js" name="jquery"></script>
</head>

<body class="pace-dark">
    @yield('header')
    @yield('content')
    @yield('footer')

    <!-- BEGIN CORE FRAMEWORK -->
    <script src="{{ URL::asset('shop_assets/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('shop_assets/js/pages.image.loader.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('shop_assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- BEGIN SWIPER DEPENDENCIES -->
    <script type="text/javascript" src="{{ URL::asset('shop_assets/plugins/swiper/js/swiper.jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('shop_assets/plugins/velocity/velocity.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('shop_assets/plugins/velocity/velocity.ui.js')}}"></script>
    <!-- BEGIN RETINA IMAGE LOADER -->
    <script type="text/javascript" src="{{ URL::asset('shop_assets/plugins/jquery-unveil/jquery.unveil.min.js')}}"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN PAGES FRONTEND LIB -->
    <script type="text/javascript" src="{{ URL::asset('shop_assets/js/pages.frontend.js')}}"></script>
    <!-- END PAGES LIB -->
    <!-- BEGIN YOUR CUSTOM JS -->
    <script type="text/javascript" src="{{ URL::asset('shop_assets/js/custom.js')}}"></script>
    <!-- END PAGES LIB -->
</body>

</html>