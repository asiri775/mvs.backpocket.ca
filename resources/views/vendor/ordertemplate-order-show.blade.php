@extends('vendor.includes.master-vendor')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('assets2/css/vendor/ordertemplate-order-show.css') }}">
    <div class="page-title row">
        <h2>Booking Date: {{date('Y-m-d', strtotime($order->booking_date))}}</h2>
        <div style="float: right;">
        </div>
    </div>
    <div class="bg-white row">
        <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 left-tab">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="top-title">
                        <h3>Order Details</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="mt-2 col-md-4">
                            <p><strong>ID:</strong></p>
                            <p>{{$order->id}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Payment Method:</strong></p>
                            <p>{{$order->method}}</p>
                        </div>

                        <div class="mt-2 col-md-4">
                            <p><strong>Payment Status:</strong></p>
                            <p>{{$order->payment_status }}</p>
                        </div>
                        <div class="mt-2 col-md-4">
                            <p><strong><u>Billing Address</u></strong></p>
                            <p>{{$order->customer_name }}</p>
                            <p>{{$order->customer_address }}</p>
                            <p>{{$order->customer_city }}</p>
                            <p>{{$order->customer_zip }}</p>
                            <p>{{$order->customer_phone }}</p>
                        </div>
                        <div class="mt-2 col-md-4">
                            <p><strong><u>Shipping Address</u></strong></p>
                            <p>{{$order->shipping_name }}</p>
                            <p>{{$order->shipping_address }}</p>
                            <p>{{$order->shipping_city }}</p>
                            <p>{{$order->shipping_zip }}</p>
                            <p>{{$order->shipping_phone }}</p>
                        </div>
<br/>
                        <div class="panel-body-custom tableContainParent panel col-md-12 col-lg-12 col-sm-12 ">
                            <div class="table-responsive">
                                <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                    <table class="table table-bordered w-100">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>QTY</th>
                                            <th>Sub Total</th>
                                        </tr>
                                        </thead>
                                      <tbody>
                                        <?php
                                        foreach ($products As $product){
                                        $productDetails=$product->getProductidAttribute($product->productid);
                                       ?>
                                        <tr>
                                            <td>{{$productDetails[0]->title}}</td>
                                            <td>{{number_format((float)$productDetails[0]->price, 2, '.', '')}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{number_format((float)$product->cost, 2, '.', '')}}</td>

                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><b>Tax</b></td>
                                            <td><b>{{number_format((float)$product->cost*0.13, 2, '.', '')}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><b>Total</b></td>
                                            <td><b>{{number_format((float)($product->cost*0.13+$product->cost), 2, '.', '')}}</b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <a href="/vendor/customer/{{$order->customerid}}" class="btn btn-success float-right my-2">Back To Customer
                Account</a>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ URL::asset('assets2/js/ordertemplate-order-show.js') }}">s</script>
@stop

@section('footer')

@stop