@extends('admin.includes.master-admin')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/admin/cutomers.css') }}">
    <script>
    var customerData = {!! json_encode($customer_array,true) !!};
    var coordinations = JSON.parse(customerData);
    var newCordinations = [];
    var map = [];

    function initMap(mapdata = coordinations) {
        let latitude = parseFloat(coordinations[0][1]);
        let longtude = parseFloat(coordinations[0][2]);
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: {lat: latitude, lng: longtude}
        });
        setMarkers(map, mapdata);
    }

    function setMarkers(map, mapDetails = coordinations) {
        var lookup = [];
        for (let i = 0; i < mapDetails.length; i++) {
            let item = mapDetails[i];

            let latitude = parseFloat(item[1]);
            let longtude = parseFloat(item[2]);
            let information = '<div><strong>Client: </strong>' + item[0] + '<div><br>'
                + '<div><strong>Address: </strong>' + item[3] + '<div><br>'
                + '<div><strong>Email: </strong><a href="mailto:' + item[4] + '">' + item[4] + '</a><div><br>'
                + '<div><strong>Phone: </strong><a href="tel:' + item[5] + '">' + item[5] + '</a><div><br>';
            let infoWindow = new google.maps.InfoWindow({
                content: information
            });

            let marker = new google.maps.Marker({
                position: {lat: latitude, lng: longtude},
                map: map,
                title: item[0],
            });

            marker.addListener('click', function () {
                if (!marker.open) {
                    infoWindow.open(map, marker);
                    marker.open = true;
                } else {
                    infoWindow.close();
                    marker.open = false;
                }
                google.maps.event.addListener(map, 'click', function () {
                    infoWindow.close();
                    marker.open = false;
                });
            });
        }
    }

    function getClientDetails() {

        var search = $('#search').val();
        newCordinations = [];
        for (let i = 0; i < coordinations.length; i++) {
            let item = coordinations[i];
            if (checkExists(item[0], search)) {
                newCordinations.push(item);
            } else if (checkExists(item[3], search)) {
                newCordinations.push(item);
            } else if (checkExists(item[4], search)) {
                newCordinations.push(item);
            } else if (checkExists(item[5], search)) {
                newCordinations.push(item);
            } else if (checkExists(item[6], search)) {
                newCordinations.push(item);
            } else {
                continue;
            }
        }

        initMap(newCordinations);
        let latitude = parseFloat(newCordinations[0][1]);
        let longtude = parseFloat(newCordinations[0][2]);
        map.setCenter({
            lat: latitude,
            lng: longtude
        });


    }

    var Timer;

    function Start() {

        $('#search').keyup(function () {

            clearTimeout(Timer);
            Timer = setTimeout(SendRequest, 1000);
        });
    }


    function SendRequest() {

        getClientDetails();
    }

    function checkExists(item, search) {
        if (item !== null && item !== "" && item !== 'undefined') {
            search = search.toLowerCase();
            item = item.toLowerCase();
            if (item.includes(search)) {
                return true;
            }
        }
        return false;
    }

</script>
<script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/admin/cutomers.css') }}">

<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row" id="main">
            <div class="go-title">
                <h3>Customers</h3>
                <div class="go-line"></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post" action="{{ url('/admin/customers/searchResults') }}" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12 customer_left_portion">
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
                                        <option value="1" {{ ($status==1) ? "selected" : "" }}>Active</option>
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
                            <div class="col-md-12 mt3" align="right">
                                <div>
                                    <span id="map_toggle_txt">Show Map</span>
                                    <label class="switch">
                                        <input type="checkbox" id="map_toggle">
                                        <span class="slider round"></span>
                                    </label>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="panel-body main-row">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-tab">
                    <div id="response">
                        @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('message') }}
                        </div>
                        @endif
                    </div>

                    <div class="row" id="mainTable">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered nowrap" cellspacing="0" id="cusTable" width="100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Customer ID</th>
                                        <th>Customer Name</th>
                                        <th width="10%">Customer Email</th>
                                        <th width="10%">City</th>
                                        <th>Phone</th>
                                        <th width="10%">Store</th>
                                        <th width="10%">Client Type</th>
                                        <th width="10%">Zone</th>
                                        <th>Status</th>
                                        <th width="20%">Actions</th>
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
                                        <td>{{$customer->phone}}</td>
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
                                        <td>
                                            @if($customer->status != 0)
                                            Active
                                            @else
                                            Banned
                                            @endif
                                        </td>

                                        <td>
