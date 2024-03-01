@extends('vendor.includes.master-vendor')

@section('content')
    <link href="{{ URL::asset('assets/map/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/custom.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/map/css/bootstrap-4-utilities.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">

<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/vendor/customer-orders.css') }}">
    <script src="{{ URL::asset('assets/map/js/jquery1.11.3.min.js')}}"></script>
    <script src="{{ URL::asset('assets/map/js/jquery.blockUI.js')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="page-title row">
        <h2>Customer: {{$client->first_name." ".$client->last_name}}</h2>
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

    <div class="container row">
        <div class="row main-row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-table">
                <div class="bg-white row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div id="exTab2" class="col-12">
                            <ul class="nav nav-tabs">
                                <li><a href="{{url('/vendor/customer/'.$client->id)}}">Overview</a></li>
                                <li><a href="{{url('/vendor/customer/'.$client->id.'/templates')}}">Templates</a></li>
                                <li class="active"><a href="{{url('/vendor/customer/'.$client->id.'/orders')}}?orderId=&quickdate=&fromTime=&toTime=&status=&method=&type=&orderForm=Search">Repeat
                                        Orders</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane  mt-3" id="1"></div>
                                <div class="tab-pane mt-3" id="2"></div>
                                <div class="tab-pane active mt-3" id="3">
                                    <div class="page-title row">
                                        <form action="" method="get">
                                            <div class="form-group">
                                                <div class="form-inline">
                                                    <label>Order#</label>
                                                    <input type="text" class="form-control order-id" name="orderId"
                                                           value="<?=($_GET['orderId']) != '' ? $_GET['orderId'] : ''?>">
                                                    <select class="form-control" name="quickdate">
                                                        <option value="">--Quick Date--</option>
                                                        <option value="yesterday"
                                                                <?php if($_GET['quickdate'] == 'yesterday'){?>selected<?php } ?>>
                                                            Yesterday
                                                        </option>
                                                        <option value="today"
                                                                <?php if($_GET['quickdate'] == 'today'){?>selected<?php } ?>>
                                                            Today
                                                        </option>
                                                        <option value="tomorrow"
                                                                <?php if($_GET['quickdate'] == 'tomorrow'){?>selected<?php } ?>>
                                                            Tomorrow
                                                        </option>
                                                        <option value="weekday"
                                                                <?php if($_GET['quickdate'] == 'weekday'){?>selected<?php } ?> >
                                                            This Weekdays
                                                        </option>
                                                        <option value="wholeweek"
                                                                <?php if($_GET['quickdate'] == 'wholeweek'){?>selected<?php } ?> >
                                                            This Whole Week
                                                        </option>
                                                        <option value="nextweek"
                                                                <?php if($_GET['quickdate'] == 'nextweek'){?>selected<?php } ?>>
                                                            Next Weekdays
                                                        </option>
                                                        <option value="thismonth"
                                                                <?php if($_GET['quickdate'] == 'thismonth'){?>selected<?php } ?>>
                                                            This Month
                                                        </option>
                                                        <option value="nextmonth"
                                                                <?php if($_GET['quickdate'] == 'nextmonth'){?>selected<?php } ?>>
                                                            Next Month
                                                        </option>
                                                        <option value="thisyear"
                                                                <?php if($_GET['quickdate'] == 'thisyear'){?>selected<?php } ?>>
                                                            This Year
                                                        </option>
                                                        <option value="yeartodate"
                                                                <?php if($_GET['quickdate'] == 'yeartodate'){?>selected<?php } ?>>
                                                            Year to Date
                                                        </option>
                                                        <option value="alltime"
                                                                <?php if($_GET['quickdate'] == 'alltime'){?>selected<?php } ?>>
                                                            All Time
                                                        </option>
                                                    </select>
                                                    <div class="custom-dateicker">
                                                        <label>From</label>
                                                        <div id="datepicker2" class="input-group date custom-calendar"
                                                             data-date-format="mm-dd-yyyy">
                                                            <input class="form-control datepicker" name="fromTime" type="text" value="<?=($_GET['fromTime']) != '' ? $_GET['fromTime'] : ''?>"/>
                                                            <span class="input-group-addon"><i
                                                                        class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="custom-dateicker">
                                                        <label>To</label>
                                                        <div id="datepicker3" class="input-group date custom-calendar"
                                                             data-date-format="mm-dd-yyyy">
                                                            <input class="form-control datepicker" name="toTime"
                                                                   type="text"
                                                                   value="<?=($_GET['toTime']) != '' ? $_GET['toTime'] : ''?>"/>
                                                            <span class="input-group-addon"><i
                                                                        class="fa fa-calendar"></i></span>
                                                        </div>
                                                    </div>
                                                    <select class="form-control" name="status">
                                                        <option value="">--Status--</option>
                                                        <option value="scheduled"
                                                                <?php if($_GET['status'] == 'scheduled'){?>selected<?php } ?>>Scheduled
                                                        </option>
                                                        <option value="completed"
                                                                <?php if($_GET['status'] == 'completed'){?>selected<?php } ?>>Completed
                                                        </option>
                                                        <option value="at plant completed"
                                                                <?php if($_GET['status'] == 'at plant completed'){?>selected<?php } ?>>At Plant Completed
                                                        </option>
                                                        <option value="in transit"
                                                                <?php if($_GET['status'] == 'in transit'){?>selected<?php } ?>>In Transit
                                                        </option>
                                                        <option value="at plant"
                                                                <?php if($_GET['status'] == 'at plant'){?>selected<?php } ?>>At Plant
                                                        </option>
                                                        <option value="on delivery"
                                                                <?php if($_GET['status'] == 'on delivery'){?>selected<?php } ?>>On Delivery
                                                        </option>
                                                        <option value="completed at store"
                                                                <?php if($_GET['status'] == 'completed at store'){?>selected<?php } ?>>Completed At Store
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <div class="form-inline">
                                                    <div class="pull-left">
                                                        <select class="form-control" name="method">
                                                            <option value="">--Payment Method--</option>
                                                            <option value="Paypal"
                                                                    <?php if($_GET['method'] == 'Paypal'){?>selected<?php } ?>>
                                                                PayPal
                                                            </option>
                                                            <option value="Credit Card"
                                                                    <?php if($_GET['method'] == 'Credit Card'){?>selected<?php } ?>>
                                                                Credit Card
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="pull-left">
                                                       <select class="form-control" name="type">
                                                            <option value="">--JOb Type--</option>
                                                            <?php foreach ($jobType as $type){ ?>
                                                            <option value="{{$type->id}}"
                                                                    <?php if($_GET['type'] == $type->id){?>selected<?php } ?>>{{$type->name}}</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="comments-form pull-left">
                                                        <input type="submit" name="orderForm" class="btn btn-success "
                                                               style="margin: 0;padding: 9px 30px;" value="Search">
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                    <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 left-tab">
                                        <div class="table-responsive">
                                            <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                                <table class="table table-bordered w-100" id="orders-table">
                                                    <thead>
                                                    <tr>
                                                        <th>
                                                        </th>
                                                        <th>Id</th>
                                                        <th>Order Type</th>
                                                        <th>Method</th>
                                                        <th>Pay Amount</th>
                                                        <th>Booking Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                </table>
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
    </div>
    <script src="{{ URL::asset('assets2/js/customer-order.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="http://cdn.datatables.net/plug-ins/1.10.15/dataRender/datetime.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

@stop

@section('footer')

@stop