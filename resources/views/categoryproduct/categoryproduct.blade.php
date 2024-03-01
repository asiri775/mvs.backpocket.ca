@extends('categoryproduct.newmaster2',['cart_result'=> $response])
@section('title', '| ' . $category_current['name'])
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets2/css/categoryproduct.css') }}">

    <div class="home-wrapper">

    <div class="container-fluid">
        <div class="section-padding product-filter-wrapper wow fadeInUp">

            <div class="container inner-block">
                @if(!$featured_products->isEmpty())
                <h3>Most Popular Products</h3>
                <table id="featuredTable" class="table table-striped tabele-bordered" style="margin-top:20px;">
                    <thead>
                        <tr>
                            <th style="width: 40%">Item</th>
                            <th style="width: 25%" class="text-left">Rate</th>
                            <th style="width: 30%" class="text-center">QTY</th>
                            <th style="width: 8%"></th>
                            {{-- <td>Total</td> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($featured_products as $key => $featured_product)
                        <tr>
                            <td><a
                                    href='{{ url('product') . '/' . $featured_product->id . '/' . str_replace(' ', '-', strtolower($featured_product->title)) }}'>{{ $featured_product->title }}</a>
                                <input type='hidden' class='_token' name='_token' value='{{csrf_token()}}'>
                                <input type='hidden' class='uniqueid' name='uniqueid'
                                    value='{{ Session::get('uniqueid') }}'>
                                <input type='hidden' class='price' name='price'
                                    value='{{ number_format((float)$featured_product->price, 2, '.', '') }}'>
                                <input type='hidden' class='title' name='title'
                                    value='{{ str_replace(' ', '-', strtolower($featured_product->title)) }}'>
                                <input type='hidden' class='product' name='product' value='{{ $featured_product->id }}'>
                                <input type='hidden' class='cost' name='cost' value='{{ $featured_product->price }}'>
                                <input type='hidden' class='size' name='size'>
                            </td>
                            <td class='text-left'>$ {{ number_format((float)$featured_product->price, 2, '.', '') }}
                            </td>
                            <td class='text-center icons'>
                                <i style='cursor: pointer;' class='fas fa-minus-circle'
                                    onclick='decrementValue(this)'></i>
                                <input class='number quantity' style='border-style: none;width: 17px;' type='text'
                                    id='{{ $key }}' value='1' readonly>
                                <i style='cursor: pointer;' class='fas fa-plus-circle'
                                    onclick='incrementValue(this)'></i>
                            <td><a href='#!' class='add-cart' onclick='toAddCartFromTable(this)'><i
                                        class='fas fa-cart-plus cart-icon'
                                        style='margin-top: 0px; padding-top: 0px;'></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                <hr>

                @endif

                <h3>All Products</h3>
                <form id="filter" style="font-size: 24px;">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="first" id="subCategory" class="selectpicker" style="color: #0059B2;">
                                <option value="6">All Services</option>
                                @foreach($categories as $key => $cat)
                                @if($cat->id === $category_current['id'] || $cat->id === $category_current->subid['id'])
                                <option selected value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @else
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="second" id="childCategory" class="selectpicker">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 col-12">

                            <div class="input-group category-search">
                                <input type="text" class="searchbar form-control " id="searchProduct"
                                    name="searchProduct" placeholder="Search for a product">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn"><span class="fa fa-search"
                                            aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div id="tableArea">
                    <table id="productTable" class="table table-striped tabele-bordered" style="margin-top:20px;">
                        <thead>
                            <tr>
                                <th style="width: 40%">Item</th>
                                <th style="width: 25%" class="text-left">Rate</th>
                                <th style="width: 30%" class="text-center">QTY</th>
                                <th style="width: 8%"></th>
                                {{-- <td>Total</td> --}}
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>

                    </table>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>


</div>


@stop
@section('footer')
    @include('categoryproduct.footer')
@stop
