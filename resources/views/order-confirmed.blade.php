@extends('includes.newmaster2')
@section('content')
<!-- ,['cart_result'=> $response] -->
<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/order-confirmed.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="home-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <div class="thank-you-text">
                    <img src="{{ url('/assets/img/thankyou.png') }}" />
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">
                <hr class="oc-hr">
                <div class="order-confirmed">
                    Order COnfirmed
                </div>

                <div class="steps">
                    <ol>
                        <li class="stepsli current"> On Request</li>
                        <li class="stepsli ">Sheduled</li>
                        <li class="stepsli">At Plant</li>
                        <li class="stepsli">On delivery</li>
                        <li class="stepsli">Completed</li>
                    </ol>
                </div>

                <div class="order-note">
                    <p>Your Order has been placed in our service queue and you will recive a notification from out
                        dispatch shortly. We will let you know when we have scheduled the pick up of your garments.</p>
                    <p>To view the status of your order, click on the button below or save the tracking number for
                        future inquiry</p>
                </div>
                <div class="order-tracking">
                    <span class="title">Order tracking number</span>
                    <div class="trackingnumber">
                        #{{ session()->get( 'order1' )->order_number }}
                        {{-- {{$order->order_number}} --}}
                    </div>
                    <a href="{{route('user.myorders')}}">Click to view status</a>
                </div>

            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-content">
                        <div class="next-order-area">
                            <div>Get Your Next Order for <span><img src="{{ url('/assets/img/free.png') }}" /></span>
                            </div>
                        </div>
                        <div class="text-center">
                            <p>We've made the process of earning credits towards free cleaning so much easier. Here's
                                just some of the rewards waiting for you.</p>
                        </div>

                        <div class="creditlist">
                            <ul>
                                <li>
                                    <div class="credit-name">Tell a friend about us</div>
                                    <div class="credit-count">20 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Instagram post or story</div>
                                    <div class="credit-count">10 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Instagram or fb mention</div>
                                    <div class="credit-count">5 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Wear our shirt courtside</div>
                                    <div class="credit-count">500 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Tattoo our logo on you</div>
                                    <div class="credit-count">750 credits</div>
                                </li>
                                <li>
                                    <div class="credit-name">Name your kid ube</div>
                                    <div class="credit-count">1000 credits</div>
                                </li>
                            </ul>
                        </div>



                    </div>
                </div>
                <div class="termsandcon">
                    <p>Terms and Conditions apply. void where prohibited. Contact us form details.</p>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@stop

@section('footer')
@stop