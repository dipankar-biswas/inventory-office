@extends('layouts.master')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5">

            <!-- Form inputs start -->
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title d-flex justify-content-between">
                            <span>Today Report</span>
                            <a href="{{ route('size.list') }}" class="btn btn-sm btn-secondary">Back</a>
                        </h4>


                        <form action="" method="get" class="mt-4">
                            <input type="hidden" name="search" value="today">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        {{-- <label for="rentProduct">Today Report</label> --}}
                                        <input type="text" name="date" class="form-control" placeholder="Enter Size Name" readonly value="{{date('d-F-Y')}}">
                                    </div>
                                </div>
                                <div class="col-sm-5">
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
                                <a class="btn btn-info" href="{{Route('todayPDF.todayPDF','stocktype='.$stocktype)}}"><i class="fa fa-print"></i> Print</a>
                                <a class="btn btn-success" href="{{Route('todayPDF.todayPDF','stocktype='.$stocktype.'&type=todayDownload')}}"><i class="fa fa-download"></i> Download</a>
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
@endsection