<!--                                           --><?php
//                                            echo '<pre>';
//                                            print_r($customer['id']);
//                                            die();
//                                            ?>

                                            <form method="POST" action="{!! route('customers.destroy', $customer->id ) !!}">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <a href="{{ url('/admin/customers') }}/{{$customer->id}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> View
                                                    Details </a>

                                                <a href="{{ url('/admin/customers/email') }}/{{$customer->id}}" class="btn btn-primary btn-xs"><i class="fa fa-send"></i> Send
                                                    Email</a>

                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove </button>
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Select All &nbsp;
                                <input type="checkbox" name="chk_job_all" id="Select_all">
                            </label>
                            &nbsp;&nbsp;&nbsp;
                            <button type="button" name="btn_bulk_mail" id="btn_bulk_mail"
                                class="btn btn-primary footer-button" onclick="bulkMail()">Bulk Mail</button>
                        </div>
                    </div>
                <hr>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <small>Please, select customers from the above table to assign to a vendor</small>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="display: grid">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="store">Vendor:</label>
                                <select class="form-control chzn-select" id="vendor" name="vendor">
                                    <option value="0" selected disabled>Please Select</option>
                                    @if(!empty($vendors))
                                    @foreach($vendors as $ven)
                                    <option value="{{$ven->id}}">Store {{$ven->id}} | {{$ven->shop_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <button style="margin-top: 10%" type="button" onclick="assignCustomers()" class="btn btn-primary">Assign to Vendor</button>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <div class="col-md-6 col-lg-6 right-tab" style="display: none;">
				<div id="map"></div>
                        </div>
</div>

<script>
$('#map_toggle').change(function(){
  	var boxWidth = $(".main-row").width();
    if ($(window).width() > 992) {
        if ($('#map_toggle').is(':checked')) {
            $('#map_toggle_txt').text('Hide Map');
            $('.left-tab').animate({
                width: (boxWidth / 2) - 22
            });
            $('.right-tab').show(1000);
        } else {
            $('#map_toggle_txt').text('Show Map');
            $('.left-tab').animate({
                width: boxWidth - 48
            });
            $('.right-tab').hide();
        }
    }else{
        if ($('#map_toggle').is(':checked')) {
            $('#map_toggle_txt').text('Hide Map');
            $('.left-tab').hide()
            $('.right-tab').show();
        } else {
            $('#map_toggle_txt').text('Show Map');
            $('.left-tab').show();
            $('.right-tab').hide();
        }
    }
  });
    $(Start);
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
        $('#cusTable').DataTable({
            "pageLength": 50,
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "scrollX": true,
            "scrollY": "300px",
        });

        var table = $('#cusTable').DataTable();

        // #myInput is a <input type="text"> element
        $('#search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });

    function assignCustomers() {
        $vendor = $('#vendor').val();

        var values = new Array();
        $.each($("input[name='check[]']:checked"), function() {
            var data = $(this).parents('tr:eq(0)');
            values.push({
                'cus_id': $(data).find('td:eq(0)').text(),
                'name': $(data).find('td:eq(1)').text(),
                'phone': $(data).find('td:eq(4)').text()
            });
        });

        console.log(values);

        if (values.length == 0) {
            swal("Oops...", "Please, select customers to assign!", "error");
        } else if ($vendor == null) {
            swal("Oops...", "Please, select vendor!", "error");
        } else {
            $.ajax({
                type: "GET",
                url: '<?php echo url('/assignCustomersToVendor'); ?>',
                data: {
                    'vendorId': $vendor,
                    'selectedList': values
                },
                success: function(data) {
                    swal("Success", data, "success");
                    window.location.href = "{{URL::to('/admin/customers')}}"
                }
            });
        }
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxzp93xiNCnmkcqF983UmKvhAnOBbrcI0&callback=initMap">
</script>

@stop

@section('footer')

@stop
