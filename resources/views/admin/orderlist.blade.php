@extends('admin.includes.master-admin')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/admin/orderlist.css') }}">

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
        setMarkers(map,mapdata);
    }

    function setMarkers(map,mapDetails = coordinations) {
		var lookup = [];
        for (let i = 0; i < mapDetails.length; i++) {
            let item = mapDetails[i];

            let latitude = parseFloat(item[1]);
            let longtude = parseFloat(item[2]);
			let information = '';
			let orderid = item[6];
			let existingMarker = getExistingMarker(lookup, [latitude, longtude]);
			if ((existingMarker == 0 || existingMarker != null)) {
				if (lookup[existingMarker][3] != orderid) {
            information = lookup[existingMarker][2] + '<hr><div><strong>Referance ID: </strong>' + item[6] + '<div><br>'
                +'<div><strong>Client: </strong>' + item[0] + '<div><br>'
                + '<div><strong>Address: </strong>' + item[3] + '<div><br>'
                + '<div><strong>Email: </strong><a href="mailto:' + item[4] + '">' + item[4] + '</a><div><br>'
                + '<div><strong>Phone: </strong><a href="tel:' + item[5] + '">' + item[5] + '</a><div><br>';
					lookup[existingMarker][2] = information;
} else {
					continue;
				}
			} else {
 information = '<div><strong>Referance ID: </strong>' + item[6] + '<div><br>'
                +'<div><strong>Client: </strong>' + item[0] + '<div><br>'
                + '<div><strong>Address: </strong>' + item[3] + '<div><br>'
                + '<div><strong>Email: </strong><a href="mailto:' + item[4] + '">' + item[4] + '</a><div><br>'
                + '<div><strong>Phone: </strong><a href="tel:' + item[5] + '">' + item[5] + '</a><div><br>';
				lookup[i] = [latitude, longtude, information, orderid];
			}
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

	function getExistingMarker(lookup, search) {
		if (lookup.length > 0) {
			for (let i = 0, l = lookup.length; i < l; i++) {
				if (lookup[i] && lookup[i].length > 0) {
					if (lookup[i][0] === search[0] && lookup[i][1] === search[1]) {
						return i;
					}
				}

			}
			return null;
		}
		return null;
	}

	function getClientDetails() {

        var search = $('input[type=search]').val();
        newCordinations = [];
        for (let i = 0; i < coordinations.length; i++) {
                let item = coordinations[i];

                if(checkExists(item[0],search)){
                    newCordinations.push(item);
                }else if(checkExists(item[4],search)){
                    newCordinations.push(item);
                }else if(checkExists(item[6],search)){
                    newCordinations.push(item);
                }else if(checkExists(item[7],search)){
                    newCordinations.push(item);
                }else if(checkExists(item[8],search)){
                    newCordinations.push(item);
                }else if(checkExists(item[9],search)){
                    newCordinations.push(item);
                }else{
                    continue;
                }
            }

        initMap(newCordinations);
        console.log(newCordinations);
		let latitude = parseFloat(newCordinations[0][1]);
		let longtude = parseFloat(newCordinations[0][2]);
		map.setCenter({
			lat: latitude,
			lng: longtude
		});
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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/admin/orderlist.css') }}">

    <script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row" id="main">
            <div class="go-title">
                <div class="pull-right">
                    <span><span style="background-color: lightgreen;">&nbsp;&nbsp;&nbsp;&nbsp;</span> Completed</span>
                    <span><span style="background-color: #d9edf7;">&nbsp;&nbsp;&nbsp;&nbsp;</span> Processing</span>
                </div>
                <h3>Orders</h3>
                <div class="go-line"></div>
            </div>
            <div class="panel panel-default">
				<div class="panel-body">
                    <form method="post" action="{{ url('/admin/orders/searchResults') }}" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12 customer_left_portion">
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
                                        @if(!empty($order_status_array))
                                            @for($i=0; $i<count($order_status_array); $i++)
                                                <option value="{{ $order_status_array[$i] }}" {{ ($order_status_array[$i] == $status) ? 'selected' : '' }}>{{ $order_status_array[$i] }}</option>
                                            @endfor
                                        @endif
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
                    <table class="table table-striped table-bordered nowrap" cellspacing="0" id="ordersTable" width="100%">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Reference ID</th>
                                <th>Customer Email</th>
                                <th>Customer Name</th>
                                <th>City</th>
                                <th>Total Product</th>
                                <th>Total Cost</th>
                                <th>Payment Method</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)

                            @if($order->status == "completed")
                            <tr style="background-color: lightgreen;">
                                @elseif($order->status == "processing")
                            <tr class="info">
                                @else
                            <tr class="">
                                @endif
                                <td><input type="checkbox" name="chk_order[]" id="chk_job_{{ $order->id }}"
                                        value="{{ $order->id }}" email_address="{{$order->customer_email}}"
                                        class="chkbx-client"></td>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->customer_email}}</td>
                                <td>{{$order->customer_name}}</td>
				                <td>{{$order->customer_city}}</td>
                                <td>{{array_sum($order->quantities)}}</td>
                                <td>{{$settings[0]->currency_sign}}{!! $order->pay_amount !!}</td>
                                <td>{{$order->method}}</td>

                                <td>

                                    <a href="orders/{{$order->id}}" class="btn btn-primary btn-xs"><i
                                            class="fa fa-check"></i> View Details </a>

                                    <a href="orders/email/{{$order->id}}" class="btn btn-primary btn-xs"><i
                                            class="fa fa-send"></i> Send Email</a>
                                    <a href="#" class="btn btn-primary btn-xs" readonly>{{ucfirst($order->status)}}</a>
