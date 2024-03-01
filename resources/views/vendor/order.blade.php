<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
?>

@extends('vendor.includes.master-vendor')
@section('content')
<link href="{{ URL::asset('assets/map/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/map/css/custom.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/map/css/font-awesome.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places"></script>

<script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
<!--<script src="{{ URL::asset('assets/map/js/bootstrap3.3.4.min.js')}}"></script>-->
<script src="{{ URL::asset('assets/map/js/jquery.blockUI.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets2/js/order.js') }}"></script>
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
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            @if($_GET['action'] == "new")
                            <div class="bg-success">
                                <div id="flashMessage" class="bg-success">New client added</div>
                            </div>
                            @endif
                <div>
                    <div class="inner" style="width: 100%;">
                        <div id="wizard-form" class="wizard">
                            <ul class="steps">
                                <li data-target="step1"><span class="badge badge-info">1</span>Customer<span class="chevron"></span></li>
                                <li data-target="step2"  class="active"><span class="badge">2</span>Services<span class="chevron"></span></li>
                                <li data-target="step3"><span class="badge">3</span>Confirm<span class="chevron"></span></li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
									<form method="post" action="{{ route('vendor.order_add') }}" id="main-form" class="bg-white basic-form horizontal-form col-md-12 col-sm-12 col-xs-12">
                        {{ csrf_field() }}
                        <div class="step-content">
						
                           
                            <!-- Step 2 Start -->
                            <div class="step-pane">
                                <div class="col-sm-12 col-xs-12 col-md-12 service-block">
                                    <input type="hidden" name="hf_client_id" value="{{ $_GET['client_id'] }}">

                                    <table class="items">
                                        <thead>
                                            <tr>
                                                <td style="width: 55%;">ITEM</td>
                                                <td style="width: 10%;">QTY</td>
                                                <td class="rateCol" style="width: 10%;">RATE</td>
                                                <td class="totalCol" style="width: 10%;">TOTAL</td>
                                                <td style="width: 15%;"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="item">
                                                <td>
                                                    <div class="form-group">
                                                        <?php
                                                            $order_items = DB::table('products')->orderBy('title')->get();
                                                            ?>
                                                            <select name="cmb_order_item[]" id="cmb_order_item" class="itemSelect form-control" style="width: 300px;" required="required">
                                                            <option value="">Select</option>
                                                                <?php
                                                                foreach ($order_items as $order_item) {
                                                                    $selected = "";
                                                                    if ($order_item->title == "DNS -- Per File Box") {
                                                                        $selected = "selected='selected'";
                                                                    }
                                                                    if ($order_item->id == Input::get('cmb_order_item')) {
                                                                        $selected = "selected='selected'";
                                                                    }
                                                                    echo "<option value='" . $order_item->id . "' " . $selected . ">" . $order_item->title . "</option>";
                                                                }
                                                                ?>
                                                                </select>
                                                        </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div>
                                                            <input name="txt_qty[]" class="itemQty form-control" min="1" required="required" type="number" id="txt_qty" >
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="rate form-control-static"></div>
                                                        <input type="hidden" name="hf_base_price[]" class="hf_base_price form-control" value="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="total form-control-static"> </div>
                                                        <div class="tax"></div>
                                                        <input type="hidden" name="hf_tax[]" class="hf_tax" value="">
                                                    </div>
                                                </td> 
											</tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="action"><button class="btn btn-default" id="addItem" title="Add More" style="padding: 2px 18px;" type="button"><i class="fa fa-plus"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <span class="label">Subtotal:</span> <span class="subtotal">$0.00</span>
                                                    <input type="hidden" name="hf_subtotal" id="hf_subtotal" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <span class="label">Tax:</span> <span class="finalTax">$0.00</span>
                                                    <input type="hidden" name="hf_totaltax" id="hf_totaltax" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="big-text">
                                                    <span class="label">Grand Total:</span> <span class="grandTotal">$0.00</span>
                                                    <input type="hidden" name="hf_grandtotal" id="hf_grandtotal" value="">
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="text-left col-xs-12">
                                        <a href="{{ route('vendor.customer') }}" data-prev="step1" class="btn btn-success btn-next">Back<i class="icon-arrow-left"></i></a>
                                        <button type="submit" class="btn btn-success btn-next" data-last="Finish">Submit<i class="icon-arrow-right"></i></button>
                                    </div>
                                    <div class="form-group"></div>
                                    <div class="form-group"></div>
                                </div>
                            </div>
                        </div>
                    </form>
    </div>
</div>
@stop

@section('footer')

@stop
