@extends('new_includes.new_main')

@section('title','Refer a Friend')



@section('content')
    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<div class="content ">

    <div class="container-fluid p-b-50 m-t-40">
        <div>
            @if ($message = Session::get('message_success'))
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ $message }}</strong>
            </div>
            @elseif($message = Session::get('message_fail'))
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>{{ $message }}</strong>
            </div>
            @endif
                            @forelse(Auth::guard('profile')->user()->getReferrals() as $referral)
                            <div class="col-lg-12">
                                <div class="row"> -->
                                        <form id="{{$referral->code}}" class="form-control"
                                            action="{{url('user/send-refer-mail')}}" method="POST">
                                            <div class="form-group form-group-default ">
                                                <label>Email Address{{ csrf_field() }}</label>
                                                <input type="hidden" class="form-control" form="{{$referral->code}}"
                                                    name="code" id="code" value="{{$referral->code}}">
                                                <input type="email" class="form-control" form="{{$referral->code}}"
                                                    placeholder="Enter Email Address" name="email_add" id="email_add"
                                                    required>
                                                &nbsp;

                                            </div>
                                            <input type="submit" class="btn btn-primary btn-block"
                                                form="{{$referral->code}}" name="Send" Value="Send Mail">


                                        </form>
                                    </div>
                            @empty
                            No referrals
                            @endforelse
                        </div>
                    </div>
                </div> -->
            @php
            $value = 0;
            if($referral->program->name == 'Sign-up Bonus'){
            $value = $referral->program->amount;
            }
            @endphp
            <div class="row">
                <div class="col-sm-12 col-md-8" id="refer-column">
                    <div class="refer-img"></div>
                </div>
                <div class="col-md-4" id="refer-column" style="background-color: #f0f0f0; padding: 40px">
                    <div>
                        <div>
                            <div class="m-b-20 font-color">
                                <p> What's better than getting free stuff?
                                    Letting your friends in on the secret
                                    and sharing the wealth!</p>

                                <p>As a token of our appreciation for your
                                    support, we would like to give you a
                                    chance to earn as much free
                                    drycleaning and laundry credits as
                                    possible.
                                </p>
                                <p>Simply tell a friend about us, and
                                    ask them to sign up with your code.
                                    When they do, they will receive
                                    ${{ $value }} in Credits and so will you!
                                </p>
                                <p>That Was Easy!</p>
                            </div>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
            @forelse(Auth::guard('profile')->user()->getReferrals() as $referral)
            <div class="row">
                <div class="col-sm-4 col-md-3" >

                    <div class="code-title">
                        Your Unique Code
                    </div>
                    <div class="code-text-send">
                        {{$referral->code}}
                    </div>
                    <div class="text-center">
                        Referred Users: {{ $referral->relationships()->count() }}
                    </div>

                </div>
                <div class="col-sm-4 col-md-4">
                    <p class="msg-of-friend">This is your very own unique code that you can either send by email or text
                        to your friends, so that they can sign up and you both receive bonus credits</p>
                </div>
                <div class="col-sm-4 col-md-4"></div>
            </div>
            <div class="row">
                <form class="form-inline" action="{{url('user/send-refer-mail')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-sm-12 col-12 setwidthform">
                        <div class="codenandinvi-title">Send invitation and code</div>

                        <div class="form-group" id="send-email-id">
                            <label for="email" class="sr-only">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email" style="width: 60%;"
                                placeholder="EMAIL ADDRESS" required>
                        </div>
                        <input type="hidden" class="form-control" name="link" id="code"
                            value="{{$referral->link}}">

                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-invite" id="invite-btn">SEnd invite code</button>
                        <button type="reset" class="btn btn-cancel">Cancel</button>

                    </div>
                </form>
            </div>
            @empty
            No referral Programs at the moment
            @endforelse
        </div>
@endsection
@section('scripts')
@endsection