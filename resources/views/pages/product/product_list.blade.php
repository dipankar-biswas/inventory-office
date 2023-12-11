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
                        <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Add Product</a>
                    </h4>

                    <div class="data-tables">

                    @if($products != null)

                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($products as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{ asset($item->image) }}" alt="Image" style="width: 50px;height:40px"></td>
                                    <td>{{ucfirst(substr($item->name, 0, 20))}}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        <a href="#">View</a>
                                        <a href="{{ route('product.show',$item->id) }}">Edit</a>
                                        <a href="{{ route('product.delete',$item->id) }}">Delete</a>
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
@endsection