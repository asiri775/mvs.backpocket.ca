@extends('buy_credits.newmaster2')

@section('content')
 <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/static/packages.css') }}">
    <div class="home-wrapper">
        <div class="container">
            <div class="row" id="only-4k">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        @if ($email_confirm_message = Session::get('confirm_email_message'))
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{ $email_confirm_message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif


                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h1 class="size-matters "> SizesMatters.</h1>
                            <p class="subtitle">The Bigger The Package, The Bigger The Savings.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card-package">
                                <div class="card">
                                    <div class="package-title">
                                        Basic
                                    </div>
                                    <div class="package-credit">
                                        55 <span>Credits</span>
                                    </div>
                                    <div class="package-details">
                                        <p>Purchase $50 and <br>Receive 55 credits</p>
                                    </div>
                                </div>
                                <form action="{{ route('buy.credits') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="select" value="2">
                                    <div class="card-btn">
                                        <button type="submit" class="btn btn-block">
                                            Buy Now
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card-package diva">
                                <div class="card">
                                    <div class="package-title">
                                        Diva
                                    </div>
                                    <div class="package-credit">
                                        115 <span>Credits</span>
                                    </div>
                                    <div class="package-details">
                                        <p>Purchase $100 and <br>Receive 115 credits</p>
                                    </div>
                                </div>
                                <form action="{{ route('buy.credits') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="select" value="3">
                                    <div class="card-btn">
                                        <button type="submit" class="btn btn-block">
                                            Buy Now
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card-package fashionista">
                                <div class="card">
                                    <div class="package-title">
                                        Fashionista!
                                    </div>
                                    <div class="package-credit">
                                        275 <span>Credits</span>
                                    </div>
                                    <div class="package-details">
                                        <p>Purchase $200 and <br> Receive 275 credits</p>
                                    </div>
                                </div>
                                <form action="{{ route('buy.credits') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="select" value="4">
                                    <div class="card-btn reccomend">
                                        <button type="submit" class="btn btn-block">
                                            Buy Now
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-center bottom-title">
                            <p>Want to try our service? Purchase our worry free <a href="#!" class="trial_link">Trail
                                    Package
                                    for $25.00</a></p>
                        </div>
                        <form id="trial_form" action="{{ route('buy.credits') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="select" value="1">
                            <button style="display:none" type="submit" class="btn btn-block">SUBMIT</button>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <img src="{{ url('assets/img/paypal-logo.png') }}" alt="paypal"
                                 class="img-responsive text-center" style="width: 50px; margin: 0 auto;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @include('buy_credits.footer')
@stop