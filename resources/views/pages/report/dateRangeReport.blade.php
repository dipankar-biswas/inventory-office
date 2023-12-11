@extends('layouts.master')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5">

            <!-- Form inputs start -->
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title d-flex justify-content-between">
                            <span>Date Range Report</span>
                            <a href="{{ route('size.list') }}" class="btn btn-sm btn-secondary">Back</a>
                        </h4>


                        <form action="" method="get" class="mt-4 dateRange">
                            <input type="hidden" name="search" value="daterange">

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="date" name="form_date" class="form-control form_date" value="{{Request()->form_date}}" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="date" name="to_date" class="form-control to_date" value="{{Request()->to_date}}" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {{-- <label for="rentProduct">Select</label> --}}
                                        <select class="form-control" name="stocktype" required style="height: auto">
                                            <option value="">Select one</option>
                                            @if(isset($stocktype) && $stocktype == "stockin")
                                                <option selected value="stockin">Stock In</option>
                                                <option value="stockout">Stock Out</option>
                                                <option value="refund">Refund</option>
                                            @elseif(isset($stocktype) && $stocktype == "stockout")
                                                <option value="stockin">Stock In</option>
                                                <option selected value="stockout">Stock Out</option>
                                                <option value="refund">Refund</option>
                                            @elseif(isset($stocktype) && $stocktype == "refund")
                                                <option value="stockin">Stock In</option>
                                                <option value="stockout">Stock Out</option>
                                                <option selected value="refund">Refund</option>
                                            @else
                                                <option value="stockin">Stock In</option>
                                                <option value="stockout">Stock Out</option>
                                                <option value="refund">Refund</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-primary pr-4 pl-4">Search</button>
                                </div>
                            </div>
                        </form>

                @if(isset($search) && $search == "daterange")
                    @if(isset($stockAddTotal) && count($stockAddTotal) > 0)

                    

                        <div class="mt-4 mb-3 d-flex justify-content-between align-items-center">
                            <h5><span>Report List</span></h5>
                            <div>
                                <a class="btn btn-info" href="{{Route('dateRangePDF.getDateRangePDF','stocktype='.$stocktype.'&start='.Request()->form_date.'&end='.Request()->to_date)}}"><i class="fa fa-print"></i> Print</a>
                                <a class="btn btn-success" href="{{Route('dateRangePDF.getDateRangePDF','stocktype='.$stocktype.'&type=todayDownload'.'&start='.Request()->form_date.'&end='.Request()->to_date)}}"><i class="fa fa-download"></i> Download</a>
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
