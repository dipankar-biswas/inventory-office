@extends('layouts.master')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5">

            <!-- Form inputs start -->
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title d-flex justify-content-between">
                            <span>Product Wise Report</span>
                            <a href="{{ route('size.list') }}" class="btn btn-sm btn-secondary">Back</a>
                        </h4>


                        <form action="" method="get" class="mt-4">
                            <input type="hidden" name="search" value="today">
                            <div class="row">
                                <div class="col-sm-7 d-flex gap-2 mb-3">
                                    <div class="dropdown bootstrap-select form-control aiz- show select-search-auto p-0">
                                        <input type="hidden" value="" name="product_id" class="autocompleteValue">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" data-id="sort_state" title="Select Product" style="background-color: #fff">
                                            <div class="filter-option">
                                                <div class="filter-option-inner">
                                                    <div class="filter-option-inner-inner">Select Product</div>
                                                </div> 
                                            </div>
                                        </button>
                                        <div class="dropdown-menu">
                                            <div class="bs-searchbox">
                                                <input type="search" onkeyup="autocompleteSearch()" class="form-control autocompleteSearch" autocomplete="off" role="combobox" aria-label="Search">
                                            </div>
                                            <div class="inner" role="listbox" id="bs-select-1" tabindex="-1">
                                                <ul class="show autocompleteUl" role="presentation">
                                                @foreach($stocks as $data)
                                                    <li><a class="dropdown-item text" data_id="{{$data->id}}">{{$data->name}}--{{$data->brand?->name}}--{{$data->color?->name}}--{{$data->size?->name}}--{{$data->qty}}</a></li>
                                                @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{-- <label for="rentProduct">Select</label> --}}
                                        <select class="form-control" name="stocktype" required style="height: auto">
                                            <option value="">Select one</option>
                                            @if($stocktype == "stockin")
                                                <option selected value="stockin">Stock In</option>
                                                <option value="stockout">Stock Out</option>
                                            @elseif($stocktype == "stockout")
                                                <option value="stockin">Stock In</option>
                                                <option selected value="stockout">Stock Out</option>
                                            @else
                                                <option value="stockin">Stock In</option>
                                                <option value="stockout">Stock Out</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary pr-4 pl-4">Search</button>
                                </div>
                            </div>
                        </form>

                @if($search == "today")
                    @if(isset($stockAddTotal) && count($stockAddTotal) > 0)

                    

                        <div class="mt-4 mb-3 d-flex justify-content-between align-items-center">
                            <h5><span>Report List</span></h5>
                            <div>
                                <a class="btn btn-info" href="{{Route('prdocutwish.productwishpdf','stocktype='.$stocktype.'&pid='.$product_id)}}"><i class="fa fa-print"></i> Print</a>
                                <a class="btn btn-success" href="{{Route('prdocutwish.productwishpdf','stocktype='.$stocktype.'&pid='.$product_id.'&type=todayDownload')}}"><i class="fa fa-download"></i> Download</a>

                            </div>
                        </div>

                        <table class="table">
                            <tr>
                                <td>SL</td>
                                <td>Product</td>
                                <td>Qty</td>
                                <td>Brand</td>
                                <td>Color</td>
                                <td>Size</td>
                                <td>Date</td>
                            </tr>
                            @foreach($stockAddTotal as $data)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$data->stockin?->name}}</td>
                                    <td>{{$data->qty}}</td>
                                    <td>{{$data->stockin?->brand->name}}</td>
                                    <td>{{$data->stockin?->color->name}}</td>
                                    <td>{{$data->stockin?->size->name}}</td>
                                    <td>{{date("d-F-Y h:i a", strtotime($data->created_at))}}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <h5 class="text-center my-3">Data not found!</h5>
                    @endif
                @endif

                    </div>
                </div>
            </div>
            <!-- Form inputs end -->

        </div>
    </div>

    <style>
        .alert-danger {
            background-color: #f8d7da !important;
            border-color: #f5c6cb !important;
        }
    
        .select-search-auto {
            position: relative;
            
        }
        .select-search-auto > input {
            position: absolute;
            z-index: 0;
            opacity: 0;
        }
        .select-search-auto button {
            position: relative;
            width: 100%;
        }
        .select-search-auto .filter-option-inner {
            float: left;
            width: 100%;
            text-align: left;
        }
        .select-search-auto .dropdown-menu {
            position: absolute;
            top: -10px !important;
            left: 0;
            transform: translate3d(0px, 52px, 0px) !important;
            will-change: transform;
            width: 100%;
            padding: 8px;
        }
        .select-search-auto .dropdown-menu .inner {
            overflow-y: auto;
            width: 100%;
            display: block;
        }
        .select-search-auto .dropdown-menu .inner ul {
            margin-top: 4px;
            max-height: 200px;
            overflow-y: auto;
        }
        .select-search-auto .dropdown-menu .inner ul li {
            cursor: pointer;
        }
    </style>
@endsection
