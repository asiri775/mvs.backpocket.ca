@extends('new_includes.new_main')

@section('title','| HomePage')



@section('content')
<link rel="stylesheet" href="{{ URL::asset('assets2/css/new_pages/user_orders.css') }}">
    <div class="content ">
        <div class="jumbotron" data-pages="parallax">
            <div class=" container-fluid   container-fixed-lg sm-p-l-0 sm-p-r-0">
                <div class="inner">
                    <ol class="breadcrumb">
                        <li class="">Dashboard</li>
                        <li style="color: #8533ff!important" class="top-right1">Account Balance CR{{$settings[0]->currency_sign}}{{ number_format($user->balance, 2) }}</li>

                    </ol>
                </div>
            </div>
        </div>
        <div class=" container-fluid">
            <div class="card card-default">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-default">
                            <div class="invoice padding-20 sm-padding-10">
                                <div class="card-body p-t-20">
                                    <h1>Orders page comming soon</h1>

                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="background-color: #f0f0f0; padding: 40px">
                        <h5 class="font-weight-bold">Why Choose Favourite Items?</h5>
                        <p class="m-b-20">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('new_assets/assets/plugins/pace/pace.min.js')}}"  type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/modernizr.custom.js')}}"  type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-ui/jquery-ui.min.js')}}"  type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/popper/umd/popper.min.js')}}"  type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/bootstrap/js/bootstrap.min.js')}}"  type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery/jquery-easy.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-ios-list/jquery.ioslist.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-actual/jquery.actual.min.js')}}"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/select2/js/select2.full.min.js')}}" type="text/javascript" src=""></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/classie/classie.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/switchery/js/switchery.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/nvd3/lib/d3.v3.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/nvd3/nv.d3.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/utils.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/tooltip.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/interactiveLayer.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/models/axis.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/models/line.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/nvd3/src/models/lineWithFocusChart.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/mapplic/js/hammer.min.js')}}"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/mapplic/js/jquery.mousewheel.js')}}"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/mapplic/js/mapplic.js')}}"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-metrojs/MetroJs.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/skycons/skycons.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}"
            type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}"
            type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/plugins/datatables-responsive/js/datatables.responsive.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/pages/js/pages.js')}}"></script>
    <script src="{{ URL::asset('new_assets/assets/js/scripts.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('new_assets/assets/js/scripts.js')}}" type="text/javascript"></script>

@endsection 