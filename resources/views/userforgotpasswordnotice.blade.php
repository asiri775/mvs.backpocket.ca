@extends('includes.newmaster2')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/userforgotpasswordnotice.css') }}">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">


<div class="home-wrapper">
    <div class="jumbotron text-center" style="margin-top: 10%">
        <!-- <h1 class="display-3">Thank you for signing up!</h1> -->
        <p class="lead"><strong>We have sent the temporary password to the email you provided.
          <br>It will give you a link that will enable you to create a New Password.</strong></p>
        <hr>
        <p class="lead">
          <a class="btn btn-primary btn-sm" href="{{ url('signin/user') }}" role="button">Back to Sign In</a>
        </p>
      </div>
</div>
@stop

@section('footer')



@stop