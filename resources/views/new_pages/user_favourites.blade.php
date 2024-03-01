@extends('new_includes.new_main')

@section('title','My Faves')



@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="content ">
    <div class="container-fluid p-b-50 m-t-40">
        <div class="card no-border card-condensed">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card no-border card-condensed">
                        <div class="invoice padding-20 sm-padding-10">
                            <div class="card-body p-t-20">
                                <form action="">
                                    <div class="row justify-content-left">
                                        <div class="col-md-5">
                                            <div class="form-group" style="display: inline-block">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="no-margin ube-card-title">My Favourite</div>
                                                        <p class="no-margin">Manage the List of items you see the most</p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                            <div id="alertBox"></div>
                            <div class="widget-11-2-table p-t-20">
                                <table class="table table-hover table-condensed table-striped table-responsive table-responsive"
                                    id="userFavouritesTable">
                                    <thead>
                                        <tr>
                                                <th >Item</th>

                                                <th style="width: 20%;" class="text-center">Rate</th>
                                                <th style="width: 20%;" class="text-center">QTY</th>
                                                <th style="width: 20%;" class="text-center" >Total</th>
                                                <th style="width: 20%;" class="text-center" >Cart</th>
                                                <th style="width: 20%;" class="text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ URL::asset('assets2/js/user_favourites.js') }}"></script>
<!-- END PAGE LEVEL JS -->
<script src="{{ URL::asset('assets/js/notify.js')}}"></script>
@endsection