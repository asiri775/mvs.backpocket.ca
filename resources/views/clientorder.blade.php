@extends('includes.newmaster2')

<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> -->
<!-- <html xmlns="http://www.w3.org/1999/xhtml"><head> -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
<meta name="description" content="" />
<meta name="keywords" content=""/>

<link href='http://fonts.googleapis.com/css?family=Lato:400,100italic,100,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('project/public/clientorder-css/bootstrap.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('project/public/clientorder-css/font-awesome.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('project/public/clientorder-css/style.css?v=1.2')}}"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/jquery1.11.3.min.js')}}"  ></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/bootstrap3.3.4.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/picker.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/picker.date.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/validate.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/validate_init.js?v=1.0')}}"></script>
<script type="text/javascript" src="{{ URL::asset('project/public/clientorder-js/function.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/clientorder.css') }}">
<!-- </head> -->
@section('content')

   	<section class="main-container">
			<div class="container">

            <div class="row">
           		<div class="col-xs-12">
                    <h3 class="request-quote"></h3>
                    <div class="boxed no-padding">
											@if ($message = Session::get('flash_message'))
											<div class="alert alert-success fade-message" role="alert">

											  {{ $message }}
											    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											        <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
											    </button>
											</div>
											@endif
                        <div class="inner">
                            <div id="wizard-form" class="wizard">
                                <ul class="steps">
                                    <li data-target="step1" class="active"><span class="badge badge-info">1</span>Customer<span class="chevron"></span></li>
                                    <li data-target="step2"><span class="badge">2</span>Service<span class="chevron"></span></li>
                                    <li data-target="step3"><span class="badge">3</span>Contact Info<span class="chevron"></span></li>
                                    <li data-target="step4"><span class="badge">4</span>Confirm<span class="chevron"></span></li>
                                </ul>
                            </div>
                            <div class="step-content">
                              <form method=""  enctype="multipart/form-data" action="{{route('clientorder.store')}}" name="clientorderform" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12">
                				<!-- Step 1 Start -->
                                <div class="step-pane step1">
                                    <div class="map-section">
                                        <div id="locationField">
                                            <input autocomplete="off" id="autocomplete" placeholder="Enter address here" type="text"></input>
                                            <ul id="result" class="serachwrap"></ul>
                                        </div>
                                        <div id="map"></div>
                                    </div>
                                	<div class="address-form-block col-md-6 col-sm-12 col-xs-12 hide">
                                 		<!-- <h3>Verify Address</h3> -->
                                  	<div class="row">
                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3"  for="address">Address:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="address" id="address" placeholder="Enter address" value="">
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3"for="street_no">Street No:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="street_no" id="street_no" placeholder="Enter Street No" value="">
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3"for="unit">Unit:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="unit" id="unit" placeholder="Enter Unit" value="">
                                      </div>
                                    </div>

                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3" for="state">State/Province:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="state" id="state" placeholder="Enter state/province" value="">
                                        <!-- <select name="stae" id="state" value="">
                                            <option value="">--State--</option>
                                            <option value="Alberta">Alberta</option>
                                            <option value="British Columbia">British Columbia</option>
                                            <option value="Manitoba">Manitoba</option>
                                            <option value="New Brunswick">New Brunswick</option>
                                            <option value="Newfoundland">Newfoundland</option>
                                            <option value="Northwest Territorie">Northwest Territorie</option>
                                            <option value="Nova Scotia">Nova Scotia</option>
                                            <option value="Nunavut">Nunavut</option>
                                            <option value="Ontario">Ontario</option>
                                            <option value="Prince Edward Island">Prince Edward Island</option>
                                            <option value="Квебек">Quebec</option>
                                            <option value="Saskatchewan">Saskatchewan</option>
                                            <option value="Yukon">Yukon</option>
                                         </select> -->
                                      </div>
                                    </div>
                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-3" for="service_requested">City:</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="city" id="city" placeholder="Enter your city" value="">
                                            </div>
                                        </div>
                                    <div class="col-xs-12">
                                      <label class="control-label col-sm-3" for="zip">Zip/Postal Code:</label>
                                      <div class="col-sm-9">
                                      <input type="text" name="zip" id="zip" placeholder="Enter zip/postal code" value="">
                                      </div>
                                    </div>
                                    <div class="col-xs-12">
