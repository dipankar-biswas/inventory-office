@extends('layouts.master')

@section('content')
<div class="main-content-inner">
    <div class="row">
       
        @section('breadcrumbs')
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('/') }}">Dashboard</a></li>
            <li><span>Product</span></li>
        </ul>
        @endsection
        <!-- Form inputs start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title d-flex justify-content-between">
                        <span>Product list</span>
                        <a href="{{ route('stock.create') }}" class="btn btn-sm btn-primary">Add Product</a>
                    </h4>
                    <div class="data-tables">

                    @if($stocks != null)

                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th>Stock Out</th>
                                    <th>Current Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @foreach($stocks as $item)

                                <!-- * For Qty * -->
                                    @php $qty = 0;@endphp
                                    @foreach($item->stockaddtotal as $data)
                                        @php
                                            $qty += $data->qty;
                                        @endphp
                                    @endforeach
                                <!-- * For Qty * -->

                                <!-- * Stockout * -->
                                    @php $stockout = 0;@endphp
                                    @foreach($item->stockout as $data)
                                        @php
                                            $stockout += $data->qty;
                                        @endphp
                                    @endforeach
                                <!-- * Stockout * -->


                                <!-- * Stockout * -->
                                    @php $currentStock = 0; @endphp
                                    @foreach($item->stockout as $data)
                                        @php
                                            $currentStock += $data->qty;
                                        @endphp
                                    @endforeach
                                <!-- * Stockout * -->


                                @if($qty < 10)
                                <tr class="alert alert-danger">
                                    <td>{{$i++}}</td>
                                    <td>
                                        @if(!empty($item->image))
                                        <img src="{{ asset($item->image) }}" alt="Image" style="width: 50px;height:40px">
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>{{ucfirst(substr($item->name, 0, 20))}}</td>
                                    <td>{{ $item->brand?->name }}</td>
                                    <td>{{ $item->category?->name }}</td>
                                    <td>{{ $item->color?->name }}</td>
                                    <td>{{$item->size?->name}}</td>
                                    <td>{{$qty}}</td>
                                    <td>{{$stockout}}</td>
                                    <td>{{$qty - $currentStock}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('stock.show',$item->id) }}"><i class="fa fa-edit"></i></a>
                                        {{-- <a href="{{ route('stock.delete',$item->id) }}">Delete</a> --}}
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        @if(!empty($item->image))
                                        <img src="{{ asset($item->image) }}" alt="Image" style="width: 50px;height:40px">
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td>{{ucfirst(substr($item->name, 0, 20))}}</td>
                                    <td>{{ $item->brand?->name }}</td>
                                    <td>{{ $item->category?->name }}</td>
                                    <td>{{ $item->color?->name }}</td>
                                    <td>{{$item->size?->name}}</td>
                                    <td>{{$qty}}</td>
                                    <td>{{$stockout}}</td>
                                    <td>{{$qty - $currentStock}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('stock.show',$item->id) }}"><i class="fa fa-edit"></i></a>

                                        {{-- <a href="{{ route('stock.delete',$item->id) }}">Delete</a> --}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>

                    @else
                        <hr>
                        <p class="h5 text-center">Data not found!</p>
                    @endif

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
</style>
@endsection