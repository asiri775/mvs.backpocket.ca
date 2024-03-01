@extends('home.includes.master')

@section('header')
@include('home.includes.header')
@stop

@section('content')
<section style="padding-top: 200px; padding-bottom: 200px">
    <div class="home-wrapper">
        <!-- Starting of login area -->
        <div class="jumbotron text-center">
            <h1 class="display-3">Thank you for ordering with us!</h1>
            <p class="lead"><strong>We will get back to you soon.</strong></p>
            <hr>
            <p class="lead" style="padding-bottom: 50px">
                <a class="btn btn-primary btn-sm" href="{{ url('/home') }}" role="button">Continue to homepage</a>
            </p>
        </div>
        <!-- Ending of login area -->
    </div>
</section>
@stop

@section('footer')
@include('home.includes.footer')
@stop