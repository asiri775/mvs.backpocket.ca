@extends('home.newmaster2')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/newhome.css') }}">

    <div class="home-wrapper-new">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4" id="column-change">
                @if(Auth::guard('profile')->guest())
                <div class="box pickup">
                    <img src="{{url('/assets/img/welcome-bg.jpg')}}" class="responsive" />

                    <div class="overlay"></div>
                    <div class="box-content" style="margin-top: 15%">
                        <div class="box-title">
                            <h4>Already a customer?</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-5">
                                    <a href="{{url('signin/user')}}" type="button" class="btn site-color btn-block">SIGN
                                        IN</a>
                                </div>
                                <div class="col-xs-1">
                                    <div class="or-text">or</div>
                                </div>
                                <div class="col-xs-5">
                                    <a href="{{url('user/registration')}}" type="button" class="btn btn-primary btn-block">SIGN UP</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @else

                <div class="box welcome">
                    <a href="{{url('user-dashboard')}}"><img src="{{url('/assets/img/tile_welcome.png')}}" class="responsive" /></a>
                    <div class="box-content">
                    </div>

                </div>
                @endif

            </div>
            <a href="{{ url('/user/gift-cards') }}">
                <div class="col-sm-4" id="column-change">
                    <div class="box drop-off">
                        <img src="{{url('/assets/img/tilead_GiftCards.png')}}" class="responsive" />

                    </div>
                </div>
            </a>
            <a href="{{ url('user/refer-friend') }}">
                <div class="col-sm-4" id="column-change">
                    <div class="box free-cleaning">
                        <img src="{{url('/assets/img/tilead_easy.png')}}" class="responsive" />

                    </div>
                </div>
            </a>
        </div>

        <div class="row">
            <div class="col-sm-8" id="column-expanded">
                <div class="row">
                    @foreach(\App\Category::where('mainid', 6)->where('role','sub')->get() as $childmenu)
                    <div class="col-sm-3">
                        <div class="category-item">
                            <a href="{{url('/category')}}/{{$childmenu->slug}}">
                                <div class="category-img">
                                    <img src="{{ url('/assets/images/categories/') . '/' . $childmenu->feature_image }}">
                                </div>
                                <div class="category-name">
                                    {{$childmenu->name}}
                                </div>

                            </a>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
            <div class="col-sm-4" id="column-change">
                <div class="box whyube">
                    <img src="{{url('/assets/img/tilead_whyube.png')}}" class="responsive" />
                    <div class="box-content">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places&callback=initMap" async defer></script>--}}

    @include('home.footer')
@stop