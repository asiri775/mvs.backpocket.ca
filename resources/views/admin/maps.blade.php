@extends('admin.includes.master-admin')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/admin/maps.css') }}">

    <script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc"async defer></script>
<script src="{{ URL::asset('assets/map/js/gmaps/gmaps.min.js')}}"></script>
<script src="{{ URL::asset('assets/map/js/gmaps/maps_google.js')}}"></script>


<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row" id="main">
            <div class="go-title">
                <h3>Maps</h3>
                <div class="go-line"></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="response">
                        @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('message') }}
                        </div>
                        @endif
                    </div>

                    <div class="col-md-12">
                        <ul class="nav nav-tabs tabs-left">
                            <li class="active"><a href="#customermap" data-toggle="tab" aria-expanded="false"><strong>Map of Customers</strong></a>
                            <li><a href="#vendormap" data-toggle="tab" aria-expanded="true"><strong>Map of Vendors</strong></a>
                            <li><a href="#ordermap" data-toggle="tab" aria-expanded="true"><strong>Map of Orders/Transactions</strong></a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xs-12" style="padding: 0">
                        <div class="tab-content">
                            <div class="tab-pane active" id="customermap">
                                <form method="post" action="{{ url('/admin/maps/customersearchResults') }}" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12 customer_left_portion">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input name="search" class="form-control" placeholder="Search" autocomplete="off" type="text" id="search">
                                                <span class="input-group-btn"><label class="btn btn-default search-icon"><i class="fa fa-search"></i></label></span>
                                            </div>
                                        </div>                            
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <!-- <label for="store">Store:</label> -->
                                                <select class="form-control chzn-select" name="store" id="store">
                                                    <option value="" selected>Store</option>
                                                    @if(!empty($vendors))
                                                    @foreach($vendors as $ven)
                                                    <option value="{{$ven->id}}" {{ ($ven->id==$store) ? "selected" : "" }} >{{$ven->shop_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <!-- <label for="client_type">Status:</label> -->
                                                <select class="form-control chzn-select" name="status" id="status">
                                                    <option value="" selected>Status</option>
                                                    <option value="1" {{ ($status==1) ? "selected" : "" }} >Active</option>
                                                    <option value="2" {{ ($status==2) ? "selected" : "" }}>Banned</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <!-- <label for="client_type">Client Type:</label> -->
                                                <select class="form-control chzn-select" name="client_type" id="client_type">
                                                    <option value="" selected>Client Type</option>
                                                    @if(!empty($client_types))
                                                    @foreach($client_types as $ctypes)
                                                    <option value="{{$ctypes->id}}" {{ ($ctypes->id==$clientType) ? "selected" : "" }} >{{$ctypes->type}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <!-- <label for="zone">Zone:</label> -->
                                                <select class="form-control chzn-select" name="zone" id="zone">
                                                    <option value="" selected>Zone</option>
                                                    @if(!empty($zones))
                                                    @foreach($zones as $zo)
                                                    <option value="{{$zo->id}}" {{ ($zo->id==$zone) ? "selected" : "" }} >{{$zo->zone_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" placeholder="City Search" class="form-control" id="city" name="city" @if(!empty($city)) value="{{$city}}" @else value="" @endif>
                                                <div id="citySearchBox" class="suggesstion-box"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-9" align="right">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>
                                                Search</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="go-title">
                                    <div>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="f_status"> Show Map </label>
                                        <div class="col-md-2 col-sm-3 col-xs-6">
                                            <input type="checkbox" data-toggle="toggle" data-on="Enabled" name="f_status" value="1" data-off="Disabled" checked>
                                        </div>
                                    </div>
                                    <h3>Map of Customers</h3>
                                    <div class="go-line"></div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="cusmapTable" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Customer ID</th>
                                                        <th>Customer Name</th>
                                                        <th width="10%">Customer Email</th>
                                                        <th width="10%">City</th>
                                                        <th width="10%">Store</th>
                                                        <th width="10%">Client Type</th>
                                                        <th width="10%">Zone</th> 
                                                        <th hidden>lat</th>
                                                        <th hidden>lng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($customers as $customer)
                                                    <tr>
                                                        <th><input type="checkbox" id="check" name="check[]"></th>
                                                        <td align="center">{{$customer->id}}</td>
                                                        <td>{{$customer->name}}</td>
                                                        <td>{{$customer->email}}</td>
                                                        <td>{{$customer->city}}</td>
                                                        <td>
                                                            @php
                                                            $shops = \App\VendorCustomers::where('customer_id', '=', $customer->id)
                                                            ->where('status', 1)
                                                            ->orderBy('vendor_id')
                                                            ->get(['vendor_id']);
                                                            $count = $shops->count();
                                                            @endphp
                                                            @if($count==1)
                                                            @foreach($shops as $sho)
                                                            <a style="text-decoration: none" href="{{ url('/admin/vendors/show/') }}/{{$sh->vendor_id}}">{{$sho->vendor_id}}</a>
                                                            @endforeach
                                                            @else
                                                            @foreach($shops as $sh)
                                                            <a style="text-decoration: none" href="{{ url('/admin/vendors/show/') }}/{{$sh->vendor_id}}">{{$sh->vendor_id}}</a>,
                                                            @endforeach
                                                            @endif
                                                        </td>
                                                        <td>{{$customer->type}}</td>
                                                        <td>{{$customer->zone_name}}</td>
                                                        <td hidden> @php $val = 43.6 - ($customer->id - 40) @endphp {{ $val }} </td>
                                                        <td hidden> @php $val = -79.1 - ($customer->id - 35) @endphp {{ $val }} </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-6">
                                            <div id="js-map-customer" style="height: 500px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="vendormap">
                                <div class="go-title">
                                    <div class="pull-right">
                                        <a href="{!! url('#') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Main Category</a>
                                    </div>
                                    <h3>Map of Vendors</h3>
                                    <div class="go-line"></div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name (job title)</th>
                                                        <th>Age</th>
                                                        <th>NickName</th>
                                                        <th>Employee</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($customers as $customer)
                                                    <tr>
                                                        <td>{{$customer->name}}</td>
                                                        <td></td>
                                                        <td>{{$customer->zone_name}}</td>
                                                        <td>{{$customer->type}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="ordermap">
                                <div class="go-title">
                                    <div class="pull-right">
                                        <a href="{!! url('#') !!}" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add Main Category</a>
                                    </div>
                                    <h3>Map of Orders/Transactions</h3>
                                    <div class="go-line"></div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <table class="table table-striped table-bordered" cellspacing="0" id="example" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name (job title)</th>
                                                        <th>Age</th>
                                                        <th>NickName</th>
                                                        <th>Employee</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($customers as $customer)
                                                    <tr>
                                                        <td>{{$customer->name}}</td>
                                                        <td></td>
                                                        <td>{{$customer->zone_name}}</td>
                                                        <td>{{$customer->type}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <hr>
               
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $(".chzn-select").chosen();
    });

    // AJAX call for Customer autocomplete 
    $(document).ready(function() {
        $("#city").keyup(function() {
            $.ajax({
                type: "GET",
                url: '<?php echo url('/searchAjaxCities'); ?>',
                data: {
                    'keyword': $('#city').val()
                },
                success: function(data) {
                    $("#citySearchBox").show();
                    $("#citySearchBox").html(data);
                }
            });
        });
    });

    function selectCity($val) {
        $("#city").val($val);
        $("#citySearchBox").hide();
    }

    $(document).ready(function() {
        $('#cusmapTable').DataTable({
            "pageLength": 25,
            "lengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
            "scrollX": true,
            "scrollY": "300px",
        });

        var table = $('#cusmapTable').DataTable();

        // #myInput is a <input type="text"> element
        $('#search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });

</script>


@stop

@section('footer')

@stop