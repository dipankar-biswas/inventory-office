@extends('layouts.master')


@section('content')
<div class="main-content-inner">
    <div class="row">
       
        @section('breadcrumbs')
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('/') }}">Dashboard</a></li>
            <li><span>Home</span></li>
        </ul>
        @endsection
        <!-- Form inputs start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    @php
                        $products = App\Models\StockIn::where('status',1)->count();
                        $stockin = App\Models\stockAddTotal::count();
                        $stockout = App\Models\StockOut::count();
                        $users = App\Models\User::where('status',1)->count();
                        $userslist = App\Models\User::where('status',1)->get();
                    @endphp
                    <div class="row dash-overview mt-2 mb-5">

                        <div class="col-lg-3 col-md-6 col-12 my-3">
                            <div class="grid one">
                                <h4>Products</h4>
                                <p>Total Active Products</p>
                                <h2>{{ $products }}</h2>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 my-3">
                            <div class="grid two">
                                <h4>Stock-In</h4>
                                <p>Total stock-in</p>
                                <h2>{{ $stockin }}</h2>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 my-3">
                            <div class="grid three">
                                <h4>Product-Out</h4>
                                <p>Total stock-out</p>
                                <h2>{{ $stockout }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12 my-3">
                            <div class="grid four">
                                <h4>Users</h4>
                                <p>Total Active Users</p>
                                <h2>{{ $users }}</h2>
                            </div>
                        </div>
                        
                    </div>


                    <h4 class="header-title d-flex justify-content-between">
                        <span>User list</span>
                    </h4>

                    <div class="data-tables">
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userslist as $key=>$item)
                                <tr>
                                    <th>{{ $key+1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>N/A</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- Form inputs end -->
               
    </div>
</div>

<style>
    .dash-overview .grid {
        color: #fff;
        padding: 30px 24px;
        border-radius: 4px;
        position: relative;
    }
    .dash-overview .grid::before,
    .dash-overview .grid::after {
        position: absolute;
        content: '';
        border-radius: 50%;
        background-color: #ffffff24;
    }
    .dash-overview .grid::before {
        width: 200px;
        height: 200px;
        left: -20px;
    }
    .dash-overview .grid::after {
        width: 140px;
        height: 140px;
        bottom: -100px;
        right: 0;
    }
    .dash-overview .grid h4 {
        color: #fff
    }
    .dash-overview .grid p {
        color: #ddd;
        margin-bottom: 20px;
    }
    .dash-overview .grid.one {
        background-color: #875fc0;
        background-image: linear-gradient(315deg, #875fc0 0%, #5346ba 74%);
    }
    .dash-overview .grid.two {
        background-color: #47c5f4;
        background-image: linear-gradient(315deg, #47c5f4 0%, #6791d9 74%);
    }
    .dash-overview .grid.three {
        background-color: #eb4786;
        background-image: linear-gradient(315deg, #eb4786 0%, #b854a6 74%);
    }
    .dash-overview .grid.four {
        background-color: #ffb72c;
        background-image: linear-gradient(315deg, #ffb72c 0%, #f57f59 74%);
    }
</style>
@endsection

