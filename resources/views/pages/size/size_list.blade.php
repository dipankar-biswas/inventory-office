@extends('layouts.master')

@section('content')
<div class="main-content-inner">
    <div class="row">
       
        @section('breadcrumbs')
        <ul class="breadcrumbs pull-left">
            <li><a href="{{ url('/') }}">Dashboard</a></li>
            <li><span>Color</span></li>
        </ul>
        @endsection
        <!-- Form inputs start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title d-flex justify-content-between">
                        <span>Size list</span>
                        <a href="{{ route('size.create') }}" class="btn btn-sm btn-primary">Add Size</a>
                    </h4>

                    <div class="data-tables">

                    @if($sizes != null)

                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($sizes as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{ucfirst(substr($item->name, 0, 20))}}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('size.show',$item->id) }}"><i class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Are you sure Delete?')" href="{{ route('size.delete',$item->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </a>
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