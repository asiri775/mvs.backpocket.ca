@extends('vendor.includes.master-vendor')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/vendor/orderlist.css') }}">
<script src="{{ URL::asset('assets2/js/orderlist.js') }}"></script>
<div class="page-title row">
	<h2>Order History</h2>
	<div style="float: right;">
	<span id="map_toggle_txt">Show Map</span>
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
<div class="page-title row">
	<form action="" method="get">
		<div class="form-group">
			<div class="form-inline">
				<label>Order#</label>
				<input type="text" class="form-control" name="orderId">
				<select class="form-control" name="time">
					<option value="">Quick Date</option>
					<option value="all">All Time</option>
					<option value="today">Today</option>
					<option value="week">This Week</option>
					<option value="month">This Month</option>
					<option value="year">Year to Date</option>
					<option value="lastYear">Last Year</option>
				</select>
				<div class="custom-dateicker">
					<label>From</label>
					<div id="datepicker2" class="input-group date custom-calendar" data-date-format="mm-dd-yyyy">
						<input class="form-control datepicker" name="fromTime" type="text" />
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				<div class="custom-dateicker">
					<label>To</label>
					<div id="datepicker3" class="input-group date custom-calendar" data-date-format="mm-dd-yyyy">
						<input class="form-control datepicker" name="toTime" type="text" />
						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				<select class="form-control" name="process">
					<option value="">Status</option>
					<option value="1">Pending</option>
					<option value="2">In Transit</option>
					<option value="3">Plant Receive</option>
					<option value="4">Plant Complete</option>
					<option value="5">On Delivery</option>
					<option value="6">Delivery Completed</option>
					<option value="7">Delivery in Store</option>
				</select>
			</div>
		</div>
		<div class="form-group">

			<div class="form-inline">
				<div class="pull-left">
					<label>Client Name</label>
					<input type="text" class="form-control width_40" name="clientName">
					<select class="form-control" name="paidStatus">
						<option value="">Payment Status</option>
						<option value="2">Paid</option>
						<option value="pending">Not Paid</option>
					</select>
				</div>
				<!--<select class="form-control width_20">
				<option>Cash</option>
				<option>Credit Card</option>
				<option>BP Credits</option>
				<option>Debit</option>
				<option>Cheque</option>
			</select>-->
				<div class="comments-form pull-left">
					<input type="submit" name="orderForm" class="btn btn-success " style="margin: 0;padding: 9px 30px;" value="Search">
				</div>
			</div>

		</div>

	</form>
</div>
<div class="row main-row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table" >
		<div class="bg-white row">
			<div class="panel panel-body-custom tableContainParent col-md-12 col-lg-12 col-sm-12 left-tab">
				<div class="table-responsive">
					<table data-export="1,2,3,4,5,6" cellpadding="0" cellspacing="0" id="table_1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<!-- <th width="5%"></th> -->
								<th class="hidden-xs hidden-sm">Date</th>
								<th>Order#</th>
								<th>Client</th>
								<th class="hidden-xs hidden-sm">Status</th>
								<th class="hidden-xs hidden-sm">Amount</th>
								<th class="hidden-xs hidden-sm">Pay Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($orders != null) {
								foreach ($orders as $order) {

									$getOtherDetails = DB::select('SELECT * FROM `clients` WHERE id = (SELECT `customerid` FROM `orders` WHERE `id` = ?) ', [$order->orderid]);
									if ($getOtherDetails != null) {
										$getOtherDetails = $getOtherDetails[0];
										$statusKey = "constants.status_" . $order->status;
									}

									$orderdet = App\Order::where('id', $order->id)->first();
							?>
									<tr>
										<!-- <td align="center">
											<div class="checkbox-new">
												<input value="<?= $order->id ?>" class="float-left" id="order_pro_<?= $order->id ?>" name="order.product[]" type="checkbox">
												<label for="order_pro_<?= $order->id ?>" class="float-left font_size_14"></label>
											</div>
										</td> -->
										<td><?= date('M d, Y', strtotime($order->created_at)) ?></td>
										<td><a href="{!! url('vendor/details/'.$order->orderid) !!}"><?= $order->orderid ?></a></td>
										<td><a href="{!! url('vendor/profile/'.$getOtherDetails->id) !!}"><?= $getOtherDetails->name ?></a></td>

										<td class="hidden-xs hidden-sm"><?= $orderdet->status ?></td>
										<td class="hidden-xs hidden-sm">$ <?= number_format((float) $order->cost, 2, '.', '') ?></td>
										@if($order->payment == "completed")
											<td class="hidden-xs hidden-sm">Paid</td>
										@elseif($order->payment == "pending")
											<td class="hidden-xs hidden-sm">Not Paid</td>
										@else
											<td class="hidden-xs hidden-sm">Partial Paid</td>
										@endif
									</tr>
							<?php
								}
							} else {
								echo '<tr><td colspan="8" class="text-center">No Data Found</td></tr>';
							}
							?>
						</tbody>
					</table>
				</div>

			</div>
			<div class="col-md-6 col-lg-6 right-tab" style="display: none;">
				<div id="map"></div>
			</div>
		</div>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/vendor/orderlist.css') }}">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script src="{{ URL::asset('assets2/js/orderlist.js') }}"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxzp93xiNCnmkcqF983UmKvhAnOBbrcI0&callback=initMap">
</script>

@stop

@section('footer')

@stop