<!--
                                    ​<span class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle btn-xs" type="button"
                                            data-toggle="dropdown">{{ucfirst($order->status)}}
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="orders/status/{{$order->id}}/scheduled">Scheduled</a></li>
                                            <li><a href="orders/status/{{$order->id}}/in transit">In Transit</a></li>
                                            <li><a href="orders/status/{{$order->id}}/at plant">At Plant</a></li>
                                            <li><a href="orders/status/{{$order->id}}/on delivery">On Delivery</a></li>
                                            <li><a href="orders/status/{{$order->id}}/at plant completed">At Plant
                                                    Completed</a></li>
                                            <li><a href="orders/status/{{$order->id}}/completed">Completed</a></li>
                                            <li><a href="orders/status/{{$order->id}}/completed at store">Completed At
                                                    Store</a></li>
                                        </ul>
                                    </span> -->

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
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

                    <div class="modal fade" id="bulk-mail-popup-content" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Send Mail</h4>
                                </div>
                                <div class="modal-body">
                                    <form id="mail_form" method="post" action="{{ url('admin/orders/bulkMailSend') }}">
                                        <div class="col-md-12">
                                            {{ csrf_field() }}
                                            <div class="row form-group">
                                                <div class="col-md-3">
                                                    <label>Template :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select class="form-control email_twmplate" name="template"
                                                        id="template" required>
                                                        <option value="" selected disabled>Select status</option>
                                                        @foreach($order_status_mails as $status)
                                                        <option value="{{$status['status']}}"
                                                            content="{{$status['email_body']}}"
                                                            subject="{{$status['email_subject']}}">{{$status['status']}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-3">
                                                    <label>Address :</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select id="email-multi-select" name="email_multi_select[]"
                                                        class="form-control" multiple size="4" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class=" control-label">Subject:</label>
                                                <input class="form-control" name="email_subject" id="email_subject"
                                                    placeholder="Enter Subject" value="" required>
                                            </div>
                                            <div class="row form-group">
                                                <label class=" control-label">Text:</label>
                                                <textarea class="form-control" rows="5" name="email_body"
                                                    id="email_body" placeholder="mail body" rows="10"
                                                    required></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="submit" form="mail_form" value="Send mail" id="send_mail"
                                            name="btn_send_mail" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-lg-6 right-tab" style="display: none;">
				<div id="map"></div>
			    </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('footer')
<script type="text/javascript">
    function bulkMail() {

            checkboxes = document.getElementsByName('chk_order[]');
            var order_ids = "";
            $('#email-multi-select')
                .find('option')
                .remove()
                .end();
            for (var i in checkboxes) {
                if (checkboxes[i].checked) {
                    order_ids += checkboxes[i].value + ",";
                    //  $("#email-multi-select").append(new Option("demo_text", checkboxes[i].value));
                    var o = new Option($(checkboxes[i]).attr('email_address'), checkboxes[i].value);
                    $(o).html($(checkboxes[i]).attr('email_address'));
                    $("#email-multi-select").append(o);
                    //alert(checkboxes[i].value + '||'+checkboxes[i].checked);
                }
            }
            $('#email-multi-select option').prop('selected', true);
            if (order_ids === "") {
                alert("Please select at least one record from list.");
                return false;
            }

            $('#hf_job_ids_mail').val(order_ids);
            $('#bulk-mail-popup-content').modal('show');
        }

        $(document).ready(function() {
            $("#Select_all").on("click", function () {
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
            });

            CKEDITOR.replace('email_body',{
                allowedContent: true
            });

            $("select.email_twmplate").change(function() {
                var mailContent = $(this).children("option:selected").attr('content');
                var mailSubject = $(this).children("option:selected").attr('subject');
                document.getElementById("email_subject").value = mailSubject;
                CKEDITOR.instances.email_body.setData(mailContent);
            });
        });

        $(document).ready(function() {
            $('#send_mail').click(function() {
                if($('#email_subject').val() != "" &&  $('#email-multi-select').val() != null)
                {
                    $('#bulk-mail-popup-content').modal('toggle');
                    $("#btn_bulk_mail").attr("disabled", true);
                }
            });
        });

</script>
<script src="{!! asset('new_assets/assets/plugins/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! asset('new_assets/assets/plugins/ckeditor/jquery-ckeditor.js') !!}"></script>
<script>
    var Timer;
    $('#search').on('keyup', function() {
            clearTimeout(Timer);
            Timer = setTimeout(SendRequest, 1000);
        });

    function SendRequest() {

        getClientDetails();
    }
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
</script>
<script>
    $(function() {
        $(".chzn-select").chosen();
    });

    function selectCity($val) {
        $("#city").val($val);
        $("#citySearchBox").hide();
    }

    $(document).ready(function() {
        $('#ordersTable').DataTable({
            "pageLength": 50,
            "lengthMenu": [
                [50, 100, 200, -1],
                [50, 100, 200, "All"]
            ],
            "scrollX": true,
            "scrollY": "300px",
        });

        var table = $('#ordersTable').DataTable();

        // #myInput is a <input type="text"> element
        $('#search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });

    // AJAX call for Customer autocomplete
    $(document).ready(function() {
        $("#city").keyup(function() {
            $.ajax({
                type: "GET",
                url: '<?php echo url('/getAjCities'); ?>',
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
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxzp93xiNCnmkcqF983UmKvhAnOBbrcI0&callback=initMap">
</script>
@stop