@extends('vendor.includes.master-vendor')

@section('content')

<link href="{{ URL::asset('assets/map/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/map/css/custom.css')}}" rel="stylesheet">
<link href="{{ URL::asset('assets/map/css/font-awesome.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRu_qlT0HNjPcs45NXXiOSMd3btAUduSc&libraries=places"></script>
<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/vendor/customer.css') }}">
<script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
<!--<script src="{{ URL::asset('assets/map/js/bootstrap3.3.4.min.js')}}"></script>-->
<script src="{{ URL::asset('assets/map/js/jquery.blockUI.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets2/js/customer.js') }}"></script>

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
            <div class="boxed no-padding">
                <div class="inner">
                    <div id="wizard-form" class="wizard">
                        <ul class="steps">
                            <li data-target="step1" class="active">Customer<span class="chevron"></span></li>
                            <!-- <li data-target="step2"><span class="badge">2</span>Services<span class="chevron"></span></li>
                            <li data-target="step3"><span class="badge">3</span>Confirm<span class="chevron"></span></li> -->
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <form method="post" action="{{ route('vendor.customer_add') }}" id="main-form" class="basic-form horizontal-form col-md-12 col-sm-12 col-xs-12 customer_left_portion">
                                        <div class="customer_right_top col-md-12">
                                            <div class="img"><img src="http://kiosk.shredex.net/resources/assets/image/add-client.png"></div>
                                            <h2 class="Client_title">New Customer</h2>
                                            <p>Use Customer's Address</p>
                                        </div>
                                        {{ csrf_field() }}
                                        <div class="step-content">
                                            <!-- Step 1 Start -->
                                            <div class="step-pane step1">
                                                <div class="map-section col-md-12 col-sm-12 col-xs-12" style="width: 100% !important;">
                                                    <div id="locationField">
                                                        <input autocomplete="off" id="autocomplete" placeholder="Enter address here" type="text">
                                                        </input>
                                                        <ul id="result" class="serachwrap">
                                                        </ul>
                                                    </div>
                                                    <div id="map"></div>
                                                </div>
                                                <div class="address-form-block col-md-12 col-sm-12 col-xs-12 hide">
                                                    <h3>Verify Address</h3>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <label for="ClientBusinessName" class="control-label col-sm-3">Business Name</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="business_name" id="business_name" placeholder="Business Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="unit">First Name *</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="unit">Last Name *</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="province">Gender *</label>
                                                            <div class="col-sm-9">
                                                                <select name="gender" class="form-control" placeholder="Gender" id="gender">
                                                                    <option value="">Select Gender</option>
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="city">E-mail *</label>
                                                            <div class="col-sm-9">
                                                                <input type="email" name="email" id="email" placeholder="E-mail" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="phone">Phone *</label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="phone1" id="phone1" maxlength="3" placeholder="000" required>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="phone2" id="phone2" maxlength="3" placeholder="000" required>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" name="phone3" id="phone3" maxlength="4" placeholder="0000" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="address">Address</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="address" id="address" placeholder="Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="address">Country</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="country" id="country" placeholder="Country">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="city">City</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="city" id="city" placeholder="City">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="province">Province</label>
                                                            <div class="col-sm-9">
                                                                <select name="province" class="form-control" placeholder="Province" id="province">
                                                                    <option value="">Select Province</option>
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
                                                                    <option value="Quebec">Quebec</option>
                                                                    <option value="Saskatchewan">Saskatchewan</option>
                                                                    <option value="Yukon">Yukon</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12">
                                                            <label class="control-label col-sm-3" for="postalcode">Postal Code</label>
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="col-sm-3">
                                                                        <input type="text" name="zip1" maxlength="3" id="zip1" placeholder="">
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <input type="text" name="zip2" maxlength="3" id="zip2" placeholder="">
                                                                    </div>
                                                                    <input type="hidden" class="form-control" name="lontude" id="lontude">
                                                                    <input type="hidden" class="form-control" name="latude" id="latude">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right col-xs-12">
                                                            <div class="actions col-xs-12">
                                                                <button type="submit" data-next="step2" id="btnCreateClient" class="btn btn-success btn-next">Create<i class="icon-arrow-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!------>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 basic-form" style="overflow: hidden;">
                                <div class="customer_right_top" style="padding: 5px 10px 0 10px !important;margin: 30px 0 !important;">
                                    <div class="img"><img src="http://kiosk.shredex.net/resources/assets/image/exit-client.png"></div>
                                    <h2 class="Client_title">Existing Clients</h2>
                                    <p>Use any one of the following filters to search for an existing client</p>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row" style="margin-bottom: 30px;">
                                            <div class="col-lg-12">
                                                <label for="ClientQ">Enter Client First and Last Name or Company Name</label>
                                                <div class="input-group">
                                                    <input name="txt_search_by_name" class="form-control" placeholder="Search" autocomplete="off" type="text" id="txt_search_by_name" style="margin:0px; border-right: 0;">
                                                    <span class="input-group-btn"><label class="btn btn-default search-icon"><i class="fa fa-search"></i></label></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12" style="margin-top: 30px;">
                                                <label for="ClientQ">Search By Phone Number</label>
                                                <div class="input-group">
                                                    <input name="txt_search_by_phone" class="form-control" placeholder="Search" autocomplete="off" type="text" id="txt_search_by_phone" style="margin:0px; border-right: 0;">
                                                    <span class="input-group-btn"><label class="btn btn-default search-icon"><i class="fa fa-search"></i></label></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center" style="margin-top: 20px;">
                                                <button type="button" id="doSearch" class="lnk-change-pwd btn btn-success fr btn-client-srch">Search</button>
                                            </div>
                                        </div>
                                        <div class="resultsMessage" style="display: none;">Query should contain minimum 3 characters</div>
                                        <div class="resultsTable" style="display: none; overflow-x: scroll; height: 500px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">On Site</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Off Site</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="blockUI blockMsg blockPage" style="z-index: 1011; display:none;position: absolute !important;" id="updateCustomerForm">
    <div class="background-container">
        <h3 style="text-align:center;">Edit Customer</h3>
        <form action="{{ route('vendor.customer_update') }}" role="form" class="form-horizontal" id="ClientHomeForm" method="post" accept-charset="utf-8">
            {{ csrf_field() }}
            <div class="col-sm-10">
                <input type="hidden" name="hf_client_id" class="form-control" id="hf_client_id" value="">
            </div>
            <div class="form-group">
                <label for="BUSINESS_NAME" class="col-sm-4 control-label">Business Name</label>
                <div class="col-sm-7">
                    <input name="txt_business_name" class="form-control" placeholder="Business Name" id="txt_business_name" type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="CONTACT_FIRST_NAME" class="col-sm-4 control-label">First Name *</label>
                <div class="col-sm-7">
                    <input name="txt_first_name" class="form-control" placeholder="First Name" id="txt_first_name" required type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="CONTACT_LAST_NAME" class="col-sm-4 control-label">Last Name *</label>
                <div class="col-sm-7">
                    <input name="txt_last_name" class="form-control" placeholder="Last Name" id="txt_last_name" required type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="province">Gender *</label>
                <div class="col-sm-7">
                    <select name="txt_gender" class="form-control" placeholder="Gender" id="txt_gender">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="EMAIL" class="col-sm-4 control-label">E-mail *</label>
                <div class="col-sm-7">
                    <input name="txt_email" class="form-control" placeholder="Email" required id="txt_email" type="email">
                </div>
            </div>
            <div class="form-group">
                <label for="PHONE" class="col-sm-4 control-label">Phone</label>
                <div class="col-sm-2">
                    <input name="txt_phone1" class="form-control" maxlength="3" placeholder="000" id="txt_phone1" type="phone">
                </div>
                <div class="col-sm-2">
                    <input name="txt_phone2" class="form-control" maxlength="3" placeholder="000" id="txt_phone2" type="phone">
                </div>
                <div class="col-sm-3">
                    <input name="txt_phone3" class="form-control" maxlength="4" placeholder="0000" id="txt_phone3" type="phone">
                </div>
            </div>
            <div class="form-group">
                <label for="STREET_ADDR1" class="col-sm-4 control-label">Address</label>
                <div class="col-sm-7">
                    <input name="txt_address" class="form-control" placeholder="Address" id="txt_address" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="address">Country</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="txt_country" id="txt_country" placeholder="Country">
                </div>
            </div>
            <div class="form-group">
                <label for="CITY" class="col-sm-4 control-label">City</label>
                <div class="col-sm-7">
                    <input name="txt_city" class="form-control" placeholder="City" id="txt_city" type="text">
                </div>
            </div>
            <div class="form-group">
                <label for="PROVINCE" class="col-sm-4 control-label">Province</label>
                <div class="col-sm-7">
                    <select name="cmb_province" class="form-control" placeholder="Province" id="cmb_province">
                        <option value="">Select Province</option>
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
                        <option value="Quebec">Quebec</option>
                        <option value="Saskatchewan">Saskatchewan</option>
                        <option value="Yukon">Yukon</option>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-sm-4 control-label">
                    <label for="ClientPostalCode1">Postal Code</label>
                </div>
                <div class="col-sm-2">
                    <input name="txt_fsa1" class="form-control" maxlength="3" id="txt_fsa1" type="text">
                </div>
                <div class="col-sm-2">
                    <input name="txt_fsa2" class="form-control" maxlength="3" id="txt_fsa2" type="text">
                </div>
            </div>
            <button class="btn btn-inverse close-box-button" type="reset">Cancel</button>
            &nbsp;
            <button class="btn btn-success" type="submit">Update</button>
            <div class="form-group"></div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ URL::asset('assets2/js/customer.js') }}"></script>
@stop

@section('footer')

@stop