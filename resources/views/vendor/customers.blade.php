
<script src="{{ URL::asset('assets2/js/customers.js') }}"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/vendor/customers.css') }}">
@extends('vendor.includes.master-vendor')

@section('content')


<div class="page-title row">
	<h2>Customers</h2>
	<div class="toggle-button-main">
	<span id="map_toggle_txt" style="display: flex;">Show Map</span>
	<label class="switch">
		<input type="checkbox" id="map_toggle">
		<span class="slider round"></span>
	</label>
	</div>
</div>

@if(Session::has('message'))
<div class="alert alert-success alert-dismissable">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	{{ Session::get('message') }}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger alert-dismissable">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	{{ Session::get('error') }}
</div>
@endif

<div class="row main-row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
		<div class="bg-white row">
			<div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 left-tab">
				<div class="table-responsive">
					<table data-text="customers" id="example" cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Address</th>
								<th>City</th>
								<th>Postal Code</th>
								<th>Phone </th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($customers != null) {
								foreach ($customers as $customer) { ?>

									<tr>
										<td><a href="{{ url('/vendor/customer/') }}/{{ $customer->id }}">{{ $customer->name }}</a></td>
										<td><?php
											if ($customer->address != "") {
												echo $customer->address;
											}
											?></td>
										<td><?php
											if ($customer->city != "") {
												echo $customer->city;
											}
											?></td>
										<td><?php
											if ($customer->zip != "") {
												echo $customer->zip;
											}
											?></td>
										<td><?php
											if ($customer->phone != "") {
												echo $customer->phone;
											}
											?></td>
										<td><?php
											if ($customer->email != "") {
												echo $customer->email;
											}
											?></td>
										<!-- <td align="center"><a href="javascript:;" class="simple-link sendMail markMeFirst"><i class="fa fa-envelope-o"></i></a></td> -->
									</tr>


								<?php
								}
							} else {
								?>
								<tr>
									<td colspan="8">No Data Found</td>
								</tr>
							<?php
							}
							?>


						</tbody>
					</table>
				</div>
				<div class="table-btn text-right">
					<!-- <div class="left-select-all checkBoxActionParents">
						<div class="checkbox-new">
							<input class="float-left selectAllCheckbox" id="rememberSelectAll" name="remember" type="checkbox">
							<label for="rememberSelectAll" class="float-left font_size_14">Select All</label>
						</div>
						<div class="checkbox-new">
							<input class="float-left clearAllCheckbox" id="rememberClear" name="remember" type="checkbox">
							<label for="rememberClear" class="float-left font_size_14 ">Clear Selection</label>
						</div>
					</div> -->
					<!-- <ul class="table-foot-btn excel-btn">
						<li><a href="javascript:;" class="pdfExport"><i class="fa fa-file-pdf-o"></i><span>Download</span></a></li>
						<li><a href="javascript:;" class="excelExport"><i class="fa fa-file-excel-o"></i><span>Export</span></a></li>
						<li><a href="javascript:;" class="printExport"><i class="fa fa-print"></i><span>Print</span></a></li>
						<li><button type="submit" class="bulkEmailTrigger bigBtnhref sendMail"><i class="fa fa-envelope"></i><span>Bulk Email</span></button></li>
					</ul> -->
				</div>
			</div>
			<div class="col-md-6 col-lg-6 right-tab" style="display: none;">
				<div id="map"></div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Email</h4>
			</div>
			<form action="{!! action('VendorController@customers') !!}" method="post">
				{{csrf_field()}}
				<div class="modal-body">
					<div class="form-group">
						<input placeholder="Subject" class="form-control" type="subject" name="subject" required="" />
					</div>
					<div class="form-group">
						<textarea placeholder="Message" class="form-control" name="message" required="" /></textarea>
					</div>
					<input type="hidden" class="customerId" name="customerId">
					<input type="hidden" name="task" value="email">
				</div>
				<div class="modal-footer">
					<button type="submit" name="save" class="btn btn-primary">Send Mail</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script>
	$(document).on("click", ".markMeFirst", function() {
		$(this).closest("tr").find("input").prop("checked", true);
	});
	$(document).on('click', '.sendMail', function() {
		var ids = [];
		$(".ids:checked").each(function() {
			ids.push($(this).val());
		});
		if (ids.length > 0) {
			$('.customerId').val(ids);
			$('#modal').modal('show');
		}
	});


	$(document).ready(function() {
		$('#example').DataTable({
			dom: 'Bfrtip',
			select: true,
			ordering: true,
			buttons: [{
					extend: 'excel',
					text: '<i style="color:green" class="fa fa-file-excel-o fa-2x"></i>&nbsp; Excel',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: 'List of Customers',
				},
				{
					extend: 'csv',
					text: '<i style="color:blue" class="fa fa-file-text-o fa-2x"></i>&nbsp; CSV',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: 'List of Customers',
				},
				{
					extend: 'pdf',
					text: '<i style="color:red" class="fa fa-file-pdf-o fa-2x"></i>&nbsp; PDF',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: 'List of Customers',
				},
				{
					extend: 'print',
					text: '<i style="color:black" class="fa fa-print fa-2x"></i>&nbsp; Print',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, 5]
					},
					title: 'List of Customers',
				}
			]
		});
	});

    var Timer;
    $('#example').on('search.dt', function () {
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
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxzp93xiNCnmkcqF983UmKvhAnOBbrcI0&callback=initMap">
</script>

@stop

@section('footer')

@stop