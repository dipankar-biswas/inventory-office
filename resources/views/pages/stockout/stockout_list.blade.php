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
                        <span>Stockout list</span>
                        <a href="{{ route('stockout.all') }}" class="btn btn-sm btn-primary">Stock Out</a>
                    </h4>
                    <div class="data-tables">
                    @if($stockout != null)

                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Color</th>
                                    <th>Stockout Qty</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                    @foreach($stockout as $item)
                              

                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>
                                        @if(isset($item->stockin?->image))
                                            <img src="{{ asset($item->stockin?->image) }}" alt="Image" style="width: 50px;height:40px">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ucfirst(substr($item->stockin?->name, 0, 20))}}</td>
                                    <td>{{ $item->stockin->brand?->name }}</td>
                                    <td>{{ $item->stockin->category?->name }}</td>
                                    <td>{{ $item->stockin->color?->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ date("h:i a d-m-Y", strtotime($item->created_at)) }}</td>
                                    <td>
                                        <a href="#">View</a>
                                        <a href="{{ route('stock.show',$item->id) }}">Edit</a>
                                        <a href="{{ route('stock.delete',$item->id) }}">Delete</a>
                                    </td>
                                </tr>
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