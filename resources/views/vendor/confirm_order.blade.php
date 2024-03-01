<?php
use App\Order;
use App\OrderedProducts;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Clients;

$id = $_GET['orderid'];
if($id!=''){
    $order = Order::findOrFail($id);
    $model=DB::select("select * from ordered_products where orderid=".$id."");
}else{
    redirect('');
}
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
<script type="text/javascript" src="{{ URL::asset('assets2/js/confirm_order.js') }}"></script>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
        @if (Session::get('error') != "")
                            <div class="bg-danger">
                                <div id="flashMessage" class="bg-danger">{{ Session::get('error') }}</div>
                            </div>
                        @else
                            @if (empty($view))
                            <div class="bg-success">
                                <div id="flashMessage" class="bg-success">Order added successfully!</div>
                            </div>
                            @elseif ($view == 2)
                            <div class="bg-success">
                                <div id="flashMessage" class="bg-success">Invoice was sent to email</div>
                            </div>
                            @endif
                        @endif
            <div  class="col-xs-12">
                <div class="inner">
                    <div id="wizard-form" class="wizard">
                        <ul class="steps">
                            <li data-target="step1"><span class="badge badge-info">1</span>Customer<span class="chevron"></span></li>
                            <li data-target="step2"><span class="badge">2</span>Services<span class="chevron"></span></li>
                            <li data-target="step3" class="active"><span class="badge">3</span>Confirm<span class="chevron"></span></li>
                        </ul>
                    </div>
                    <form method="post" action="{{ route('vendor.order_job_status') }}" id="main-form" class="bg-white basic-form horizontal-form col-md-12 col-sm-12 col-xs-12">
                        {{ csrf_field() }}
                    <div id="printdiv">
                        <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4"><strong>Client Information</strong></p>
                            <p class="mb-1"><?=$order->customer_name?></p>
                            <p><?=$order->customer_email?></p>
                            <p class="mb-1"><?=$order->customer_city?>, <?=$order->customer_address?> <?=$order->customer_zip?></p>
                            <p class="mb-1"><?=$order->customer_phone?></p>
                        </div>

                        <div class="col-md-6 text-right mb_left">
                            <p class="font-weight-bold mb-4"><strong>Payment Details</strong></p>
                            <p class="mb-1"><span class="text-muted">Total Amount: </span> $<?=$order->pay_amount?></p>
                            <p class="mb-1"><span class="text-muted">Order number: </span> <?=$order->order_number?></p>
                            <p class="mb-1"><span class="text-muted">Payment Status: </span> <?=$order->payment_status?></p>
                        </div>
                    </div>
                    <hr class="my-5">

                    <div class="row p-5">
                        <div class="col-md-12">
                        <div class="table-responsive">
                                    <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Product</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>                                        
                                            <th class="border-0 text-uppercase small font-weight-bold">Date</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $totalAmount=0;
                                            if(count($model)>0){
                                                $count=1;
                                                foreach($model as $orderDD){ 
                                                ?>
                                                <tr> 
                                                    <td><?php echo $count;?></td>
                                                    <td><?php  
                                                    $productDetails=DB::select("select * from products where id='".$orderDD->productid."' limit 1");
                                                    
                                                    if($productDetails!=null){ 
                                                        foreach($productDetails as $product){
                                                            echo $product->title;	
                                                        }
                                                    } 
                                                    ?></td>
                                                    <td><?php echo $orderDD->quantity;?></td>
                                                    <td><?php   echo $orderDD->created_at;?></td>
                                                    <td><?php 
                                                       echo "$".$orderDD->cost;?></td>
                                                </tr>
                                                <?php   $totalAmount = $totalAmount+$orderDD->cost;
                                                $count++;
                                                }  
                                            } 
                                            else{
                                                echo '<td colspan="5" style="text-align:center">No Results Found</td>';
                                            }
                                                
                                            ?> 
                                    </tbody>
                                </table>
                        </div>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row">
                        <div class="col-md-6 text-left">
                            <p class="font-weight-bold mb-1">Order ID #<?=$order->id?></p>
                            <p class="text-muted">Date: <?=$order->booking_date?></p>
                    </div> 
                        <div class="col-md-6 text-right mb_left">
                            <div class="mb-2">Grand Total (Including Tax)</div>
                            <div class="h2 font-weight-light" style="color: #000;margin: 5px 0">$<?=$order->pay_amount?></div>
                        </div>
                    </div> 
                    </div>
                        <div class="table">
                            
                            <div class="text-center col-xs-12">
                                          <ul class="table-foot-btn excel-btn">
                                                <strong>
                                                    <li>
                                                    <button type="submit" class="bulkEmailTrigger bigBtnhref sendMail" title="Schedule Job"><i class="fa fa-tasks"></i></button>
                                                    </li>
                                                    <li>
                                                    <button type="submit" class="bulkEmailTrigger bigBtnhref sendMail" title="Send Service Agreement"><i class="fa fa-font-awesome"></i></button>
                                                    </li>
                                                    <li>
                                                    <input type="hidden" name="oid" value="<?=$order->id?>" />
                                                    <input type="hidden" name="job_status" value="draft" />
                                                    <button type="submit" class="bulkEmailTrigger bigBtnhref sendMail" title="Save as Draft"> <i class="fa fa-file"></i></button>
                                                    </li>
                                                    <li>
                                                    <a href="javascript:;" onclick="printDiv('printdiv')" class="printExport" title="Print"><i class="fa fa-print" aria-controls="table_1"></i></a></li>
                                                    <li><a href="javascript:void(0)"  id="downloadpdf" class="downloadpdf" title="Download"><i class="fa fa-file-pdf-o"></i></a>
                                                    </li>
                                                    <li>
                                                    <a class="bulkEmailTrigger bigBtnhref sendMail" title="Email" href='{{ route("orders_details_mail",$order->id)}}'><i class="fa fa-envelope"></i></a>
                                                    </li>
                                                </strong>
                                            </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('assets2/js/confirm_order_2.js') }}"></script>

@stop

@section('footer')

@stop
