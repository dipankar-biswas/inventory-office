@extends('layouts.master')

@section('content')
<div class="main-content-inner">
    <div class="row">
       
        @section('breadcrumbs')
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('/') }}">Dashboard</a></li>
            <li><span>Add Refund</span></li>
        </ul>
        @endsection
        <!-- Form inputs start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title d-flex justify-content-between">
                        <span>Refund Add</span>
                        {{--<a href="{{ route('stock.create') }}" class="btn btn-sm btn-primary">Stock Add</a>--}}
                    </h4> 




                    <div class="card">
                        <div class="card-body">

                                
                                    <div class="row">
                                        <div class="col-md-6 d-flex gap-2 mb-3">
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
                                                            @foreach($refunds as $data)
                                                            <li><a class="dropdown-item text" data_id="{{$data->id}}">{{$data->name}}--{{$data->brand?->name}}--{{$data->color?->name}}--{{$data->size?->name}}--{{$data->qty}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group-append ml-2">
                                                <button class="btn btn-primary btn-sm px-3" id="stockoutadd" type="button">Add</button>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <select class="form-control" id="stockSelectedData">
                                                    <option value="">Select Product</option>
                                                @foreach($stocks as $data)

                                                <option value="{{$data->id}}">{{$data->name}}--{{$data->brand?->name}}--{{$data->color?->name}}--{{$data->size?->name}}</option>

                                                @endforeach
                                                </select>
                                              <div class="input-group-append">
                                                <button class="btn btn-primary btn-sm" id="stockoutadd" type="button">Add</button>
                                              </div>
                                            </div>
                                            <small id="stockoutmessage" class="form-text"></small>
                                        </div> --}}
                                    </div>


                                <form id="refundSubmit" method="post">
                                    @csrf
                                    <table class="table">
                                        <thead id="sthead" style="display:none;">
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Brands</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Current Stock</th>
                                                <th>Qty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="stbody">
                                        </tbody>
                                    </table>


                                    <div>
                                        <button class="btn btn-primary" id="stockoutsubmit" style="display: none;">Save</button>
                                    </div>
                                </form>

                        </div>
                    </div>




                </div>
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