<!--                                      <label class="control-label col-sm-3" for="country">Country:</label>-->
                                      <div class="col-sm-9">
                                      <input type="hidden" name="country"  id="country" value="CA">
                                      </div>
                                    </div>
                                 	<div class="text-right col-xs-12">
                                      <div class="actions col-xs-12">
                                        <button type="button" data-next="step2" class="btn btn-md login-btn btn-next">Next<i class="icon-arrow-right"></i></button>
                                      </div>
                                    </div>
                                  </div>
                                	</div>
                                </div>
                                 <div class="step-pane step2">
                                  <div class="row">


				                                <div class="col-sm-12 col-xs-12 col-md-12 service-block">

				                                    <table class="items">
				                                        <thead>
				                                            <tr>
				                                                <td style="width: 20%;"> <b>ITEM</b></td>
				                                                <td style="width: 15%;"><b>QTY</b></td>
				                                                <td class="rateCol" style="width: 10%;"><b>RATE</b></td>
				                                                <td class="totalCol" style="width: 10%;"><b>TOTAL</b></td>
				                                                <td style="width: 15%;"></td>
				                                            </tr>
				                                        </thead>
				                                        <tbody>
				                                            <tr class="item">
				                                                <td>
				                                                    <div class="form-group">
				                                                        <div>
							<select required name="cmb_order_item[]" id="cmb_order_item" class="itemSelect form-control" style="width:250px;">
							<option value="">Select</option>
							<?php
							foreach ($order_items as $order_item) {
										$selected = "";
										if ($order_item->title == "DNS -- Per File Box") {
												$selected = "selected='selected'";
										}
										echo "<option value='" . $order_item->id . "' " . $selected . ">" . $order_item->title . "</option>";
							}?>
							</select>
				                                                        </div>
				                                                    </div>
				                                                </td>
				                                                <td>
				                                                    <div class="form-group">
				                                                        <div class="col-sm-6" style="padding-left: 0px;">
				                                                            <input required name="txt_qty[]" class="itemQty form-control" min="1"  type="number" id="txt_qty">
				                                                        </div>
				                                                    </div>
				                                                </td>
				                                                <td>
				                                                    <div class="form-group">
				                                                        <div class="rate form-control-static">$0.00</div>
				                                                        <input type="hidden" name="hf_base_price[]" class="hf_base_price form-control" value="">
				                                                    </div>
				                                                </td>
				                                                <td>
				                                                    <div class="form-group">
				                                                        <div class="total form-control-static">$0.00</div>
				                                                        <input type="hidden" name="hf_tax[]" class="hf_tax" value="">
				                                                    </div>
																	<div style="display:none" class="tax form-control-static">$0.00</div>
				                                                </td>
															</tr>
				                                        </tbody>
				                                        <tfoot>
				                                            <tr>
				                                                <td colspan="5" class="action"><button class="btn btn-default" style="padding: 3px 10px;" id="addItem" type="button">
                                                          <i class="fa fa-plus plussigncenetr" style="font-size: 18px;"></i>
                                                        </button></td>
				                                            </tr>
				                                            <!-- <tr>
				                                                <td colspan="5">&nbsp;</td>
				                                            </tr> -->
				                                            <tr>
				                                                <td colspan="3" align="right">
				                                                    <b>Subtotal</b> :
				                                                    <input type="hidden" name="hf_subtotal" id="hf_subtotal" value="">
																</td>
																<td>
				                                                    <span class="subtotal">$0.00</span>
				                                                </td>
															</tr>
															<tr>
															<td colspan="3" align="right">
																<b>Tax</b> :
															</td>
															 <td>
				                                                <span class="finalTax">$0.00</span>
																<input type="hidden" name="hf_totaltax" id="hf_totaltax" value="">
				                                            </td>
															</tr>
				                                            <tr>
				                                                <td colspan="3" class="big-text" align="right">
				                                                    <b>Grand Total</b> :
				                                                    <input type="hidden" name="hf_grandtotal" id="hf_grandtotal" value="">
																</td>
																<td>
				                                                <span class="grandTotal">$0.00</span>
				                                            	</td>
				                                            </tr>
				                                        </tfoot>
				                                    </table>
				                                    <div class="text-right col-xs-12">
				                                        <div class="actions col-xs-12">

				                                        </div>
				                                    </div>
				                                    <div class="form-group"></div>
				                                    <div class="form-group"></div>
				                                </div>


                                    <div class="text-right col-xs-12">
                                      <div class="actions col-xs-12">
                                      	<a class="btn btn-default  btn-prev" href="javascript:;" data-back="step1"></i>Back</a>
                                        <button style="margin-left: 5px;" type="button" data-next="step3" class="btn btn-md login-btn btn-next orderformsubmit">Next<i class="icon-arrow-right"></i></button>
                                      </div>
                                    </div>
                                   </div>
                                 </div>
                                <div class="step-pane step3">
                                  	<div class="row">
                                        <div class="col-xs-12">
                                            <label class="control-label col-sm-2" for="company">Company:</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="company" id="company" placeholder="Enter company" value="">
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                          <label class="control-label col-sm-2" for="firstname">First Name:</label>
                                          <div class="col-sm-10">
                                            <input type="text" name="firstname" id="firstname" placeholder="Enter first name" value="">
                                          </div>
                                        </div>
                                        <div class="col-xs-12">
                                          <label class="control-label col-sm-2" for="lastname">Last Name:</label>
                                          <div class="col-sm-10">
                                            <input type="text" name="lastname" id="lastname" placeholder="Enter last name" value="">
                                          </div>
                                        </div>
                                        <div class="col-xs-12">
                                          <label class="control-label col-sm-2" for="email">Email:</label>
                                          <div class="col-sm-10">
                                            <input type="text" name="email" id="email" placeholder="Enter email" value="">
                                          </div>
                                        </div>
																				<div class="col-xs-12">
																					<label class="control-label col-sm-2" for="password">Password:</label>
																					<div class="col-sm-10">
																						<input type="password" name="password" id="password" placeholder="Enter Password" value="">
																					</div>
																				</div>
                                        <div class="col-xs-12">
                                          <label class="control-label col-sm-2" for="phone">Phone:</label>
                                          <div class="col-sm-10">
                                            <input type="text" name="phone" id="phone" placeholder="Enter phone" value="">
                                          </div>
                                        </div>
                                        <div class="text-right col-xs-12">
                                          <div class="actions col-xs-12">
                                            <a class="btn btn-default  btn-prev" href="javascript:;" data-back="step2"></i>Back</a>
                                            <button type="button" style="margin-left: 5px;" data-next="step4" class="btn btn-md login-btn btn-next">Next<i class="icon-arrow-right"></i></button>
                                          </div>
                                     	</div>
                                	</div>
                                </div>
                                <!-- Step4 Start -->
                                <div class="step-pane step4">
                                  	<div class="row">

																			<h1 align="center">Terms & Conditions</h1>
																			<div class="text-right col-xs-12">
																				<div class="actions col-xs-12">
																					<a class="btn btn-default  btn-prev" href="javascript:;" data-back="step3"></i>Back</a>
																					<button type="submit" style="margin-left: 5px;" class="btn btn-md login-btn" onclick="clientorderform.submit();">Submit</button>
																				</div>
																			</div>
                                	</div>
                                </div>
                                <!-- <span class="form-control-static">Remove</span> -->
                               </form>
            				</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <footer>
         <div class="container">
            <div class="row">
                <div class="col-xs-12">
                </div>
                <div class="col-xs-12 copyright">
                	&copy; 2019 LocalShredding.ca by shredEX Inc.
                </div>
            </div>
         </div>
    </footer> -->

		@stop



@section('footer')


<script src="{{ URL::asset('assets2/js/clientorder.js') }}"></script>
@stop
